# Dokumentasi Website PARTI UMS 2026

Website resmi **PARTI (Parade Teknik Informatika) 2026** yang diselenggarakan oleh **Himpunan Mahasiswa Teknik Informatika (HIMATIF) UMS**. Website ini dirancang sebagai platform informasi, publikasi sub-event, serta manajemen sponsorship dan administrasi kepanitiaan.

---

## 🚀 Panduan Pengembangan Lokal (Local Development)

### Prasyarat (Prerequisites)
* **PHP** >= 8.3 (Lokal disarankan PHP 8.4)
* **Composer**
* **Node.js** >= 20.x & **NPM**
* **MySQL / MariaDB** atau **Docker Desktop**

### Cara 1: Menggunakan Docker & Docker Compose (Direkomendasikan)
Jika Anda menggunakan Docker, Anda tidak perlu menginstal PHP, MySQL, atau Node.js secara lokal di laptop Anda. Semua dependensi sudah terbungkus otomatis.

1. Pastikan Docker Desktop sudah aktif.
2. Jalankan perintah di terminal root proyek:
   ```bash
   docker-compose up -d --build
   ```
3. Akses website melalui `http://localhost:8000`.

### Cara 2: Menjalankan Secara Manual (Tanpa Docker)
1. Salin berkas konfigurasi env:
   ```bash
   cp .env.example .env
   ```
2. Pasang dependensi PHP dan Node.js:
   ```bash
   composer install
   npm install
   ```
3. Buat kunci enkripsi aplikasi:
   ```bash
   php artisan key:generate
   ```
4. Buat database baru bernama `parti2026` di phpMyAdmin Anda, lalu sesuaikan kredensial di file `.env`.
5. Jalankan migrasi dan seeding database:
   ```bash
   php artisan migrate --seed
   ```
6. Jalankan server lokal dan build compiler aset (Vite):
   ```bash
   php artisan serve
   # di terminal baru:
   npm run dev
   ```
7. Akses website di `http://localhost:8000`.

---

## ☁️ Panduan Deployment Produksi (Production Deployment)

### Cara A: Deploy ke Render.com (Menggunakan Docker)
Proyek ini sudah dilengkapi konfigurasi Docker production-ready yang dioptimalkan untuk Render.com.

1. **Root Directory**: Pada pengaturan Render, pastikan kolom **Root Directory** diisi dengan `parti2026`.
2. **Runtime**: Pilih **Docker** (Render akan otomatis mendeteksi berkas `Dockerfile`).
3. **Environment Variables**: Tambahkan variabel lingkungan berikut di dashboard Render:
   * `APP_KEY` = `base64:xxxx...` (Gunakan kunci enkripsi lokal Anda)
   * `APP_ENV` = `production`
   * `APP_DEBUG` = `false`
   * `APP_URL` = `https://nama-aplikasi-anda.onrender.com`
   * `DB_CONNECTION` = `pgsql`
   * `DB_HOST` = `dpg-xxxx-a` (Gunakan Hostname Internal database PostgreSQL Render Anda)
   * `DB_PORT` = `5432`
   * `DB_DATABASE` = `[nama_database_render]`
   * `DB_USERNAME` = `[username_database_render]`
   * `DB_PASSWORD` = `[password_database_render]`
4. **Migrasi & Seeding Awal**:
   * Akses `https://nama-aplikasi-anda.onrender.com/run-migration` untuk migrasi tabel database.
   * Akses `https://nama-aplikasi-anda.onrender.com/run-seed` untuk memasukkan data admin dan sub-event awal.

### Cara B: Deploy ke Hostinger Shared Hosting (cPanel / hPanel)
Berkat penonaktifan pengecekan platform (`platform-check` diset ke `false` di `composer.json`), kode ini aman dari *version mismatch error* meskipun versi PHP di hosting lebih rendah daripada laptop lokal Anda.

1. **Git Integration**:
   * Hubungkan repositori GitHub Anda di hPanel Hostinger.
   * Pilih branch **`atnan-dev`**.
   * Set **Install Directory** ke `public_html`.
2. **Koneksi Database**: Buat database MySQL di Hostinger, lalu sesuaikan `.env` di file manager Hostinger.
3. **Tautan Storage (Symlink)**: Akses sekali URL `domain-anda.com/create-symlink` lewat browser untuk menghubungkan folder publik storage.

---

## 🔑 Kredensial Akses Default (Admin Panel)

* **URL Login**: `https://domain-anda.com/auth` (di-masking dari `/login` demi alasan keamanan)
* **Email**: `admin@parti2026.com`
* **Password**: `changeme123`
* **Role**: `SUPERADMIN`

---

## 🖼️ Kustomisasi Foto Momen di Hero Section

Bagian kanan Hero menggunakan **interactive 3D WebGL InfiniteMenu** yang berputar secara otomatis. 
* **Folder Penyimpanan**: Letakkan file foto Anda di dalam folder **`public/image/moment/`**.
* **Nama & Format File**: Pastikan file foto memiliki format PNG dengan penamaan berikut:
  * `hero_moment.png` (Momen 1)
  * `moment2.png` (Momen 2)
  * `moment3.png` (Momen 3)
  * `moment4.png` (Momen 4)
* **Menambah Foto Baru**: Masukkan foto tambahan (misal `moment5.png`) ke folder tersebut, lalu daftarkan item baru di dalam array `$menuItems` pada file `resources/views/public/home.blade.php`.
