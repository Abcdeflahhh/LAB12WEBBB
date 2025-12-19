# 🔐 Praktikum 12 – Autentikasi & Session (PHP OOP)

![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![Status](https://img.shields.io/badge/Status-Completed-success?style=for-the-badge)

---

## 📌 Deskripsi Proyek
Repository ini merupakan hasil **Praktikum 12 – Autentikasi dan Session** pada mata kuliah **Pemrograman Web**.  
Proyek ini mengimplementasikan sistem **Login, Logout, dan Session Management** menggunakan **PHP Object-Oriented Programming (OOP)** serta **MySQL** sebagai database.

---

## 🎯 Tujuan Praktikum
- Memahami konsep dasar **Autentikasi**
- Memahami konsep dasar **Session**
- Mengimplementasikan sistem login sederhana
- Mengamankan halaman tertentu agar hanya dapat diakses oleh user yang telah login

---

## 🛠️ Teknologi yang Digunakan
- PHP (Object-Oriented Programming)
- MySQL
- Bootstrap 5
- Apache Web Server (XAMPP / Laragon)
- phpMyAdmin

---

## 📂 Struktur Folder
```bash
lab11_php_oop/
│
├── class/
│   ├── Database.php
│   └── Form.php
│
├── module/
│   ├── home/
│   ├── artikel/
│   └── user/
│       ├── login.php
│       ├── logout.php
│       └── profile.php
│
├── template/
│   ├── header.php
│   └── footer.php
│
├── config.php
├── index.php
└── README.md

🗄️ Persiapan Database
1️⃣ Membuat Tabel users

Jalankan query berikut pada database latihan_oop:

```
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    nama VARCHAR(100)
);
```

2️⃣ Insert Data Dummy (Admin)

```
INSERT INTO users (username, password, nama)
VALUES (
  'admin',
  '$2y$10$uWdZ2x.hQfGqGz/..q7wue.3/a/e/e/e/e/e/e/e/e/e/e',
  'Administrator'
);
```

Informasi Login

Username: admin

Password: admin123

Password telah dienkripsi menggunakan fungsi password_hash().

🔄 Konfigurasi Routing & Session (index.php)

Mengaktifkan session menggunakan session_start()

Membatasi akses halaman tertentu

Halaman yang dapat diakses tanpa login:

Home

Login

User yang belum login akan otomatis diarahkan ke halaman login

👤 Modul User
🔑 Login

Menggunakan form login berbasis Bootstrap

Validasi username & password dari database

Verifikasi password menggunakan password_verify()

Menyimpan session:

is_login

username

nama

🚪 Logout

Menghapus session menggunakan session_destroy()

Redirect ke halaman login

🧭 Navigasi Dinamis

Navigasi menyesuaikan status login user:

Belum Login

Home

Login

Sudah Login

Home

Artikel

Logout (Nama User)

🧪 Langkah Pengujian

Akses halaman artikel tanpa login
➜ Sistem akan redirect ke halaman login

Login menggunakan akun admin

Akses fitur CRUD artikel

Logout dan pastikan kembali ke halaman login

📝 Tugas Praktikum

Menambahkan fitur Profil User

Menampilkan data user yang sedang login

Menyediakan form untuk mengubah password

Password baru harus dienkripsi menggunakan password_hash()

✅ Kesimpulan

Sistem autentikasi berbasis PHP OOP dan Session berhasil diimplementasikan dengan baik.
Halaman terlindungi dengan mekanisme session, serta navigasi menyesuaikan status login user.

📎 Catatan

Pastikan folder proyek berada di dalam htdocs

Pastikan database sudah dibuat sebelum menjalankan aplikasi

Gunakan browser modern untuk tampilan optimal

👨‍🎓 Identitas Mahasiswa

Nama : Aflah Athallah Tamam Kapukong
NIM : 312410280
Kelas: TI 24A4

📤 Pengumpulan

Repository GitHub telah diperbarui

Screenshot setiap langkah praktikum disertakan

URL repository dikirim melalui e-learning
