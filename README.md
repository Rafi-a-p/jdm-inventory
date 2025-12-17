# JDM Inventory System

Sistem Manajemen Inventaris Sparepart untuk bengkel kendaraan JDM (Japanese Domestic Market).

## 🚀 Fitur Utama

### ✅ Manajemen Sparepart

-   CRUD lengkap untuk data sparepart
-   **Pencarian global** (kode, nama, merk)
-   **Filter** berdasarkan kategori, merk, dan status stok
-   Lokasi rak untuk mempermudah pencarian di gudang
-   Stok minimum dengan alert otomatis

### ✅ Kategori Sparepart

-   Pengelompokan sparepart berdasarkan kategori
-   Warna badge untuk identifikasi visual
-   Kategori default: Engine Parts, Body Parts, Suspension, Brake System, Electrical, Interior, Exhaust, Cooling System

### ✅ Transaksi Stok

-   Barang Masuk & Keluar
-   Update stok otomatis
-   Validasi stok tidak mencukupi

### ✅ Kartu Stok

-   Histori transaksi per sparepart
-   Running balance (saldo berjalan)
-   Export ke PDF

### ✅ Laporan & Export

-   **Laporan Stok PDF** - Daftar semua sparepart dengan status stok
-   **Laporan Transaksi PDF** - Riwayat transaksi berdasarkan periode
-   **Kartu Stok PDF** - Per item sparepart
-   **Export Excel** - Sparepart dan Transaksi

### ✅ Dashboard

-   Statistik inventory real-time
-   Transaksi terbaru
-   Alert stok menipis

### ✅ Role-Based Access Control

-   **Admin**: Akses penuh ke semua fitur
-   **Staff**: Kelola transaksi stok, lihat data

## 📋 Teknologi

-   **Framework**: Laravel 11
-   **Frontend**: Blade + Tailwind CSS + Alpine.js
-   **Database**: MySQL
-   **PDF Generation**: barryvdh/laravel-dompdf
-   **Excel Export**: maatwebsite/excel

## 🔧 Instalasi

### 1. Clone Repository

```bash
git clone <repository-url>
cd jdm-inventory
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env`:

```
DB_DATABASE=jdm_inventory
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Jalankan Migrasi & Seeder

```bash
php artisan migrate:fresh --seed
```

### 6. Build Assets

```bash
npm run build
```

### 7. Jalankan Server

```bash
php artisan serve
```

Akses aplikasi di: **http://localhost:8000**

## 👤 Akun Default

| Role  | Email         | Password |
| ----- | ------------- | -------- |
| Admin | admin@jdm.com | password |
| Staff | staff@jdm.com | password |

## 📁 Struktur Fitur

```
├── Dashboard           # Statistik & Overview
├── Sparepart          # CRUD + Search + Filter
│   ├── Daftar         # List dengan pagination
│   ├── Tambah         # Form tambah sparepart
│   ├── Edit           # Form edit sparepart
│   ├── Detail         # Info lengkap + transaksi terakhir
│   └── Kartu Stok     # Histori transaksi per item
├── Kategori           # CRUD kategori
├── Transaksi          # Barang masuk/keluar
└── Laporan            # PDF & Excel export
    ├── Laporan Stok
    ├── Laporan Transaksi
    ├── Kartu Stok
    └── Export Excel
```

## 📝 Changelog

### v1.1.0 (2024-12-17)

-   ✨ Tambah fitur Kategori Sparepart
-   ✨ Tambah fitur Pencarian & Filter
-   ✨ Tambah fitur Kartu Stok
-   ✨ Tambah fitur Export PDF & Excel
-   ✨ Tambah field Lokasi Rak & Stok Minimum
-   🎨 Improve UI/UX dengan statistik real-time

### v1.0.0

-   🎉 Initial release
-   Manajemen Sparepart dasar
-   Transaksi Barang Masuk/Keluar
-   Role Admin & Staff

## 📄 License

MIT License
