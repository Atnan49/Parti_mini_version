# PRD — Website PARTI 2026
**Product Requirements Document**
*HIMATIF UMS — Vanguard of Tech*

---

## 1. Ringkasan Produk

Website PARTI 2026 adalah platform informasi & manajemen acara tahunan HIMATIF, dengan
arsitektur yang dirancang **reusable per tahun** (theme/data separation). Selain sebagai
landing page publik, website ini punya panel admin internal untuk mengelola konten sub
acara, timeline, dan tautan pendaftaran (Google Form), dengan pembagian akses berjenjang
antara **Admin** dan **Kesekretariatan**.

**Tujuan utama:**
- Publik bisa melihat info acara & mendaftar dengan mudah
- Panitia (kesekretariatan) bisa update link pendaftaran tanpa harus minta bantuan developer
- Admin punya kontrol penuh atas konten & struktur acara, tanpa perlu edit kode setiap tahun

---

## 2. User Roles & Definisi Akses

| Role | Deskripsi | Dibuat oleh |
|---|---|---|
| **Superadmin (Admin)** | Pemegang kendali penuh sistem. Biasanya PJ IT/Web PARTI. | Seed awal (satu-satunya cara buat akun ini, tidak lewat UI publik) |
| **Kesekretariatan** | Panitia sie kesekretariatan. Akses terbatas: hanya boleh update link Google Form pendaftaran per sub acara. | Dibuat oleh Superadmin lewat panel admin |
| **Publik / Pengunjung** | Tidak login. Melihat landing page, klik daftar → diarahkan ke Google Form sub acara terkait. | — |

### Matriks Hak Akses

| Aksi | Superadmin | Kesekretariatan | Publik |
|---|:---:|:---:|:---:|
| Login ke panel admin | ✅ | ✅ | ❌ |
| Membuat akun kesekretariatan baru | ✅ | ❌ | ❌ |
| Menonaktifkan/menghapus akun kesekretariatan | ✅ | ❌ | ❌ |
| Membuat sub acara baru | ✅ | ❌ | ❌ |
| Mengedit detail sub acara (nama, tanggal, deskripsi, HTM, PJ, dll) | ✅ | ❌ | ❌ |
| Menghapus sub acara | ✅ | ❌ | ❌ |
| **Mengubah link Google Form pendaftaran per sub acara** | ✅ | ✅ | ❌ |
| Mengubah status sub acara (draft/published/ditutup) | ✅ | ❌ | ❌ |
| Membuat/mengedit timeline acara | ✅ | ❌ | ❌ |
| Melihat landing page publik | ✅ | ✅ | ✅ |
| Klik "Daftar" → redirect ke Google Form | ✅ | ✅ | ✅ |

> **Prinsip:** Kesekretariatan itu role sempit dan spesifik — cuma bisa sentuh field
> `gformLink` di sub acara yang sudah dibuat Admin. Ini disengaja supaya struktur acara
> (nama, tanggal, deskripsi) tetap terkontrol satu pintu di Admin, sementara update link
> pendaftaran (yang sering berubah-ubah menjelang hari-H) bisa didelegasikan tanpa risiko.

---

## 3. Fitur Utama

### 3.1 Autentikasi & Manajemen User (Admin only)
- Login dengan email + password (role-based)
- Admin dapat membuat akun baru dengan role `KESEKRETARIATAN` (input: nama, email, password sementara)
- Admin dapat menonaktifkan (bukan hard delete, demi audit trail) akun kesekretariatan
- Kesekretariatan wajib ganti password saat login pertama kali
- Forgot password flow (reset via email)

**Acceptance criteria:**
- User dengan role `KESEKRETARIATAN` yang login tidak bisa mengakses menu "Buat Sub Acara", "Edit Timeline", atau "Manajemen User" — baik dari UI maupun langsung lewat URL (proteksi di level middleware/API, bukan cuma disembunyikan di UI)

### 3.2 Manajemen Sub Acara (Admin only, kecuali field link)
- CRUD sub acara: nama, tagline, tanggal mulai/selesai, deskripsi, PJ, HTM (bisa multi-tier), status
- Field `gformLink` tetap ada di form yang sama, tapi **hanya bisa disave oleh Admin atau Kesekretariatan** — role lain tidak relevan karena tidak ada role lain
- Status sub acara: `Draft` (belum tayang) → `Published` (tayang, pendaftaran buka) → `Ditutup` (tayang tapi tombol daftar nonaktif)
- Reorder sub acara (drag-and-drop atau input `order`) untuk urutan tampil di landing page

### 3.3 Manajemen Link Pendaftaran (Admin + Kesekretariatan)
- Kesekretariatan login → lihat daftar sub acara yang sudah dibuat Admin → klik salah satu → update field link Google Form saja
- Validasi format URL (harus domain `docs.google.com/forms` atau `forms.gle`) sebelum tersimpan, supaya tidak salah paste link
- Setiap perubahan tercatat di log aktivitas (siapa, kapan, link lama → link baru)

### 3.4 Manajemen Timeline (Admin only)
- CRUD item timeline: tanggal, judul, deskripsi, dan opsional dikaitkan ke sub acara tertentu
- Reorder timeline
- Timeline otomatis tampil di landing page sesuai urutan tanggal

### 3.5 Pendaftaran (Publik)
- Tombol "Daftar" di tiap kartu sub acara → redirect (`target="_blank"`) ke `gformLink` milik sub acara tersebut
- Kalau status sub acara = `Draft` → kartu tidak tampil di publik sama sekali
- Kalau status = `Ditutup` → kartu tetap tampil, tapi tombol daftar berubah jadi non-aktif/disabled dengan label "Pendaftaran Ditutup"
- Kalau `gformLink` masih kosong (Admin belum sempat isi) → tombol daftar otomatis disabled dengan label "Segera Dibuka", supaya tidak ada broken link ke publik

---

## 4. Alur Pengguna (User Flow)

**Admin — Setup awal tahun acara:**
1. Login → buat sub acara baru (status default: Draft)
2. Isi detail lengkap → set status jadi Published saat siap tayang
3. Buat akun kesekretariatan untuk panitia terkait
4. Susun/edit timeline global

**Kesekretariatan — Update link pendaftaran:**
1. Login → lihat daftar sub acara (read-only untuk semua field kecuali link)
2. Pilih sub acara → paste link Google Form → simpan
3. Sistem validasi format link → tersimpan → log tercatat

**Publik — Mendaftar acara:**
1. Buka landing page → lihat sub acara yang tayang
2. Klik "Daftar" pada sub acara yang diminati
3. Diarahkan ke Google Form terkait di tab baru

---

## 5. Skema Data (Draf Awal)

```
User
  id, name, email, passwordHash, role [SUPERADMIN | KESEKRETARIATAN],
  isActive, createdBy, createdAt

SubEvent
  id, year, name, slug, tagline, description,
  dateStart, dateEnd, pjNames[], htmTiers (json),
  gformLink, gformUpdatedBy, gformUpdatedAt,
  status [DRAFT | PUBLISHED | CLOSED], order, createdAt, updatedAt

TimelineItem
  id, year, subEventId (nullable), date, title, description, order

AuditLog
  id, userId, action, entityType, entityId,
  fieldChanged, oldValue, newValue, timestamp
```

> Struktur ini tetap mempertahankan prinsip **theme/data separation** dari plan
> sebelumnya — `year` di tiap entity memungkinkan data 2026, 2027, dst hidup
> berdampingan tanpa saling tabrak, dan tema visual tetap terpisah dari data ini.

---

## 6. Non-Functional Requirements

- **Keamanan:** Password di-hash (bcrypt/argon2), proteksi route admin via middleware (bukan cuma UI), rate limiting di endpoint login, CSRF protection di form
- **Performa:** Landing page publik idealnya di-render statis/ISR (jarang berubah, banyak diakses) — panel admin boleh full dynamic/SSR
- **Audit trail:** Semua perubahan sensitif (link gform, status sub acara, manajemen user) tercatat di `AuditLog`
- **Responsif:** Panel admin tetap harus nyaman diakses dari HP, karena kesekretariatan kemungkinan besar update link dari HP saat di lapangan
- **Reusability:** Struktur data & komponen harus bisa dipakai ulang tahun depan cukup dengan ganti data tahun aktif, bukan re-develop dari nol

---

## 7. Rekomendasi Tambahan (Supaya Use Case-nya Kena Semua)

Beberapa hal ini tidak eksplisit kamu minta, tapi penting supaya sistem tidak punya
celah use case yang kelupaan:

1. **Preview mode sebelum publish** — Admin bisa lihat tampilan sub acara di publik
   sebelum ubah status ke Published, biar tidak ada typo/salah tanggal yang keburu tayang
2. **Validasi & disabled state untuk link kosong/status closed** — sudah dijelaskan di
   3.5, ini penting supaya publik tidak pernah ketemu broken link
3. **Log aktivitas khusus untuk link gform** — karena field ini "dipegang bersama" dua
   role, histori perubahan penting untuk audit kalau ada salah link menjelang hari-H
4. **Reset password & akun nonaktif (bukan delete)** — supaya kalau ganti panitia
   kesekretariatan tahun depan, histori tetap ada dan tidak perlu hapus data
5. **Multi-tahun switcher di admin panel** — dropdown pilih "tahun aktif" (2026, 2027...)
   supaya data lama tidak tertimpa dan tetap bisa diarsipkan/dilihat kembali
6. **Notifikasi sederhana (opsional, bisa fase 2)** — Admin dapat notifikasi in-app
   kalau kesekretariatan baru saja mengubah link, sebagai lapisan kontrol tambahan
7. **SEO & Open Graph per sub acara** — biar pas di-share ke WhatsApp/Instagram,
   preview link-nya menampilkan gambar & judul sub acara yang benar
8. **Konfirmasi sebelum hapus sub acara** — mengingat sub acara terhubung ke timeline
   & log, hapus harus soft-delete dulu (bisa di-restore) bukan langsung hilang permanen
9. **Empty state yang jelas** — kalau belum ada sub acara sama sekali di tahun aktif,
   landing page publik menampilkan pesan yang jelas, bukan halaman kosong/error

---

## 8. Rekomendasi Tech Stack

Menyesuaikan stack yang sudah kamu pakai (Next.js 15 + Tailwind):

| Kebutuhan | Rekomendasi |
|---|---|
| Framework | Next.js 15 (App Router) |
| Styling | Tailwind CSS |
| Database | PostgreSQL (Neon/Supabase — kompatibel baik dengan Vercel) |
| ORM | Prisma |
| Autentikasi & RBAC | NextAuth.js (Credentials provider) + middleware untuk proteksi route `/admin/*` berdasarkan role |
| Deployment | Vercel (kamu sudah punya koneksi Vercel — bisa langsung dipakai untuk deploy & cek build/runtime logs) |
| Validasi form | Zod (dipakai bareng React Hook Form) |

---

## 9. Out of Scope (Fase Ini)

Supaya scope tetap jelas dan tidak melebar, hal berikut **sengaja tidak** masuk PRD ini:
- Pendaftaran in-house (tanpa Google Form) — masih pakai redirect ke Gform
- Sistem pembayaran online terintegrasi
- Multi-admin dengan hak akses granular per sub acara (baru ada 2 role: Admin & Kesekretariatan)
- Notifikasi email otomatis ke peserta

Kalau ke depan mau dikembangkan ke arah itu, bisa jadi PRD fase 2 tersendiri.
