# PRD — Website PARTI 2026
**Product Requirements Document**
HIMATIF UMS — Vanguard of Tech

---

## 1. Ringkasan Produk

Website PARTI 2026 adalah platform informasi dan manajemen acara tahunan HIMATIF,
dengan arsitektur yang dirancang reusable per tahun (theme/data separation). Selain
berfungsi sebagai landing page publik, sistem ini memiliki panel admin internal untuk
mengelola konten sub acara, timeline, dokumen pendukung, dan tautan pendaftaran
(Google Form), dengan pembagian akses berjenjang antara Admin dan Kesekretariatan.

**Tujuan produk:**
- Publik dapat melihat informasi acara dan mendaftar dengan mudah
- Panitia kesekretariatan dapat memperbarui tautan pendaftaran tanpa bergantung pada developer
- Admin memiliki kendali penuh atas konten dan struktur acara, tanpa perlu mengubah kode setiap tahun
- Peserta yang membutuhkan dokumen persyaratan dapat mengunduhnya langsung dari halaman sub acara sebelum mendaftar

---

## 2. User Roles & Definisi Akses

| Role | Deskripsi | Dibuat oleh |
|---|---|---|
| Superadmin (Admin) | Pemegang kendali penuh sistem. | Seed awal sistem, tidak dapat dibuat lewat UI publik |
| Kesekretariatan | Panitia sie kesekretariatan. Akses terbatas pada pembaruan tautan Google Form pendaftaran per sub acara. | Dibuat oleh Superadmin melalui panel admin |
| Publik / Pengunjung | Tidak melakukan login. Mengakses landing page, mengunduh dokumen template (jika tersedia), lalu diarahkan ke Google Form sub acara terkait. | — |

### Matriks Hak Akses

| Aksi | Superadmin | Kesekretariatan | Publik |
|---|:---:|:---:|:---:|
| Login ke panel admin | ✅ | ✅ | ❌ |
| Membuat akun kesekretariatan baru | ✅ | ❌ | ❌ |
| Menonaktifkan akun kesekretariatan | ✅ | ❌ | ❌ |
| Membuat sub acara baru | ✅ | ❌ | ❌ |
| Mengedit detail sub acara | ✅ | ❌ | ❌ |
| Menghapus sub acara | ✅ | ❌ | ❌ |
| Mengubah tautan Google Form pendaftaran per sub acara | ✅ | ✅ | ❌ |
| Mengubah status sub acara (draft/published/ditutup) | ✅ | ❌ | ❌ |
| Mengelola timeline acara | ✅ | ❌ | ❌ |
| Mengunggah/mengelola dokumen template per sub acara | ✅ | ❌ | ❌ |
| Melihat landing page publik | ✅ | ✅ | ✅ |
| Mengunduh dokumen template | ✅ | ✅ | ✅ |
| Mengakses tautan pendaftaran | ✅ | ✅ | ✅ |

Role Kesekretariatan dirancang sempit dan spesifik, hanya memiliki akses pada field
tautan pendaftaran di sub acara yang telah dibuat Admin. Struktur acara (nama, tanggal,
deskripsi, dokumen) tetap dikendalikan satu pintu oleh Admin, sementara pembaruan
tautan pendaftaran—yang cenderung berubah menjelang hari pelaksanaan—dapat
didelegasikan tanpa mengubah struktur data inti.

---

## 3. Fitur Utama

### 3.1 Autentikasi & Manajemen User (Admin)
- Login dengan email dan password berbasis role
- Admin membuat akun baru dengan role Kesekretariatan (input: nama, email, password sementara)
- Admin menonaktifkan akun kesekretariatan melalui soft-delete, bukan penghapusan permanen
- Kesekretariatan diwajibkan mengganti password pada login pertama
- Tersedia alur reset password melalui email

Kriteria penerimaan: user dengan role Kesekretariatan tidak dapat mengakses menu
"Buat Sub Acara", "Edit Timeline", "Kelola Dokumen", atau "Manajemen User"—baik dari
UI maupun melalui akses langsung ke URL. Proteksi diterapkan di level middleware/API,
bukan hanya disembunyikan pada tampilan.

### 3.2 Manajemen Sub Acara (Admin)
- CRUD sub acara: nama, tagline, tanggal mulai/selesai, deskripsi, PJ, HTM (multi-tier), status
- Status sub acara terdiri dari tiga tahap: Draft (belum tayang), Published (tayang, pendaftaran terbuka), dan Ditutup (tayang, tombol pendaftaran nonaktif)
- Sub acara dapat diurutkan ulang untuk menentukan urutan tampil di landing page

### 3.3 Manajemen Tautan Pendaftaran (Admin & Kesekretariatan)
- Kesekretariatan melihat daftar sub acara yang telah dibuat Admin, memilih salah satu, lalu memperbarui field tautan Google Form
- Format tautan divalidasi (domain `docs.google.com/forms` atau `forms.gle`) sebelum disimpan
- Setiap perubahan tautan tercatat pada log aktivitas: pelaku, waktu, nilai lama, dan nilai baru

### 3.4 Manajemen Timeline (Admin)
- CRUD item timeline: tanggal, judul, deskripsi, dan opsi keterkaitan dengan sub acara tertentu
- Item timeline dapat diurutkan ulang
- Timeline tampil di landing page sesuai urutan tanggal

### 3.5 Manajemen Dokumen Template Sub Acara (Admin)
Sejumlah sub acara mengharuskan peserta mengisi dokumen tertentu (misalnya surat
pernyataan orisinalitas, formulir tim, atau TOR) sebelum mendaftar. Dokumen ini
disediakan oleh Admin dan ditampilkan pada halaman detail sub acara agar dapat
diunduh peserta sebelum menekan tombol pendaftaran.

- Admin dapat mengunggah satu atau lebih dokumen per sub acara, masing-masing dengan nama label (contoh: "Formulir Pendaftaran Tim", "Surat Pernyataan Orisinalitas")
- Format file yang didukung: PDF dan DOCX, dengan batas ukuran file yang ditentukan pada tahap desain teknis
- Admin dapat mengganti atau menghapus dokumen yang telah diunggah
- Dokumen bersifat opsional per sub acara—sub acara tanpa dokumen tidak menampilkan bagian ini di halaman detail
- Setiap dokumen memiliki urutan tampil yang dapat diatur ulang oleh Admin

Kriteria penerimaan: pada halaman detail sub acara yang memiliki dokumen template,
bagian unduhan dokumen ditampilkan di atas atau berdekatan dengan tombol pendaftaran,
sehingga peserta memperoleh dokumen yang diperlukan sebelum mengakses Google Form.

### 3.6 Pendaftaran (Publik)
- Tombol "Daftar" pada tiap kartu sub acara mengarahkan (pada tab baru) ke tautan Google Form milik sub acara terkait
- Sub acara berstatus Draft tidak ditampilkan pada halaman publik
- Sub acara berstatus Ditutup tetap ditampilkan, namun tombol pendaftaran dinonaktifkan dengan label "Pendaftaran Ditutup"
- Sub acara dengan tautan pendaftaran kosong menampilkan tombol nonaktif berlabel "Segera Dibuka", untuk mencegah tautan rusak yang diakses publik

---

## 4. Alur Pengguna

**Admin — Persiapan awal tahun acara:**
1. Login, membuat sub acara baru dengan status default Draft
2. Mengisi detail lengkap, mengunggah dokumen template bila diperlukan, kemudian mengubah status menjadi Published saat siap tayang
3. Membuat akun kesekretariatan untuk panitia terkait
4. Menyusun dan mengelola timeline global

**Kesekretariatan — Pembaruan tautan pendaftaran:**
1. Login, melihat daftar sub acara (hanya field tautan yang dapat diubah)
2. Memilih sub acara, memperbarui tautan Google Form, menyimpan perubahan
3. Sistem memvalidasi format tautan dan mencatat perubahan pada log aktivitas

**Publik — Mendaftar acara:**
1. Membuka landing page, melihat sub acara yang tayang
2. Membuka detail sub acara yang diminati
3. Mengunduh dokumen template bila tersedia
4. Menekan tombol "Daftar", diarahkan ke Google Form terkait pada tab baru

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

SubEventDocument
  id, subEventId, label, fileUrl, fileType, fileSizeBytes,
  order, uploadedBy, uploadedAt

TimelineItem
  id, year, subEventId (nullable), date, title, description, order

AuditLog
  id, userId, action, entityType, entityId,
  fieldChanged, oldValue, newValue, timestamp
```

Struktur ini mempertahankan prinsip theme/data separation dari perencanaan awal.
Field `year` pada tiap entity memungkinkan data antar tahun (2026, 2027, dst.) hidup
berdampingan tanpa saling menimpa, sementara tema visual tetap terpisah dari data.

---

## 6. Non-Functional Requirements

- **Keamanan:** password di-hash (bcrypt/argon2), proteksi route admin melalui middleware, rate limiting pada endpoint login, validasi tipe dan ukuran file pada fitur unggah dokumen untuk mencegah unggahan berbahaya
- **Performa:** landing page publik idealnya di-render statis/ISR; panel admin dapat sepenuhnya dinamis (SSR)
- **Audit trail:** seluruh perubahan sensitif (tautan pendaftaran, status sub acara, manajemen user, unggah/hapus dokumen) tercatat pada AuditLog
- **Responsif:** panel admin harus dapat diakses dengan nyaman melalui perangkat mobile, mengingat pembaruan tautan sering dilakukan langsung dari lokasi acara
- **Reusability:** struktur data dan komponen dapat dipakai ulang pada tahun berikutnya cukup dengan mengganti data tahun aktif

---

## 7. Rekomendasi Tambahan

Sejumlah hal berikut tidak diminta secara eksplisit, namun relevan untuk menutup
celah use case yang berpotensi terlewat:

1. **Preview mode sebelum publish** — Admin dapat melihat tampilan sub acara di sisi publik sebelum status diubah menjadi Published
2. **Validasi dan status nonaktif untuk tautan kosong atau sub acara ditutup** — mencegah publik mengakses tautan rusak
3. **Log aktivitas khusus untuk tautan pendaftaran dan dokumen** — field ini dikelola oleh lebih dari satu pihak (dokumen oleh Admin, tautan oleh Admin dan Kesekretariatan), sehingga histori perubahan penting untuk audit
4. **Reset password dan status akun nonaktif (bukan hapus permanen)** — memudahkan pergantian panitia kesekretariatan antar tahun tanpa kehilangan histori
5. **Multi-tahun switcher pada panel admin** — memilih tahun aktif agar data antar tahun tidak saling tertimpa
6. **Notifikasi in-app (fase lanjutan)** — Admin menerima notifikasi saat Kesekretariatan mengubah tautan pendaftaran, sebagai lapisan kontrol tambahan
7. **SEO dan Open Graph per sub acara** — memastikan tautan yang dibagikan ke media sosial menampilkan judul dan gambar yang sesuai
8. **Soft-delete untuk sub acara** — mengingat sub acara terkait dengan timeline, dokumen, dan log, penghapusan sebaiknya dapat dipulihkan
9. **Empty state yang jelas** — bila belum ada sub acara pada tahun aktif, landing page publik menampilkan pesan informatif, bukan halaman kosong
10. **Penamaan dan versi dokumen template** — bila Admin mengganti dokumen template setelah beberapa peserta sudah mengunduh versi sebelumnya, sistem sebaiknya menampilkan indikator "Diperbarui pada [tanggal]" agar peserta mengetahui adanya perubahan

---

## 8. Tech Stack

| Kebutuhan | Pilihan |
|---|---|
| Framework | Laravel 11 (PHP 8.2+) |
| Frontend | Blade Templates + Alpine.js |
| Styling | Tailwind CSS (via Vite) |
| Database | MySQL (bawaan Hostinger) |
| ORM | Eloquent |
| Autentikasi & RBAC | Laravel Breeze (Credentials) + custom RoleMiddleware untuk proteksi route `/admin/*` berdasarkan role |
| Penyimpanan dokumen | Local filesystem (`storage/app/public/documents/`) — file PDF/DOCX yang diunggah Admin disimpan di disk server |
| Deployment | Hostinger Shared Hosting |
| Validasi form | Laravel FormRequest (server-side) + HTML5 validation (client-side) |

---

## 9. Out of Scope (Fase Ini)

- Pendaftaran in-house tanpa Google Form
- Sistem pembayaran online terintegrasi
- Hak akses granular per sub acara dengan lebih dari dua role
- Notifikasi email otomatis ke peserta
- Fitur unggah dokumen oleh peserta (dokumen pada fase ini bersifat satu arah: disediakan Admin untuk diunduh, bukan diunggah balik oleh peserta)
