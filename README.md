SAPA-Sketsu (Sistem Pengaduan dan Aspirasi)
SAPA-Sketsu adalah platform berbasis web yang dirancang untuk memfasilitasi siswa dalam menyampaikan pengaduan, aspirasi, atau keluhan secara digital kepada pihak sekolah. Proyek ini dikembangkan dengan fokus pada transparansi pelacakan laporan.

Fitur Utama
Untuk Siswa (User)
Dashboard: Ringkasan jumlah laporan yang telah dikirim.

Sistem Pengaduan: Formulir input laporan dengan pemilihan kategori.

Riwayat Laporan: Pantau status laporan secara real-time (Pending, Process, Resolved).

Nomor Tiket: Setiap laporan mendapatkan ID unik otomatis untuk pelacakan.

Untuk Admin
Manajemen Laporan: Panel khusus untuk memproses pengaduan masuk.

Update Status: Memberikan feedback status pengerjaan kepada siswa.

Layanan Data: Fitur ekspor laporan dan manajemen pengguna.

Teknologi yang Digunakan
Framework: Laravel 10

CSS Framework: Tailwind CSS

Interactivity: Alpine.js

Database: MySQL

Icons: FontAwesome 6

Instalasi
Clone repositori
git clone https://github.com/username/sapa-sketsu.git

Masuk ke direktori
cd sapa-sketsu

Instal dependensi PHP
composer install

Instal dependensi Frontend
npm install && npm run dev

Konfigurasi Environment
Salin file .env.example menjadi .env, kemudian sesuaikan pengaturan database.
php artisan key:generate

Migrasi Database
php artisan migrate --seed

Jalankan Server
php artisan serve

Kontribusi
Proyek ini dikembangkan oleh Ahmad Za'im Arif sebagai bagian dari tugas pengembangan perangkat lunak di SMK Negeri 1 Sukorejo (Sketsu)