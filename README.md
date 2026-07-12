# PARTI 2026 — Development Checklist

Checklist pengembangan website PARTI 2026, disusun berdasarkan PRD.
Update status dengan mengganti `[ ]` menjadi `[x]` seiring progres pengerjaan.

**Tech Stack:** Laravel 11 · Blade · Tailwind CSS · Alpine.js · MySQL · Hostinger

---

## Setup & Struktur Proyek

- [ ] Inisialisasi proyek Laravel 11 (`composer create-project laravel/laravel parti2026`)
- [ ] Install Laravel Breeze (`php artisan breeze:install blade`)
- [ ] Setup Tailwind CSS + Alpine.js + SortableJS via Vite
- [ ] Konfigurasi koneksi MySQL (`.env`)
- [ ] Buat `config/parti.php` (year aktif, batas upload, tipe file, domain gform)
- [ ] Setup environment variables (`.env`) untuk DB, mail, app URL
- [ ] Setup repository & branching workflow

---

## Database & Schema (Eloquent)

- [ ] Migration `users` (id, name, email, password, role, is_active, must_change_password, created_by)
- [ ] Migration `sub_events` (id, year, name, slug, tagline, description, date_start, date_end, pj_names, htm_tiers, gform_link, gform_updated_by, gform_updated_at, status, order, is_deleted)
- [ ] Migration `sub_event_documents` (id, sub_event_id, label, file_path, file_type, file_size_bytes, order, uploaded_by, uploaded_at)
- [ ] Migration `timeline_items` (id, year, sub_event_id, date, title, description, order)
- [ ] Migration `audit_logs` (id, user_id, action, entity_type, entity_id, field_changed, old_value, new_value, created_at)
- [ ] Eloquent Model `User` (scopes, relationships, disable self-registration)
- [ ] Eloquent Model `SubEvent` (JSON casts, scopes, relationships, slug auto-generate)
- [ ] Eloquent Model `SubEventDocument` (relationships, file delete on model delete)
- [ ] Eloquent Model `TimelineItem` (relationships, scopes)
- [ ] Eloquent Model `AuditLog` (relationships, scopes)
- [ ] Migrasi awal & seed data (`AdminSeeder` + `SubEventSeeder`)
- [ ] Relasi antar model (SubEvent ↔ SubEventDocument, SubEvent ↔ TimelineItem)

---

## Backend — Controllers & Routes

### Autentikasi & User
- [ ] Login via Laravel Breeze (email + password)
- [ ] Disable registrasi publik (hapus route register)
- [ ] Reset password / forgot password via email (Breeze built-in + SMTP Hostinger)
- [ ] `ForcePasswordChange` middleware — redirect saat login pertama Kesekretariatan
- [ ] `Admin\UserController` — create user Kesekretariatan, hanya Admin
- [ ] `Admin\UserController` — deactivate/activate user (soft-toggle), hanya Admin
- [ ] `RoleMiddleware` — proteksi route berdasarkan role (`role:SUPERADMIN`)

### Sub Acara
- [ ] `Admin\SubEventController` — CRUD sub acara (hanya Admin)
- [ ] `Admin\SubEventController@updateStatus` — update status draft/published/closed (hanya Admin)
- [ ] `Admin\RegistrationLinkController` — update tautan Google Form (Admin & Kesekretariatan)
- [ ] `GformLinkRequest` — validasi format tautan (`docs.google.com/forms` / `forms.gle`)
- [ ] `Admin\SubEventController@reorder` — reorder sub acara via AJAX

### Dokumen Template
- [ ] `Admin\DocumentController@store` — upload dokumen per sub acara (hanya Admin)
- [ ] `DocumentRequest` — validasi tipe file (PDF/DOCX) dan ukuran max 10 MB
- [ ] `Admin\DocumentController@update` — ganti dokumen (hapus lama, upload baru)
- [ ] `Admin\DocumentController@destroy` — hapus dokumen dari disk + DB
- [ ] `Admin\DocumentController@reorder` — reorder dokumen per sub acara

### Timeline
- [ ] `Admin\TimelineController` — CRUD timeline (hanya Admin)
- [ ] `Admin\TimelineController@reorder` — reorder timeline via AJAX

### Audit Log
- [ ] `AuditService` — helper pencatatan log otomatis untuk setiap perubahan sensitif
- [ ] `Admin\AuditLogController` — melihat riwayat log dengan filter & pagination (Admin)

---

## Frontend — Halaman Publik (Blade)

- [ ] Layout publik (`layouts/public.blade.php`) — fonts, Vite assets, SEO defaults
- [ ] Landing page `home.blade.php` (hero, filosofi, maskot, sub acara, timeline, footer)
- [ ] Blade component `navbar` (sticky nav, hamburger menu via Alpine.js)
- [ ] Blade component `hero` (eyebrow, heading, tagline, CTA, crest SVG animasi)
- [ ] Blade component `philosophy` (blockquote, attrib bar)
- [ ] Blade component `mascot` (grid 2 kolom, frame SVG, deskripsi)
- [ ] Blade component `sub-event-cards` (grid kartu, status badge: tersedia/ditutup/segera dibuka)
- [ ] Blade component `timeline` (track horizontal desktop / vertikal mobile)
- [ ] Blade component `footer` (brand, kolom link, copyright)
- [ ] Halaman detail per sub acara (`sub-event-detail.blade.php`)
- [ ] Bagian unduh dokumen template di halaman detail (tampil kondisional jika ada dokumen)
- [ ] Tombol "Daftar" dengan state disabled untuk status Ditutup / tautan kosong
- [ ] Empty state saat belum ada sub acara di tahun aktif (`@forelse` / `@empty`)
- [ ] Responsive di seluruh breakpoint (mobile, tablet, desktop)
- [ ] Metadata SEO & Open Graph per sub acara (`@section('title')`, `@section('og-*')`)

---

## Frontend — Panel Admin (Blade + Alpine.js)

- [ ] Halaman login (Breeze default, di-style ulang sesuai tema)
- [ ] Layout admin (`layouts/admin.blade.php`) — sidebar sesuai role, year switcher, logout
- [ ] Sidebar navigation: menu berbeda untuk Admin vs Kesekretariatan
- [ ] Halaman manajemen user (create, deactivate/activate) — Admin
- [ ] Halaman daftar & form CRUD sub acara — Admin
- [ ] Halaman upload & kelola dokumen template per sub acara — Admin
- [ ] Halaman kelola timeline (CRUD + reorder) — Admin
- [ ] Halaman update tautan Google Form — Admin & Kesekretariatan
- [ ] Halaman riwayat log aktivitas (filter, pagination) — Admin
- [ ] Multi-tahun switcher (simpan di session)
- [ ] Preview mode sub acara sebelum publish (`?preview=true`)
- [ ] Konfirmasi sebelum hapus/nonaktifkan data (modal via Alpine.js)
- [ ] Toast notifications via `session('success')` / `session('error')`
- [ ] Responsive khusus untuk akses dari mobile (sidebar collapse)

---

## Keamanan

- [ ] Hashing password (`Hash::make()` — bcrypt, built-in Laravel)
- [ ] Rate limiting pada login (`RateLimiter::for('login', ...)`)
- [ ] CSRF protection pada form (`@csrf` — built-in Laravel)
- [ ] Validasi & sanitasi input di semua form (Laravel FormRequest)
- [ ] Validasi file upload (tipe MIME, ukuran, `mimes:pdf,docx|max:10240`)
- [ ] Proteksi route berbasis role di level middleware (`RoleMiddleware`), bukan hanya UI
- [ ] Storage symlink (`php artisan storage:link`)

---

## Testing & QA

- [ ] Uji alur registrasi user Kesekretariatan oleh Admin
- [ ] Uji batasan akses Kesekretariatan (tidak bisa akses menu di luar tautan pendaftaran)
- [ ] Uji status sub acara (Draft tidak tampil publik, Ditutup nonaktifkan tombol)
- [ ] Uji upload/hapus/ganti dokumen template
- [ ] Uji validasi format tautan Google Form
- [ ] Uji tampilan di berbagai ukuran layar
- [ ] Uji alur lupa password (email reset)
- [ ] Uji rate limiting (6x login gagal → 429)
- [ ] `php artisan test` — jalankan feature & unit tests
- [ ] `php artisan route:list` — verifikasi semua route terdaftar

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

