# Innovation Dashboard

Dashboard Monitoring Inovasi OPD berbasis PHP Native yang digunakan untuk memantau produktivitas inovasi setiap Organisasi Perangkat Daerah (OPD).

---

## Tentang Project

Aplikasi ini dibuat sebagai dashboard monitoring yang bersifat **read-only**, sehingga tidak memiliki fitur CRUD (Create, Read, Update, Delete). Seluruh data ditampilkan berdasarkan informasi yang tersedia pada database.

Dashboard ini bertujuan membantu stakeholder dalam menganalisis produktivitas inovasi setiap OPD berdasarkan jumlah inovasi yang telah diajukan, jumlah inovator yang terlibat, serta rasio inovasi terhadap inovator.

---

## Tujuan

- Menampilkan jumlah inovasi setiap OPD.
- Menampilkan jumlah inovator setiap OPD.
- Menampilkan rasio inovasi per inovator.
- Mengurutkan OPD berdasarkan jumlah inovasi.
- Memfilter data berdasarkan tahun.
- Memudahkan stakeholder mengidentifikasi OPD yang aktif maupun kurang aktif dalam menghasilkan inovasi.

---

## Fitur

### Dashboard

- Ringkasan Statistik
    - Total OPD
    - Total Inovasi
    - Total Inovasi Terverifikasi
    - Total Inovasi Diajukan
    - Total Inovasi Dikembalikan

### Filter

- Filter Tahun
    - All Time
    - 2026
    - 2025
    - 2024
    - dan seterusnya

- Sorting
    - Terbanyak → Tersedikit
    - Tersedikit → Terbanyak

- Pencarian OPD

- Reset Filter

### Card OPD

Setiap OPD ditampilkan dalam bentuk card yang berisi:

- Nama OPD
- Total Inovator
- Total Inovasi Terverifikasi
- Rasio Inovasi per Inovator
- Badge Ranking
- Indikator Warna
- Tombol Lihat Detail

### Detail OPD

Menampilkan:

- Informasi OPD
- Total Inovator
- Total Inovasi
- Rasio
- Daftar Inovasi
- Status Inovasi
- Tanggal Inovasi

---

## Struktur Database

Project menggunakan tiga tabel utama.

### opd

Menyimpan daftar Organisasi Perangkat Daerah.

### innovations

Menyimpan seluruh data inovasi.

Status inovasi:

- diajukan
- dikembalikan
- terverifikasi

Hanya inovasi dengan status **terverifikasi** yang dihitung sebagai inovasi valid.

### opd_statistics

Menyimpan jumlah inovator setiap OPD berdasarkan tahun.

---

## Tech Stack

### Backend

- PHP 8 Native
- PDO
- MySQL / MariaDB

### Frontend

- HTML5
- Bootstrap 5
- CSS3
- Vanilla JavaScript

---

## Struktur Folder

```
innovation-dashboard/

│

├── assets/
│   ├── css/
│   ├── img/
│   ├── js/
│   └── icons/
│
├── config/
│
├── database/
│
├── helpers/
│
├── pages/
│
├── partials/
│
├── index.php
│
├── README.md
│
└── .htaccess
```

---

## Persyaratan Sistem

- PHP >= 8.1
- MySQL >= 8
- Apache Web Server
- XAMPP atau Laragon

---

## Cara Menjalankan Project

### 1. Clone / Copy Project

```
innovation-dashboard/
```

ke folder

```
htdocs/
```

(XAMPP)

atau

```
www/
```

(Laragon)

---

### 2. Jalankan

- Apache
- MySQL

---

### 3. Import Database

Buka phpMyAdmin.

Buat database baru.

Import file:

```
database/innovation_dashboard.sql
```

---

### 4. Konfigurasi Database

Buka

```
config/database.php
```

kemudian sesuaikan

```php
$host
$database
$username
$password
```

---

### 5. Jalankan

Buka browser.

```
http://localhost/innovation-dashboard
```

---

## Arsitektur Aplikasi

Aplikasi menggunakan arsitektur sederhana.

```
Database

↓

Helper

↓

Page

↓

Partial

↓

Browser
```

Karena aplikasi hanya bersifat dashboard monitoring, arsitektur ini dipilih agar tetap ringan dan mudah dipelihara.

---

## Perhitungan Dashboard

### Total Inovasi

Menghitung seluruh inovasi yang memiliki status:

```
terverifikasi
```

---

### Total Inovator

Diambil dari tabel:

```
opd_statistics
```

berdasarkan OPD dan tahun yang dipilih.

---

### Rasio Inovasi

```
Total Inovasi
─────────────
Total Inovator
```

Contoh:

```
40 inovasi

20 inovator

=

2,00 inovasi / inovator
```

---

## Status Warna Card

Hijau

Sangat Aktif

---

Kuning

Aktif

---

Oranye

Cukup Aktif

---

Merah

Kurang Aktif

---

## Lisensi

Project ini dibuat sebagai Dashboard Monitoring Inovasi OPD untuk kebutuhan analisis dan monitoring internal.

---

## Author

Developed by Rayhan Cahya Qurnia and Belinda Adara Putri using PHP Native.