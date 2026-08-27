<?php
header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors', '1');

echo "<h2>PARTI 2026 - Diagnosa Server Hostinger</h2>";
echo "<ul>";

// 1. PHP Version
echo "<li><strong>Versi PHP:</strong> " . PHP_VERSION;
if (version_compare(PHP_VERSION, '8.2.0', '>=')) {
    echo " <span style='color:green;'>✓ (Sesuai)</span></li>";
} else {
    echo " <span style='color:red;'>✗ (Wajib PHP 8.2 ke atas! Ubah di hPanel -> Advanced -> PHP Configuration)</span></li>";
}

// 2. Cek Direktori & File Penting
$baseDir = dirname(__DIR__);
if (!file_exists($baseDir . '/vendor/autoload.php')) {
    // Cek jika diletakkan langsung di direktori saat ini
    $baseDir = __DIR__;
}

echo "<li><strong>Base Directory Terdeteksi:</strong> <code>" . htmlspecialchars($baseDir) . "</code></li>";

$checks = [
    'Vendor Autoload' => $baseDir . '/vendor/autoload.php',
    'Bootstrap App' => $baseDir . '/bootstrap/app.php',
    'File .env' => $baseDir . '/.env',
    'Storage Directory' => $baseDir . '/storage',
    'Bootstrap Cache' => $baseDir . '/bootstrap/cache',
];

foreach ($checks as $name => $path) {
    if (file_exists($path)) {
        $writable = is_writable($path) ? ' (Writable ✓)' : ' (Not Writable ✗)';
        echo "<li><strong>{$name}:</strong> <span style='color:green;'>Ditemukan ✓</span> {$writable}</li>";
    } else {
        echo "<li><strong>{$name}:</strong> <span style='color:red;'>TIDAK DITEMUKAN ✗</span> (Path: <code>" . htmlspecialchars($path) . "</code>)</li>";
    }
}

// 3. Cek Koneksi Database Langsung
echo "</ul><h3>Cek Koneksi Database MySQL</h3><ul>";
if (file_exists($baseDir . '/.env')) {
    $envContent = file_get_contents($baseDir . '/.env');
    preg_match('/DB_HOST=(.*)/', $envContent, $mHost);
    preg_match('/DB_PORT=(.*)/', $envContent, $mPort);
    preg_match('/DB_DATABASE=(.*)/', $envContent, $mDb);
    preg_match('/DB_USERNAME=(.*)/', $envContent, $mUser);
    preg_match('/DB_PASSWORD=(.*)/', $envContent, $mPass);

    $dbHost = trim($mHost[1] ?? '127.0.0.1', " \"'\r\n");
    $dbPort = trim($mPort[1] ?? '3306', " \"'\r\n");
    $dbName = trim($mDb[1] ?? '', " \"'\r\n");
    $dbUser = trim($mUser[1] ?? '', " \"'\r\n");
    $dbPass = trim($mPass[1] ?? '', " \"'\r\n");

    echo "<li><strong>Target Database:</strong> <code>{$dbUser}@{$dbHost}:{$dbPort}/{$dbName}</code></li>";

    try {
        $dsn = "mysql:host={$dbHost};port={$dbPort};dbname={$dbName};charset=utf8mb4";
        $pdo = new PDO($dsn, $dbUser, $dbPass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_TIMEOUT => 5
        ]);
        echo "<li><strong>Status Koneksi MySQL:</strong> <span style='color:green;'>BERHASIL KONEK ✓</span></li>";

        // Cek jumlah tabel
        $stmt = $pdo->query("SHOW TABLES");
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
        echo "<li><strong>Jumlah Tabel Ditemukan:</strong> " . count($tables) . " tabel</li>";
        if (count($tables) > 0) {
            echo "<li><strong>Tabel Terdaftar:</strong> " . implode(', ', $tables) . "</li>";
        }
    } catch (Throwable $e) {
        echo "<li><strong>Status Koneksi MySQL:</strong> <span style='color:red;'>GAGAL: " . htmlspecialchars($e->getMessage()) . "</span></li>";
    }
} else {
    echo "<li><span style='color:red;'>File .env tidak terbaca!</span></li>";
}

// 4. Test Symlink
echo "</ul><h3>Test & Buat Symlink Storage</h3><ul>";
$target = $baseDir . '/storage/app/public';
$link = __DIR__ . '/storage';

if (!file_exists($target)) {
    @mkdir($target, 0755, true);
}

if (file_exists($link)) {
    echo "<li><strong>Symlink Storage:</strong> <span style='color:green;'>Sudah ada / Aktif ✓</span></li>";
} else {
    $symlinkSuccess = @symlink($target, $link);
    if ($symlinkSuccess) {
        echo "<li><strong>Symlink Storage:</strong> <span style='color:green;'>Berhasil dibuat otomatis ✓</span></li>";
    } else {
        echo "<li><strong>Symlink Storage:</strong> <span style='color:orange;'>Gagal membuat symlink otomatis (Akan dialihkan via Route fallback Laravel)</span></li>";
    }
}

echo "</ul>";
echo "<hr><p style='color:gray; font-size:12px;'>PARTI 2026 Deployment Diagnostic Utility</p>";
