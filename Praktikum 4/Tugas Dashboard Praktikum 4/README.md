# Tugas Dashboard Praktikum 4 - SIM RS (Sistem Informasi Manajemen Rumah Sakit)

Aplikasi Web Inventaris & Manajemen **Data Alat Elektromedis** berbasis **PHP Native** dan **MySQL**, diintegrasikan dengan Template Admin Modern **Spark Admin v1.0.0 (Bootstrap 5)** serta dilengkapi sistem **Autentikasi Pengguna (Login, Registrasi, Logout)**.

---

## 📌 Fitur Aplikasi

1. **Sistem Autentikasi Pengguna (Auth System):**
   - **Registrasi Akun:** Formulir pendaftaran pengguna baru (Nama Awal, Nama Akhir, Username, Email, Password, Konfirmasi Password) dengan hashing password aman **Bcrypt**.
   - **Login Pengguna:** Masuk ke sistem menggunakan Email atau Username beserta Password.
   - **Logout Pengguna:** Menghapus seluruh sesi aman dengan konfirmasi keluar.
   - **Proteksi Halaman (Middleware):** Seluruh halaman dashboard dan CRUD tidak dapat diakses tanpa login terlebih dahulu.
   - **Akun Bawaan:** Tersedia akun admin default (`admin` / `admin123`).

2. **Dashboard Modern (Spark Admin Theme):**
   - Kartu statistik ringkasan data real-time:
     - Total unit alat elektromedis.
     - Jumlah pabrikan / merek vendor terdaftar.
     - Jumlah sebaran ruangan / instalasi rumah sakit.
   - Profil pengguna dinamis di sidebar dan topbar.
   - Status sistem aktif & tanggal otomatis.

3. **Manajemen Data (CRUD Lengkap):**
   - **Create:** Tambah data alat baru dengan form modern, validasi field, dan autocomplete datalist untuk merek & ruangan.
   - **Read:** Tabel data responsif dengan badge status, ID unik, merek, lokasi, dan tahun.
   - **Update:** Edit data alat medis dengan form terisi otomatis.
   - **Delete:** Hapus data alat dengan dialog konfirmasi keamanan (anti keliru hapus).

4. **Pencarian Real-Time (Live Search):**
   - Kotak pencarian responsif di navbar dan di header tabel untuk memfilter nama alat, merek, maupun lokasi secara instan tanpa perlu reload halaman.

5. **100% Offline Compatible:**
   - Semua aset CSS, icon (Bootstrap Icons), JavaScript, dan fonts sudah tersimpan lokal di folder `assets/`, sehingga tidak memerlukan koneksi internet saat dijalankan di XAMPP.

---

## 📁 Struktur Direktori

```text
Tugas Dashboard Praktikum 4/
├── assets/                  # CSS, JS, Gambar, dan Library (Spark Admin)
│   ├── css/                 # main.css (desain & styling kustom)
│   ├── images/              # avatar, ikon, dan logo
│   ├── js/                  # dashboard.js & auth.js
│   └── libs/                # Bootstrap 5, Bootstrap Icons, Flatpickr, Apexcharts
├── includes/                # Komponen Layout & Keamanan
│   ├── auth_check.php       # Proteksi Sesi Login Pengguna
│   ├── header.php           # HTML Head & Load CSS/Icons
│   ├── sidebar.php          # Navigasi Sidebar Responsif & Profil User
│   ├── navbar.php           # Top Navbar, Search & Menu Profil User
│   └── footer.php           # Footer & Script Live Search
├── config.php               # Konfigurasi Koneksi Database MySQL
├── database.sql             # Skrip SQL (Tabel users, tabel alat, & data dummy)
├── login.php                # Halaman Masuk (Login)
├── register.php             # Halaman Pendaftaran Akun (Registrasi)
├── logout.php               # Skrip Pemrosesan Keluar (Logout)
├── index.php                # Halaman Utama Dashboard & Tabel Alat (Terproteksi)
├── add.php                  # Halaman Tambah Alat Baru (Terproteksi)
├── edit.php                 # Halaman Edit Data Alat (Terproteksi)
├── delete.php               # Skrip Pemrosesan Hapus Data (Terproteksi)
└── README.md                # Dokumentasi Proyek
```

---

## 🚀 Panduan Menjalankan di XAMPP

1. **Nyalakan XAMPP:**
   - Buka **XAMPP Control Panel**.
   - Klik **Start** pada modul **Apache** dan **MySQL**.

2. **Database:**
   - Database `simrs` sudah memuat tabel `users` dan tabel `alat`.
   - File cadangan SQL tersedia di [`database.sql`](database.sql) jika ingin diimpor ulang melalui phpMyAdmin.

3. **Buka Aplikasi di Browser:**
   - Akses URL login berikut di browser Anda:
     ```
     http://localhost/praktikum_web/Praktikum 4/Tugas Dashboard Praktikum 4/login.php
     ```
   - **Login dengan Akun Default:**
     - **Username / Email:** `admin` (atau `admin@rs-elektro.id`)
     - **Password:** `admin123`
   - Atau klik **Daftar Akun Baru** untuk membuat akun pribadi Anda!

---

## 🛠️ Langkah Melakukan Git Commit & Push ke GitHub

Buka terminal di VS Code (atau PowerShell di folder repository):

```bash
# 1. Pindah ke direktori repository utama
cd "D:\Pemrograman Web\praktikumweb"

# 2. Tambahkan perubahan terbaru
git add "Praktikum 4/Tugas Dashboard Praktikum 4"

# 3. Buat commit
git commit -m "feat(auth): tambah fitur registrasi, login bcrypt, logout dan proteksi sesi"

# 4. Push ke GitHub
git push origin main
```
