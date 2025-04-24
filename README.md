============================================================
Permintaan Barang - Laravel + Vue.js Inertia Application
============================================================

📦 Deskripsi Aplikasi:
Aplikasi ini digunakan untuk membuat permintaan barang kantor, dengan fitur:
- Login dan registrasi pengguna
- Pengajuan permintaan barang
- Validasi stok barang
- Manajemen user dan departemen

------------------------------------------------------------
🔧 Spesifikasi Minimum:
------------------------------------------------------------
- PHP >= 8.0
- Composer
- Node.js & npm
- SQLite (default)
- Laravel 10.x

------------------------------------------------------------
📥 Cara Instalasi:
------------------------------------------------------------

1. Clone repository
---------------------
git clone https://github.com/Gumillar88/permintaan-barang
cd permintaan-barang

2. Install dependency Laravel
------------------------------
composer install

3. Install dependency frontend
-------------------------------
npm install

4. Salin file environment
--------------------------
cp .env.example .env

5. Generate application key
-----------------------------
php artisan key:generate

6. Jalankan migrasi database + seeder
---------------------------------------
php artisan migrate --seed

NOTE:
Jika ingin reset database:
php artisan migrate:fresh --seed

------------------------------------------------------------
🚀 Menjalankan Aplikasi
------------------------------------------------------------

Jalankan backend Laravel:
---------------------------
php artisan serve

Jalankan frontend (Vite):
---------------------------
npm run dev

Akses aplikasi di:
http://localhost:8000

------------------------------------------------------------
🔐 Login / Register
------------------------------------------------------------

1. Jalankan aplikasi dan buka halaman:
   http://localhost:8000/login

2. Register user baru atau login menggunakan akun bawaan:
   Email: test@example.com
   Password: 12345678

------------------------------------------------------------
🧾 Cara Menggunakan Aplikasi
------------------------------------------------------------

1. Setelah login, masuk ke menu "Permintaan Barang"
2. Klik "Buat Permintaan Baru"
3. Pilih barang yang ingin diminta, atur jumlah, lalu klik Kirim
4. Sistem akan otomatis mengecek stok dan menyimpan permintaan
5. Cek status permintaan di halaman daftar permintaan

------------------------------------------------------------
📁 Struktur Penting:
------------------------------------------------------------

- resources/js/Pages => Halaman frontend
- app/Models => Model Laravel
- app/Http/Controllers => Logic backend
- database/seeders => Dummy data
- database/migrations => Struktur tabel

------------------------------------------------------------

✨ Selamat menggunakan aplikasi Permintaan Barang!
