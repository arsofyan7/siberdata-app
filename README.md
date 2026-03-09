<div align="center">
  <img src="public/images/hero1.png" alt="LSP Siberdata Hero" width="100%" />

  # 🛡️ LSP Siberdata - Sertifikasi Profesi Keamanan Siber & PDP

  **Validasi keahlian Anda melalui uji kompetensi berstandar nasional bersama Lembaga Sertifikasi Profesi Siberdata.**

  [![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
  [![Vue.js](https://img.shields.io/badge/Vue.js-35495E?style=for-the-badge&logo=vue.js&logoColor=4FC08D)](https://vuejs.org/)
  [![Inertia.js](https://img.shields.io/badge/Inertia.js-9553E9?style=for-the-badge&logo=inertia&logoColor=white)](https://inertiajs.com/)
  [![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com/)
  [![Filament](https://img.shields.io/badge/Filament-EAB308?style=for-the-badge&logo=filament&logoColor=white)](https://filamentphp.com/)

</div>

---

## 📖 Tentang Aplikasi

Aplikasi ini adalah platform portal sistem informasi untuk **LSP Siberdata**, sebuah lembaga sertifikasi profesi yang fokus pada bidang **Keamanan Siber (Cyber Security)** dan **Pelindungan Data Pribadi (PDP)** di Indonesia.

Platform ini memfasilitasi asesi (peserta) untuk melihat detail skema sertifikasi, melakukan pendaftaran, dan bagi admin/asesor untuk mengelola skema, asesmen, dan data pengguna melalui dashboard yang canggih.

### ✨ Fitur Utama
- **Landing Page Interaktif**: Desain UI modern dengan efek glassmorphism dan carousel dinamis.
- **Katalog Skema Sertifikasi**: Fitur pencarian dan filter skema (Cyber & PDP) yang intuitif.
- **Detail Skema Komprehensif**: Informasi profil, tugas, prasyarat, kompetensi, dan jenjang karir tiap skema.
- **Tampilan "Tentang Kami" yang Profesional**: Menyajikan Visi, Misi, *Core Values* (SIBER), dan detail lokasi institusi.
- **Admin Dashboard Terintegrasi**: Menggunakan **Filament v3** untuk manajemen Master Data Skema, Dokumen, Riwayat Sertifikasi, dan *Advanced Statistics Widget*.

## 🚀 Teknologi yang Digunakan

- **Backend:** [Laravel 10](https://laravel.com)
- **Frontend:** [Vue 3](https://vuejs.org/) (Composition API) + [Inertia.js](https://inertiajs.com/)
- **Styling:** [Tailwind CSS](https://tailwindcss.com/)
- **Icons:** [Lucide Icons](https://lucide.dev/) (lucide-vue-next)
- **Admin Panel:** [Filament PHP v3](https://filamentphp.com/)

## 🛠️ Instalasi & Persiapan

1. **Clone repository ini** (jika ada remote) atau masuk ke direktori proyek lokal.
2. **Install dependensi PHP dan Node.js:**
   ```bash
   composer install
   npm install
   ```
3. **Konfigurasi Environment:**
   Salin `.env.example` ke `.env` dan atur koneksi database Anda.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. **Jalankan Migrasi & Database Seeder:**
   (Pastikan Anda telah membuat database yang didefinisikan di `.env`).
   ```bash
   php artisan migrate --seed
   ```
   *Seeder (seperti `DatabaseSeeder`, `SchemeSeeder`) akan memasukkan data admin default dan master data skema secara otomatis.*

5. **Kompilasi Aset Frontend:**
   ```bash
   npm run build
   # atau untuk mode development: npm run dev
   ```

6. **Jalankan Server Lokal:**
   ```bash
   php artisan serve
   ```
   Aplikasi dapat diakses di `http://127.0.0.1:8000`.

## 🔑 Akses Sistem

| Role | Path Akses | Keterangan |
|------|------------|------------|
| **Publik** | `/` | Halaman utama pengunjung (Portal Informasi) |
| **Publik** | `/skema` | Katalog lengkap skema sertifikasi |
| **Admin** | `/admin` | Portal Filament Admin (mengelola data) |
| **Asesi / User** | `/dashboard` | Portal Asesi pribadi (Inertia Dashboard) |

## 🌟 Core Values (SIBER)

- **S**inergi: Kolaborasi kuat dengan pemangku kepentingan keamanan siber.
- **I**ntegritas: Kejujuran dan etika tinggi dalam asesmen.
- **B**erstandar: Patuh pada regulasi BNSP dan standar teknis.
- **E**xpertise: Didorong oleh keahlian mendalam di dunia privasi.
- **R**esponsif: Cepat tanggap terhadap ancaman siber baru.

---

<div align="center">
  <i>&copy; 2026 LSP Siberdata. Terakreditasi Nasional.</i>
</div>
