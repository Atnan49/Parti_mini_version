# Panduan Instalasi Website PARTI 2026 UMS

Selamat datang di repositori resmi **Website PARTI 2026 UMS — Vanguard of Tech**. Dokumen ini dibuat khusus sebagai panduan langkah demi langkah bagi rekan-rekan mahasiswa (khususnya angkatan/semester 4) untuk menjalankan proyek ini di perangkat lokal masing-masing.

Anda dapat menjalankan proyek ini menggunakan **Docker** (Sangat Direkomendasikan) atau secara **Manual (Tanpa Docker)**. Silakan pilih salah satu metode di bawah ini.

---

## 🛠️ Prasyarat Sebelum Memulai (Prerequisites)

Sebelum mulai melakukan instalasi, pastikan Anda sudah memasang perangkat lunak berikut:
1. **Git** (Untuk clone repositori)
2. **Web Browser** (Chrome / Edge / Firefox)
3. **VS Code** (Atau text editor pilihan Anda)

---

## 🐳 Cara 1: Menjalankan Menggunakan Docker (Sangat Direkomendasikan)

Metode ini sangat mudah karena Anda tidak perlu menginstal PHP, MySQL, Composer, atau Node.js secara lokal di laptop Anda. Semua dependensi sudah otomatis terbungkus di dalam kontainer Docker.

### Langkah-Langkah:

1. **Clone Repositori**:
   Buka terminal/command prompt, jalankan perintah berikut untuk mengunduh proyek:
   ```bash
   git clone https://github.com/Atnan49/Parti_mini_version.git
   cd Parti_mini_version
   ```

2. **Salin File Environment**:
   Salin file `.env.example` menjadi `.env` di dalam folder `parti2026/`:
   * **Windows (Command Prompt)**:
     ```cmd
     copy parti2026\.env.example parti2026\.env
     ```
   * **Windows (PowerShell) / Linux / macOS**:
     ```bash
     cp parti2026/.env.example parti2026/.env
     ```

3. **Ubah Konfigurasi Database di `.env`**:
   Buka file `parti2026/.env` menggunakan VS Code, cari baris database (sekitar baris 23) dan ubah nilainya agar terhubung ke kontainer MySQL Docker:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=db
   DB_PORT=3306
   DB_DATABASE=parti2026
   DB_USERNAME=parti_user
   DB_PASSWORD=parti_password
   ```

4. **Jalankan Container Docker**:
   Buka terminal di dalam folder `parti2026/` (folder yang berisi file `docker-compose.yml`), lalu jalankan perintah:
   ```bash
   cd parti2026
   docker-compose up -d --build
   ```
   *(Tunggu beberapa menit hingga proses download image dan build selesai. Tanda `-d` berarti container berjalan di latar belakang).*

5. **Instal Dependensi Laravel (Composer) di Dalam Container**:
   Jalankan perintah ini untuk mengunduh paket-paket PHP Laravel yang dibutuhkan:
   ```bash
   docker-compose exec web composer install
   ```

6. **Generate Application Key**:
   Jalankan perintah ini untuk membuat kunci keamanan Laravel:
   ```bash
   docker-compose exec web php artisan key:generate
   ```

7. **Migrasi Database & Data Awal (Seeding)**:
   Jalankan perintah ini untuk membuat tabel database dan mengisinya dengan data awal (seperti daftar sub-acara & timeline):
   ```bash
   docker-compose exec web php artisan migrate --seed
   ```

8. **Selesai! Buka Website**:
   Buka browser Anda dan akses alamat:  
   👉 **[http://localhost:8000](http://localhost:8000)**

---

## 💻 Cara 2: Menjalankan Secara Manual (Tanpa Docker)

Jika Anda tidak menggunakan Docker, Anda harus menginstal PHP, MySQL, Composer, dan Node.js langsung di sistem operasi laptop Anda.

### Prasyarat Tambahan:
* **PHP 8.2 ke atas**
* **Composer** (Package manager PHP)
* **Node.js & NPM** (Untuk menjalankan/compile aset Vite CSS & JS)
* **MySQL/MariaDB Server** (XAMPP / Laragon)

### Langkah-Langkah:

1. **Clone Repositori**:
   ```bash
   git clone https://github.com/Atnan49/Parti_mini_version.git
   cd Parti_mini_version
   ```

2. **Salin File Environment**:
   Salin file `.env.example` menjadi `.env` di dalam folder `parti2026/`:
   * **Windows (Command Prompt)**:
     ```cmd
     copy parti2026\.env.example parti2026\.env
     ```
   * **Windows (PowerShell) / Linux / macOS**:
     ```bash
     cp parti2026/.env.example parti2026/.env
     ```

3. **Ubah Konfigurasi Database di `.env`**:
   Buka file `parti2026/.env` menggunakan VS Code. Nyalakan server MySQL lokal Anda (misal lewat XAMPP), buat database baru bernama `parti2026` via phpMyAdmin, lalu sesuaikan pengaturan database di `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=parti2026
   DB_USERNAME=root
   DB_PASSWORD=   # kosongkan jika tidak ada password di XAMPP
   ```

4. **Masuk ke Direktori Proyek & Instal PHP Dependensi**:
   Buka terminal, arahkan ke folder `parti2026/`, lalu jalankan:
   ```bash
   cd parti2026
   composer install
   ```

5. **Generate Application Key**:
   ```bash
   php artisan key:generate
   ```

6. **Migrasi Database & Data Awal (Seeding)**:
   Jalankan perintah berikut untuk mengisi database Anda dengan data acara:
   ```bash
   php artisan migrate --seed
   ```

7. **Aset CSS & JS (Vite)**:
   Aset css dan js produksi sudah di-build sebelumnya di repositori ini. Namun, jika ingin melakukan perubahan kode pada CSS, Anda perlu menginstal Node modules dan menjalankan server development:
   ```bash
   npm install
   npm run dev
   ```

8. **Nyalakan Server Lokal**:
   Jalankan server PHP bawaan Laravel:
   ```bash
   php artisan serve
   ```

9. **Selesai! Buka Website**:
   Buka browser Anda dan akses alamat:  
   👉 **[http://127.0.0.1:8000](http://127.0.0.1:8000)**

---

## 📝 Perintah Docker yang Sering Digunakan (Cheat Sheet)

* **Mematikan Container**:
  ```bash
  docker-compose down
  ```
* **Melihat Log / Error Docker**:
  ```bash
  docker-compose logs -f web
  ```
* **Masuk ke dalam terminal bash Container**:
  ```bash
  docker-compose exec web bash
  ```

Jika Anda mengalami kendala saat melakukan instalasi, silakan tanyakan di grup kolaborasi atau hubungi PJ Humas HIMATIF UMS. Selamat mencoba! 🚀
