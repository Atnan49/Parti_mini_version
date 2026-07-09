# PARTI 2026 — Development Checklist

Checklist pengembangan website PARTI 2026, disusun berdasarkan PRD.
Update status dengan mengganti `[ ]` menjadi `[x]` seiring progres pengerjaan.

---

## Setup & Struktur Proyek

- [ ] Inisialisasi proyek Next.js 15 (App Router) + Tailwind CSS
- [ ] Setup Prisma + koneksi PostgreSQL (Neon/Supabase)
- [ ] Setup NextAuth.js (Credentials provider)
- [ ] Struktur folder data per tahun (`/data/2026`, dst.) sesuai arsitektur theme/data separation
- [ ] Setup environment variables (`.env`) untuk DB, auth secret, storage
- [ ] Setup repository & branching workflow
- [ ] Koneksi awal ke Vercel untuk deployment

---

## Database & Schema (Prisma)

- [ ] Model `User` (id, name, email, passwordHash, role, isActive, createdBy, createdAt)
- [ ] Model `SubEvent` (id, year, name, slug, tagline, description, dateStart, dateEnd, pjNames, htmTiers, gformLink, gformUpdatedBy, gformUpdatedAt, status, order)
- [ ] Model `SubEventDocument` (id, subEventId, label, fileUrl, fileType, fileSizeBytes, order, uploadedBy, uploadedAt)
- [ ] Model `TimelineItem` (id, year, subEventId, date, title, description, order)
- [ ] Model `AuditLog` (id, userId, action, entityType, entityId, fieldChanged, oldValue, newValue, timestamp)
- [ ] Migrasi awal & seed data (akun Superadmin pertama)
- [ ] Relasi antar model (SubEvent ↔ SubEventDocument, SubEvent ↔ TimelineItem)

---

## Backend / API

### Autentikasi & User
- [ ] Endpoint login (email + password)
- [ ] Endpoint reset password / forgot password
- [ ] Endpoint ganti password wajib saat login pertama (khusus Kesekretariatan)
- [ ] Endpoint create user (role Kesekretariatan) — hanya Admin
- [ ] Endpoint nonaktifkan user (soft-delete) — hanya Admin
- [ ] Middleware proteksi role untuk semua route `/admin/*`

### Sub Acara
- [ ] Endpoint CRUD sub acara — hanya Admin
- [ ] Endpoint update status sub acara (draft/published/closed) — hanya Admin
- [ ] Endpoint update tautan Google Form — Admin & Kesekretariatan
- [ ] Validasi format tautan (`docs.google.com/forms` / `forms.gle`)
- [ ] Endpoint reorder sub acara

### Dokumen Template
- [ ] Endpoint upload dokumen per sub acara — hanya Admin
- [ ] Validasi tipe file (PDF/DOCX) dan ukuran maksimum
- [ ] Endpoint hapus/ganti dokumen
- [ ] Endpoint reorder dokumen per sub acara

### Timeline
- [ ] Endpoint CRUD timeline — hanya Admin
- [ ] Endpoint reorder timeline

### Audit Log
- [ ] Middleware/helper pencatatan log otomatis untuk setiap perubahan sensitif
- [ ] Endpoint melihat riwayat log (Admin)

---

## Frontend — Halaman Publik

- [ ] Landing page (hero, maskot, sponsor, sub acara, timeline, footer)
- [ ] Komponen sponsor (grid/logo sponsor, sumber data dari `data/2026/sponsors.json` mengikuti pola theme/data separation)
- [ ] Komponen kartu sub acara (dengan status badge: tersedia/ditutup/segera dibuka)
- [ ] Halaman detail per sub acara
- [ ] Bagian unduh dokumen template di halaman detail (tampil kondisional jika ada dokumen)
- [ ] Tombol "Daftar" dengan state disabled untuk status Ditutup / tautan kosong
- [ ] Komponen timeline (urut berdasarkan tanggal)
- [ ] Empty state saat belum ada sub acara di tahun aktif
- [ ] Responsive di seluruh breakpoint (mobile, tablet, desktop)
- [ ] Metadata SEO & Open Graph per sub acara

---

## Frontend — Panel Admin

- [ ] Halaman login
- [ ] Layout admin dengan sidebar/menu sesuai role (menu berbeda untuk Admin vs Kesekretariatan)
- [ ] Halaman manajemen user (create, nonaktifkan) — Admin
- [ ] Halaman daftar & form CRUD sub acara — Admin
- [ ] Form upload & kelola dokumen template per sub acara — Admin
- [ ] Halaman kelola timeline — Admin
- [ ] Halaman update tautan Google Form — Admin & Kesekretariatan
- [ ] Halaman riwayat log aktivitas — Admin
- [ ] Multi-tahun switcher (pilih tahun aktif)
- [ ] Preview mode sub acara sebelum publish
- [ ] Konfirmasi sebelum hapus/nonaktifkan data (modal konfirmasi)
- [ ] Responsive khusus untuk akses dari mobile (kesekretariatan sering akses dari lapangan)

---

## Keamanan

- [ ] Hashing password (bcrypt/argon2)
- [ ] Rate limiting pada endpoint login
- [ ] CSRF protection pada form
- [ ] Validasi & sanitasi input di semua form (Zod)
- [ ] Validasi file upload (tipe, ukuran, scanning dasar) untuk mencegah file berbahaya
- [ ] Proteksi route berbasis role di level middleware, bukan hanya UI

---

## Testing & QA

- [ ] Uji alur registrasi user Kesekretariatan oleh Admin
- [ ] Uji batasan akses Kesekretariatan (tidak bisa akses menu di luar tautan pendaftaran)
- [ ] Uji status sub acara (Draft tidak tampil publik, Ditutup nonaktifkan tombol)
- [ ] Uji upload/hapus/ganti dokumen template
- [ ] Uji validasi format tautan Google Form
- [ ] Uji tampilan di berbagai ukuran layar
- [ ] Uji alur lupa password

---

## Deployment & Operasional

- [ ] Setup database production (Neon/Supabase)
- [ ] Setup penyimpanan file (Vercel Blob atau alternatif)
- [ ] Deploy ke Vercel
- [ ] Setup domain custom (jika ada)
- [ ] Seed akun Superadmin pertama di environment production
- [ ] Dokumentasi singkat cara pakai panel admin untuk panitia (khusus role Kesekretariatan)

---

## Fase Lanjutan (Belum Prioritas)

- [ ] Notifikasi in-app saat tautan pendaftaran diubah
- [ ] Versi/indikator "Diperbarui pada" untuk dokumen template
- [ ] Pendaftaran in-house tanpa Google Form
- [ ] Sistem pembayaran online terintegrasi
- [ ] Role granular tambahan per sub acara
