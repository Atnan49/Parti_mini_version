# 🛠️ Panduan Instalasi Lokal (Local Installation Guide)

Dokumen ini berisi panduan lengkap langkah demi langkah untuk memasang dan menjalankan sistem **PARTI (Parade Teknik Informatika) UMS 2026** di lingkungan pengembangan lokal (*Local Development Environment*).

---

## 📋 Prasyarat Sistem (Prerequisites)

Pilih salah satu metode pengembangan di bawah ini:

### Opsi A: Menggunakan Docker (Rekomendasi Utama)
- **Docker Desktop** (versi 24.0+) & **Docker Compose**
- *Catatan: Dengan Docker, Anda tidak perlu menginstal PHP, MySQL, atau Node.js secara manual di laptop Anda.*

### Opsi B: Instalasi Manual
- **PHP** >= 8.3 (Diutamakan PHP 8.4)
- **Composer** >= 2.6
- **Node.js** >= 20.x & **NPM**
- **MySQL** / **MariaDB** (via XAMPP, Laragon, atau Standalone)

---

## 🚀 Metode 1: Menggunakan Docker & Docker Compose (Direkomendasikan)

1. **Pastikan Docker Desktop Aktif** di komputer Anda.
2. **Clone Repositori & Masuk ke Folder Project**:
   ```bash
   git clone https://github.com/Atnan49/Parti_mini_version.git
   cd Parti_mini_version/parti2026
   ```
3. **Jalankan Container**:
   ```bash
   docker-compose up -d --build
   ```
4. **Inisialisasi Database (Hanya Saat Pertama Kali)**:
   ```bash
   docker compose exec web php artisan migrate --seed
   ```
5. **Buka Browser**:
   Akses aplikasi di: **`http://localhost:8000`**

---

## 💻 Metode 2: Instalasi Manual (Tanpa Docker)

1. **Masuk ke Folder Aplikasi (`parti2026/`)**:
   ```bash
   cd parti2026
   ```

2. **Salin File Konfigurasi Environment**:
   ```bash
   cp .env.example .env
   ```

3. **Pasang Dependensi Backend (PHP)**:
   ```bash
   composer install
   ```

4. **Pasang Dependensi Frontend (Node.js)**:
   ```bash
   npm install
   ```

5. **Generate Application Key**:
   ```bash
   php artisan key:generate
   ```

6. **Konfigurasi Database**:
   - Buat database MySQL baru (contoh nama: `parti2026`).
   - Buka file `.env` dan sesuaikan kredensial database Anda:
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=parti2026
     DB_USERNAME=root
     DB_PASSWORD=
     ```

7. **Migrasi & Seeding Database**:
   ```bash
   php artisan migrate --seed
   ```

8. **Jalankan Server Lokal & Vite Dev**:
   - Terminal 1 (Laravel Development Server):
     ```bash
     php artisan serve
     ```
   - Terminal 2 (Vite Compiler Asset):
     ```bash
     npm run dev
     ```

9. **Buka Browser**:
   Akses aplikasi di: **`http://localhost:8000`**

---

## 🔐 Kredensial & Autentikasi Pengembang

Informasi kredensial administrator awal dan rute autentikasi diatur di dalam file seeder `database/seeders/DatabaseSeeder.php` & `routes/web.php`. Untuk alasan keamanan sistem, detail akun admin tidak dipublikasikan secara terbuka di dalam dokumentasi publik.

---

## ⚡ Perintah Penting (Useful Commands)

| Perintah | Deskripsi |
| :--- | :--- |
| `php artisan view:clear` | Membersihkan cache tampilan Blade Laravel |
| `php artisan db:seed --class=FaqSeeder` | Mengisi ulang seeder data FAQ |
| `npm run build` | Mengkompilasi aset CSS/JS untuk produksi |

---

## 💡 Trouble Shooting & Tips PWA

Jika tampilan lokal Anda mengalami *caching* atau muncul layar **Mode Offline**:
1. Buka **F12** (Developer Tools Chrome).
2. Pergi ke tab **Application** → **Service Workers**.
3. Centang **Bypass for network** atau klik **Unregister** untuk menghapus cache lokal PWA Service Worker.
