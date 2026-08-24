# PARTI HIMATIF UMS 2026 — Official Event Platform

[![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.4-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-3.4-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)](https://alpinejs.dev)
[![PWA](https://img.shields.io/badge/PWA-Ready-5A0FC8?style=for-the-badge&logo=pwa&logoColor=white)](https://web.dev/progressive-web-apps/)

Platform web resmi **PARTI (Parade Teknik Informatika) 2026** yang diselenggarakan oleh **Himpunan Mahasiswa Teknik Informatika (HIMATIF) Universitas Muhammadiyah Surakarta**.

Aplikasi web ini dibangun dengan arsitektur modern berstandar industri (*macOS / iOS Glassmorphism Design System*), mengintegrasikan portal publik interaktif, manajemen multi-tahun (*multi-year switching*), manajemen sponsor bertingkat, sistem Q&A dinamis, serta optimasi SEO, AEO (Schema.org JSON-LD), dan GEO (Generative Engine Optimization).

---

## 🌟 Fitur Utama (Core Features)

### 🎨 Portal Publik (Public Portal)
- **Interactive Retro Shell**: Terminal WebGL/Interactive Shell di Hero Section untuk pengalaman pengguna bertema teknologi.
- **Dynamic Sub-Events**: Katalog sub-acara kompetisi & festival dengan indikator status pendaftaran real-time.
- **Dynamic FAQ Hub**: Pusat bantuan interaktif dengan pencarian cepat (*live search*), filter kategori pill, dan Schema `FAQPage` JSON-LD.
- **Timeline Acara**: Visualisasi alur waktu kegiatan bertema node interaktif.
- **PWA Service Worker**: Dukungan instalasi aplikasi seluler/desktop dan halaman cadangan offline.

### 🛡️ Panel Administrasi (Admin Panel)
- **Authentication Masking**: Proteksi URL autentikasi terisolasi untuk mengamankan sistem dari serangan otomatis.
- **Multi-Year Switcher**: Manajemen arsip event lintas tahun (2025 – 2030) dalam satu portal admin terpusat.
- **Manajemen Sub-Acara & Timeline**: Kontrol status pendaftaran, jadwal, deskripsi, dan tautan pendaftaran.
- **Manajemen Sponsor Bertingkat**: Pengelompokan sponsor berbasis tier (*Platinum, Gold, Silver, Bronze*) dengan running marquee animasi logoloop.
- **Manajemen FAQ (Q&A)**: Pengelolaan penuh data pertanyaan publik tanpa perlu menyunting kode.
- **Audit Logs & Keamanan**: Pencatatan riwayat aktivitas pengguna untuk transparansi data kepanitiaan.

---

## 🛠️ Spesifikasi Teknologi (Tech Stack)

- **Backend**: Laravel 13.x, PHP 8.4
- **Frontend**: Blade Templating, Tailwind CSS v3, Alpine.js 3.x
- **Database**: MySQL / PostgreSQL (Production Compatible)
- **Asset Bundler**: Vite 8.x
- **Optimization**: JSON-LD Structured Data (Schema.org), OpenGraph, Twitter Cards, Dynamic XML Sitemap, Dynamic Robots.txt, PWA Service Worker

---

## 📖 Dokumentasi Pengembangan & Deployment

Untuk menjaga kerapihan repositori, panduan teknis dipisahkan berdasarkan kebutuhan:

- 💻 **Instalasi Pengembangan Lokal (Docker & Manual)**: 
  Silakan baca berkas **[INSTALL_GUIDE.md](./INSTALL_GUIDE.md)** untuk petunjuk langkah demi langkah menjalankan proyek di komputer lokal.

- ☁️ **Panduan Deployment Produksi**:
  - **Render.com (Docker Container)**: Menggunakan `Dockerfile` di folder `parti2026`, sesuaikan `APP_KEY`, `DB_CONNECTION=pgsql`, dan jalankan `/run-migration` serta `/run-seed`.
  - **Hostinger / Shared Hosting**: Pastikan Git terhubung ke branch `atnan-dev`, ubah root direktori ke `parti2026/public`, dan jalankan `/create-symlink` untuk storage.

---

## 🤝 Kontribusi & Lisensi

Dikembangkan oleh Tim Pengembang **HIMATIF Universitas Muhammadiyah Surakarta**. Hak Cipta Dilindungi Undang-Undang.
