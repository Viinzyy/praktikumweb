# Tugas Dashboard Praktikum 4 - SIM RS (Sistem Informasi Manajemen Rumah Sakit)

Aplikasi Web Inventaris & Manajemen **Data Alat Elektromedis** berbasis **PHP Native** dan **MySQL**, diintegrasikan dengan Template Admin Modern **Spark Admin v1.0.0 (Bootstrap 5)**.

---

## 📌 Fitur Aplikasi

1. **Dashboard Modern (Spark Admin Theme):**
   - Kartu statistik ringkasan data real-time:
     - Total unit alat elektromedis.
     - Jumlah pabrikan / merek vendor terdaftar.
     - Jumlah sebaran ruangan / instalasi rumah sakit.
   - Status sistem aktif & tanggal otomatis.

2. **Manajemen Data (CRUD Lengkap):**
   - **Create:** Tambah data alat baru dengan form modern, validasi field, dan autocomplete datalist untuk merek & ruangan.
   - **Read:** Tabel data responsif dengan badge status, ID unik, merek, lokasi, dan tahun.
   - **Update:** Edit data alat medis dengan form terisi otomatis.
   - **Delete:** Hapus data alat dengan dialog konfirmasi keamanan (anti keliru hapus).

3. **Pencarian Real-Time (Live Search):**
   - Kotak pencarian responsif di navbar dan di header tabel untuk memfilter nama alat, merek, maupun lokasi secara instan tanpa perlu reload halaman.

4. **100% Offline Compatible:**
   - Semua aset CSS, icon (Bootstrap Icons), JavaScript, dan fonts sudah tersimpan lokal di folder `assets/`, sehingga tidak memerlukan koneksi internet saat dijalankan di XAMPP.

---

## 📁 Struktur Direktori

```text
Tugas Dashboard Praktikum 4/
├── assets/                  # CSS, JS, Gambar, dan Library (Spark Admin)
│   ├── css/                 # main.css (desain & styling kustom)
│   ├── images/              # avatar, ikon, dan logo
│   ├── js/                  # dashboard.js (logika UI dashboard)
│   └── libs/                # Bootstrap 5, Bootstrap Icons, Flatpickr, Apexcharts
├── includes/                # Komponen Layout Terpisah (Modular PHP)
│   ├── header.php           # HTML Head & Load CSS/Icons
│   ├── sidebar.php          # Navigasi Sidebar Responsif
│   ├── navbar.php           # Top Navbar, Search & Profil
│   └── footer.php           # Footer & Script Live Search
├── config.php               # Konfigurasi Koneksi Database MySQL
├── database.sql             # Skrip SQL untuk Import Database & Dummy Data
├── index.php                # Halaman Utama Dashboard & Tabel Alat
├── add.php                  # Halaman Tambah Alat Baru
├── edit.php                 # Halaman Edit Data Alat
├── delete.php               # Skrip Pemrosesan Hapus Data
└── README.md                # Dokumentasi Proyek
```

---

## 🚀 Panduan Menjalankan di XAMPP

1. **Nyalakan XAMPP:**
   - Buka **XAMPP Control Panel**.
   - Klik **Start** pada modul **Apache** dan **MySQL**.

2. **Import Database `simrs`:**
   - Buka browser dan akses [http://localhost/phpmyadmin/](http://localhost/phpmyadmin/).
   - Buat database baru bernama `simrs` (atau klik menu **Import**).
   - Pilih file `database.sql` yang berada di dalam folder project ini.
   - Klik **Go** / **Kirim** untuk mengimpor tabel `alat` beserta sampel data awal.

3. **Buka Aplikasi di Browser:**
   - Akses URL berikut di browser Anda:
     ```
     http://localhost/praktikum_web/Praktikum 4/Tugas Dashboard Praktikum 4/
     ```

---

## 🛠️ Langkah Melakukan Git Commit & Push ke GitHub

Jika Anda ingin menyimpan dan mengunggah pengerjaan ini ke repository GitHub Anda (`praktikum2web`):

Buka terminal di VS Code (atau PowerShell di folder repository):

```bash
# 1. Pindah ke direktori repository utama
cd "D:\Pemrograman Web\praktikumweb"

# 2. Cek status perubahan file
git status

# 3. Tambahkan seluruh folder tugas baru
git add "Praktikum 4/Tugas Dashboard Praktikum 4"

# 4. Berikan commit pesan yang rapi
git commit -m "feat(praktikum4): pasang template spark admin modern untuk dashboard SIM RS"

# 5. Push ke branch utama GitHub Anda
git push origin main
```
