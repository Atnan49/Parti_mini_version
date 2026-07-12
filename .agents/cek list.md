# PARTI 2026 — Development Checklist

Checklist pengembangan website PARTI 2026, disusun berdasarkan PRD.
Update status dengan mengganti `[ ]` menjadi `[x]` seiring progres pengerjaan.

**Tech Stack:** Laravel 11 · Blade · Tailwind CSS · Alpine.js · MySQL · Hostinger

---

## Setup & Struktur Proyek

- [x] Inisialisasi proyek Laravel 11 (`composer create-project laravel/laravel parti2026`)
- [x] Install Laravel Breeze (`php artisan breeze:install blade`)
- [x] Setup Tailwind CSS + Alpine.js + SortableJS via Vite
- [x] Konfigurasi koneksi MySQL (`.env`)
- [x] Buat `config/parti.php` (year aktif, batas upload, tipe file, domain gform)
- [x] Setup environment variables (`.env`) untuk DB, mail, app URL
- [x] Setup repository & branching workflow

---

## Database & Schema (Eloquent)

- [x] Migration `users` (id, name, email, password, role, is_active, must_change_password, created_by)
- [x] Migration `sub_events` (id, year, name, slug, tagline, description, date_start, date_end, pj_names, htm_tiers, gform_link, gform_updated_by, gform_updated_at, status, order, is_deleted, type, location)
- [x] Migration `sub_event_documents` (id, sub_event_id, label, file_path, file_type, file_size_bytes, order, uploaded_by, uploaded_at)
- [x] Migration `timeline_items` (id, year, sub_event_id, date, title, description, order)
- [x] Migration `audit_logs` (id, user_id, action, entity_type, entity_id, field_changed, old_value, new_value, created_at)
- [x] Eloquent Model `User` (scopes, relationships, disable self-registration)
- [x] Eloquent Model `SubEvent` (JSON casts, scopes, relationships, slug auto-generate)
- [x] Eloquent Model `SubEventDocument` (relationships, file delete on model delete)
- [x] Eloquent Model `TimelineItem` (relationships, scopes)
- [x] Eloquent Model `AuditLog` (relationships, scopes)
- [x] Migrasi awal & seed data (`AdminSeeder` + `SubEventSeeder` dengan default type & lokasi)
- [x] Relasi antar model (SubEvent ↔ SubEventDocument, SubEvent ↔ TimelineItem)

---

## Backend — Controllers & Routes

### Autentikasi & User
- [x] Login via Laravel Breeze (email + password) di rute profesional `/auth`
- [x] Disable registrasi publik (hapus rute register)
- [x] Disable reset password / forgot password via email (digantikan manual reset & force password change)
- [x] `ForcePasswordChange` middleware — redirect saat login pertama Kesekretariatan
- [x] `Admin\UserController` — create user Kesekretariatan, hanya Admin
- [x] `Admin\UserController` — deactivate/activate user (soft-toggle), hanya Admin
- [x] `RoleMiddleware` — proteksi route berdasarkan role (`role:SUPERADMIN`)

### Sub Acara
- [x] `Admin\SubEventController` — CRUD sub acara (hanya Admin)
- [x] `Admin\SubEventController@updateStatus` — update status draft/published/closed (hanya Admin)
- [x] `Admin\RegistrationLinkController` — update tautan Google Form (Admin & Kesekretariatan)
- [x] `GformLinkRequest` — validasi format tautan (`docs.google.com/forms` / `forms.gle`)
- [x] `Admin\SubEventController` — reorder sub acara via input angka order biasa

### Dokumen Template
- [x] `Admin\DocumentController@store` — upload dokumen per sub acara (hanya Admin)
- [x] `DocumentRequest` — validasi tipe file (PDF/DOCX) dan ukuran max 10 MB
- [x] `Admin\DocumentController@update` — ganti dokumen (hapus lama, upload baru)
- [x] `Admin\DocumentController@destroy` — hapus dokumen dari disk + DB
- [x] `Admin\DocumentController` — reorder dokumen per sub acara via input angka order biasa

### Timeline
- [x] `Admin\TimelineController` — CRUD timeline (hanya Admin)
- [x] `Admin\TimelineController` — reorder timeline via input angka order biasa

### Audit Log
- [x] Pencatatan log aktivitas otomatis untuk setiap perubahan sensitif ke tabel `audit_logs`
- [x] `Admin\AuditLogController` — melihat riwayat log dengan filter operator & pagination (Admin)

---

## Frontend — Halaman Publik (Blade)

- [x] Layout publik (`layouts/public.blade.php`) — fonts, Vite assets, SEO defaults
- [x] Landing page `home.blade.php` (hero, maskot, sponsors, sub acara, timeline, footer - Filosofi tema dihapus)
- [x] Blade component `navbar` (tersemat langsung di layout publik)
- [x] Blade component `hero` (tersemat langsung di beranda)
- [x] Blade component `mascot` (tersemat langsung di beranda)
- [x] Blade component `sub-event-cards` (tersemat langsung di beranda dengan tipe pelaksanaan & lokasi)
- [x] Blade component `timeline` (tersemat langsung di beranda)
- [x] Blade component `footer` (tersemat langsung di layout publik)
- [x] Halaman detail per sub acara (`sub-event-detail.blade.php` dengan tipe pelaksanaan & lokasi)
- [x] Bagian unduh dokumen template di halaman detail (tampil kondisional jika ada dokumen)
- [x] Tombol "Daftar" dengan state disabled untuk status Ditutup / tautan kosong
- [x] Empty state saat belum ada sub acara di tahun aktif (`@forelse` / `@empty`)
- [x] Responsive di seluruh breakpoint (mobile, tablet, desktop)
- [x] Metadata SEO & Open Graph per sub acara (`@section('title')`, `@section('og-*')`)

---

## Frontend — Panel Admin (Blade + Alpine.js)

- [x] Halaman login (Breeze default, di-style ulang sesuai tema di rute `/auth`)
- [x] Layout admin (`layouts/admin.blade.php`) — sidebar sesuai role, year switcher, logout
- [x] Sidebar navigation: menu berbeda untuk Admin vs Kesekretariatan
- [x] Halaman manajemen user (create, deactivate/activate) — Admin
- [x] Halaman daftar & form CRUD sub acara (dilengkapi tipe pelaksanaan & lokasi) — Admin
- [x] Halaman upload & kelola dokumen template per sub acara — Admin
- [x] Halaman kelola timeline (CRUD) — Admin
- [x] Halaman update tautan Google Form — Admin & Kesekretariatan
- [x] Halaman riwayat log aktivitas (filter, pagination) — Admin
- [x] Multi-tahun switcher (simpan di session)
- [x] Konfirmasi sebelum hapus/nonaktifkan data (modal konfirmasi via native JS/Alpine.js)
- [x] Toast notifications via `session('success')` / `session('error')`
- [x] Responsive khusus untuk akses dari mobile (sidebar collapse)

---

## Keamanan

- [x] Hashing password (`Hash::make()` — bcrypt, built-in Laravel)
- [x] Rate limiting pada login (`RateLimiter` — throttle bawaan Breeze)
- [x] CSRF protection pada form (`@csrf` — built-in Laravel)
- [x] Validasi & sanitasi input di semua form (Laravel FormRequest / controller validation)
- [x] Validasi file upload (tipe MIME, ukuran, `mimes:pdf,docx|max:10240`)
- [x] Proteksi route berbasis role di level middleware (`RoleMiddleware`), bukan hanya UI
- [x] Storage symlink (`php artisan storage:link`)

---

## Testing & QA

- [x] Uji alur registrasi user Kesekretariatan oleh Admin
- [x] Uji batasan akses Kesekretariatan (tidak bisa akses menu di luar tautan pendaftaran)
- [x] Uji status sub acara (Draft tidak tampil publik, Ditutup nonaktifkan tombol)
- [x] Uji upload/hapus/ganti dokumen template
- [x] Uji validasi format tautan Google Form
- [x] Uji tampilan di berbagai ukuran layar
- [x] Uji alur ganti password paksa (force password change) & reset oleh admin (rute lupa password email dinonaktifkan)
- [x] Uji rate limiting login gagal
- [x] `php artisan test` — jalankan feature & unit tests (100% Passed)
- [x] `php artisan route:list` — verifikasi semua route terdaftar

---

## Deployment & Operasional (Hostinger)

- [ ] Buat database MySQL baru di hPanel Hostinger
- [ ] Upload project ke Hostinger (Git SSH atau FTP)
- [ ] Konfigurasi `.env` production (DB, mail, APP_URL)
- [ ] `php artisan key:generate`
- [ ] `php artisan migrate --seed`
- [ ] `php artisan storage:link`
- [ ] `npm install && npm run build`
- [ ] Set permissions (`chmod -R 775 storage bootstrap/cache`)
- [ ] Arahkan domain ke folder `public/` project
- [ ] Konfigurasi SMTP email (Hostinger email hosting)
- [ ] Seed akun Superadmin pertama di environment production
- [ ] Dokumentasi singkat cara pakai panel admin untuk panitia (khusus role Kesekretariatan)

---

## Fase Lanjutan (Belum Prioritas)

- [ ] Notifikasi in-app saat tautan pendaftaran diubah
- [ ] Versi/indikator "Diperbarui pada" untuk dokumen template
- [ ] Pendaftaran in-house tanpa Google Form
- [ ] Sistem pembayaran online terintegrasi
- [ ] Role granular tambahan per sub acara

---

## Panduan Docker (Reproducible Dev Environment)

Agar sesama developer dapat menjalankan project ini dengan versi PHP/MySQL yang 100% identik secara instan, Anda dapat menggunakan Docker Compose yang telah dikonfigurasi:

### Prasyarat
- [Docker Desktop](https://www.docker.com/products/docker-desktop/) (termasuk Docker Compose) terpasang di komputer Anda.

### Cara Menjalankan
1. Masuk ke folder Laravel:
   ```bash
   cd parti2026
   ```
2. Buat file `.env` dengan menyalin `.env.example`:
   ```bash
   cp .env.example .env
   ```
3. Sesuaikan konfigurasi database di `.env` agar terhubung ke container MySQL:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=db
   DB_PORT=3306
   DB_DATABASE=parti2026
   DB_USERNAME=parti_user
   DB_PASSWORD=parti_password
   ```
4. Jalankan container Docker:
   ```bash
   docker compose up -d
   ```
5. Install dependensi composer di dalam container:
   ```bash
   docker compose exec web composer install
   ```
6. Jalankan generator app key:
   ```bash
   docker compose exec web php artisan key:generate
   ```
7. Jalankan migrasi dan seeding database:
   ```bash
   docker compose exec web php artisan migrate --seed
   ```
8. Buat symlink storage:
   ```bash
   docker compose exec web php artisan storage:link
   ```

Aplikasi web sekarang dapat diakses secara lokal di **`http://localhost:8000`** dengan database MySQL yang berjalan di background port `3306`.
