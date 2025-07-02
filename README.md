# 🏢 Sistem Peminjaman Ruang Rapat

Aplikasi web berbasis Laravel untuk mengelola peminjaman ruang rapat di lingkungan organisasi atau perusahaan. Mendukung autentikasi pengguna, manajemen pemesanan, dan peran admin untuk persetujuan peminjaman.

---

## 🚀 Fitur

- ✅ Registrasi & login pengguna
- 📝 Pengajuan peminjaman ruang rapat
- ✅ Persetujuan / penolakan peminjaman oleh admin
- 📜 Riwayat peminjaman bagi pengguna
- 🔐 Akses berbasis peran (Admin & Pengguna)
- 📊 Dashboard admin

---

## 🛠️ Teknologi yang Digunakan

- PHP 8.2+
- Laravel 10
- PostgreSQL / MySQL
- Blade & TailwindCSS
- Laravel Breeze (untuk autentikasi)

---

## ⚙️ Cara Instalasi

```bash
# 1. Clone repository ini
git clone https://github.com/Lufasu-Adm/meeting-room-booking.git
cd meeting-room-booking

# 2. Install dependensi PHP
composer install

# 3. Install dependensi JavaScript
npm install && npm run dev

# 4. Salin file .env
cp .env.example .env

# 5. Generate application key
php artisan key:generate

# 6. Atur koneksi database di file .env

# 7. Jalankan migrasi database
php artisan migrate

# 8. Jalankan server lokal
php artisan serve
