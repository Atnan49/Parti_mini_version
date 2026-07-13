# Dokumen Serah Terima (Handover) & Manual Pengguna
## Sistem Informasi Manajemen Kegiatan PARTI UMS

Dokumen ini berisi panduan teknis pengembangan (handover) serta panduan penggunaan sistem (user manual) untuk mempermudah operasional website PARTI oleh pengurus/panitia.

---

## 1. Spesifikasi Teknis (Handover)

### Tech Stack
* **Framework Backend**: Laravel 11.x (PHP >= 8.2)
* **Frontend Engine**: Blade Template (HTML5 + Vanilla CSS + TailwindCSS + Alpine.js)
* **Database Relasional**: MySQL / MariaDB
* **Asset Bundler**: Vite (NPM)

### Fitur Pengamanan & Arsitektur Utama
1. **Rute Masuk Terkunci**: Rute login Breeze default `/login` telah dialihkan ke rute profesional `/auth` guna mengaburkan pintu masuk panel admin dari robot/hacker umum.
2. **Penonaktifan Registrasi & Lupa Password Mandiri**: Pendaftaran user baru hanya bisa dilakukan oleh **Superadmin** di dalam panel admin. Rute lupa password email dinonaktifkan demi alasan keamanan kredensial panitia.
3. **Password Force Change**: Pengguna Kesekretariatan yang baru didaftarkan wajib mengganti password pada saat pertama kali login sebelum diizinkan mengakses menu pengelolaan lainnya.
4. **Log Audit (Audit Trail)**: Setiap aksi sensitif (unggah dokumen, edit tautan Google Form, penonaktifan user, dll.) dicatat di tabel `audit_logs` lengkap dengan ID operator dan deskripsi perubahan.

---

## 2. Matriks Hak Akses Pengguna

| Fitur Panel Admin | SUPERADMIN | KESEKRETARIATAN |
| :--- | :---: | :---: |
| **Melihat Dashboard Statistik** | Ya | Ya |
| **Mengubah Tahun Aktif Kegiatan** (Session) | Ya | Ya |
| **Mereset Sandi Akun Sendiri** | Ya | Ya |
| **Mengelola Tautan Google Form** (Link Pendaftaran) | Ya | Ya |
| **Mengelola Akun Kesekretariatan** (Tambah/Matikan Akun) | Ya | Tidak |
| **Mengelola Sub Acara** (Tambah/Ubah/Hapus/Status) | Ya | Tidak |
| **Mengelola Dokumen Template Persyaratan** | Ya | Tidak |
| **Mengelola Alur Agenda** (Timeline) | Ya | Tidak |
| **Mengelola Sponsor Pendukung** | Ya | Tidak |
| **Melihat Log Aktivitas Operator** (Audit Logs) | Ya | Tidak |

---

## 3. Manual Pengguna (User Manual)

### Kredensial Default (Lokal)
* **URL Login**: `http://localhost:8000/auth`
* **Email Akun Pertama**: `admin@parti2026.com`
* **Password**: `changeme123`
* **Role**: `SUPERADMIN`

---

### A. Panduan untuk Peran: SUPERADMIN

#### 1. Cara Menambahkan Akun Panitia (Kesekretariatan) Baru
1. Buka menu **Manajemen User** di sidebar kiri.
2. Klik tombol **+ Tambah Akun Baru**.
3. Isi kolom Nama, Email, dan masukkan password sementara.
4. Klik **Daftarkan Akun**. 
5. Informasikan email dan password tersebut kepada panitia terkait. Saat mereka login pertama kali, sistem secara otomatis memaksa mereka untuk mengganti password tersebut dengan password pribadi mereka.

#### 2. Cara Mengaktifkan / Menonaktifkan Akun Panitia
1. Buka menu **Manajemen User**.
2. Cari nama panitia di tabel, lalu klik tombol toggle merah **Nonaktifkan** jika ingin memblokir akses login mereka.
3. Untuk mengaktifkan kembali, klik tombol hijau **Aktifkan**.

#### 3. Cara Mereset Password Anggota Panitia
1. Di halaman **Manajemen User**, pilih nama panitia yang lupa password.
2. Masukkan password baru pada input inline di baris user tersebut, lalu klik tombol **Reset Sandi**.
3. Status akun mereka akan otomatis diset kembali menjadi `must_change_password`, sehingga mereka wajib mengganti sandi baru tersebut pada saat login pertama pasca-reset.

#### 4. Cara Mengelola Sub-Acara & Pengaturan Pelaksanaan
1. Buka menu **Sub Acara** di sidebar admin.
2. Klik **+ Buat Sub Acara Baru**.
3. Isi seluruh informasi yang diperlukan:
   * **Pelaksanaan Acara**: Pilih `ONLINE`, `OFFLINE`, atau `HYBRID`.
   * **Lokasi / Tempat Acara**: Tulis nama lokasi (contoh: *Gedung J UMS* atau *Zoom Meeting*). Teks ini akan menggantikan tulisan PJ lama di halaman publik.
   * **PJ (Penanggung Jawab)**: Tulis nama PJ dipisah tanda koma (contoh: *Atnan, Anes*).
   * **HTM (Kategori Tiket)**: Masukkan nama kategori dan harga per baris dengan format `NamaKategori:Harga` (contoh: `Umum:35000` atau `Presale1:20000`). Kosongkan jika acara gratis.
4. Simpan data. Secara default sub-event akan berstatus `DRAFT` (tidak tampil di publik).
5. Pada tabel list sub-event, ganti opsi pilihan status menjadi **`PUBLISHED`** agar sub-event tampil secara publik. Jika pendaftaran ditutup, ubah ke **`CLOSED`** (tombol daftar di publik akan otomatis terkunci).

#### 5. Cara Mengunggah Berkas Panduan / Syarat Lomba (Guidebook)
1. Di halaman **Sub Acara**, temukan baris sub-acara yang ingin diisi dokumennya.
2. Di kolom **Dokumen**, klik tombol **`📄 Kelola (X)`**.
3. Di panel kiri, masukkan nama label dokumen (misal: *Guidebook Lomba Web*) dan pilih file PDF/DOCX (maksimal 10MB).
4. Klik **Unggah Dokumen**. Berkas ini akan langsung muncul di halaman detail sub-acara publik sehingga bisa diunduh oleh peserta.

#### 6. Cara Mengelola Sponsor Pendukung
1. Buka menu **Sponsor** di sidebar kiri.
2. Klik tombol **+ Tambah Sponsor Baru**.
3. Isi Nama Perusahaan, URL Website (jika ada), tingkat tier sponsor (Platinum, Gold, Silver, Bronze), urutan tampil, dan unggah berkas logo sponsor.
4. Klik **Tambah Sponsor**. Status default adalah langsung tampil, Anda bisa menyembunyikannya dari publik dengan mengedit opsi status keaktifan sponsor.

---

### B. Panduan untuk Peran: KESEKRETARIATAN

#### 1. Langkah Pertama (Login Awal)
1. Buka rute `/auth` di browser.
2. Masukkan email dan sandi sementara yang diberikan oleh Superadmin.
3. Anda akan langsung dialihkan ke halaman **Ubah Kata Sandi Wajib**.
4. Masukkan sandi baru yang aman sebanyak dua kali dan klik simpan. Setelah sukses, Anda baru diizinkan mengakses panel admin.

#### 2. Cara Mengupdate Link Registrasi (Google Form)
1. Buka menu **Tautan Pendaftaran** di sidebar kiri.
2. Anda akan melihat daftar sub-event yang aktif untuk tahun kegiatan tersebut.
3. Salin link Google Form pendaftaran acara Anda, dan tempelkan di kolom input sub-acara terkait.
   * *Catatan*: Sistem hanya menerima URL valid dari Google Form (`docs.google.com/forms` atau `forms.gle`).
4. Klik **Simpan Tautan**. Tombol "Daftar" di halaman depan publik untuk sub-acara tersebut akan otomatis aktif dan mengarah ke link Google Form tersebut.

---

### C. Pemulihan Sandi Superadmin (Password Recovery)

Karena rute pengaturan lupa password email dinonaktifkan secara sengaja demi keamanan, jika akun **Superadmin** mengalami lupa sandi, pemulihan dapat dilakukan secara langsung di server menggunakan **Artisan Tinker**:

1. Masuk ke terminal SSH server Anda atau buka terminal di direktori proyek lokal.
2. Jalankan perintah Tinker:
   ```bash
   php artisan tinker
   ```
3. Cari akun Superadmin dan ganti passwordnya:
   ```php
   $user = App\Models\User::where('role', 'SUPERADMIN')->first();
   $user->password = Hash::make('SandiBaruAnda123');
   $user->save();
   ```
4. Ketik `exit` untuk keluar. Sekarang Anda dapat login menggunakan password baru tersebut.

---

## 4. Panduan Deployment (Hostinger cPanel/hPanel)

1. **Persiapan Berkas Lokal**:
   * Jalankan `npm run build` di lokal komputer Anda agar aset CSS/JS terkompilasi ke folder `public/build/`.
   * Ekspor database Anda menjadi berkas `.sql`.
2. **Unggah Berkas ke Hosting**:
   * Compress seluruh file project Anda (kecuali folder `node_modules` dan `.git`) menjadi file `.zip`.
   * Upload file `.zip` tersebut ke direktori cPanel Hostinger Anda (sebaiknya satu level di atas folder `public_html` demi keamanan kode program).
   * Ekstrak file tersebut.
3. **Pindahkan folder `public`**:
   * Pindahkan isi dari folder `public/` project Laravel Anda ke dalam folder `public_html/` milik domain Hostinger Anda.
   * Ubah baris path di file `public_html/index.php` agar mengarah dengan benar ke berkas bootstrap Laravel satu level di atasnya:
     ```php
     require __DIR__.'/../parti2026/vendor/autoload.php';
     $app = require_once __DIR__.'/../parti2026/bootstrap/app.php';
     ```
4. **Konfigurasi Database & Environment**:
   * Buat database MySQL baru dan user database di hPanel Hostinger.
   * Impor berkas `.sql` lokal Anda ke database Hostinger melalui phpMyAdmin.
   * Edit berkas `.env` di server Hostinger Anda dan sesuaikan kredensial database (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`), mail server SMTP, serta set `APP_ENV=production`.
5. **Membuat Symlink Storage**:
   * Karena Hostinger biasanya membatasi akses terminal SSH, Anda bisa membuat symlink folder storage dengan membuat file route sementara di `routes/web.php` server:
     ```php
     Route::get('/symlink', function () {
         Artisan::call('storage:link');
         return 'Symlink dibuat!';
     });
     ```
   * Akses URL `domain-anda.com/symlink` sekali di browser Anda, lalu hapus route tersebut demi keamanan.
