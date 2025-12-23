# JDM Inventory System

Sistem Manajemen Inventaris Sparepart untuk bengkel kendaraan JDM (Japanese Domestic Market) dengan UI/UX modern dan interaktif.

## ✨ Highlights

-   🎨 **Modern UI/UX** - Glassmorphism design dengan animasi smooth
-   📊 **Data Visualization** - Interactive charts dengan Chart.js
-   🌙 **Dark Mode** - Fully optimized untuk light & dark theme
-   📱 **Responsive Design** - Mobile-first approach
-   🔐 **Secure Authentication** - Role-based access control

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
-   Real-time transaction tracking

### ✅ Kartu Stok

-   Histori transaksi per sparepart
-   Running balance (saldo berjalan)
-   Export ke PDF

### ✅ Laporan & Export

-   **Laporan Stok PDF** - Daftar semua sparepart dengan status stok
-   **Laporan Transaksi PDF** - Riwayat transaksi berdasarkan periode
-   **Kartu Stok PDF** - Per item sparepart
-   **Export Excel** - Sparepart dan Transaksi

### ✅ Dashboard Interaktif

-   📈 **Grafik Transaksi** - Line chart 7 hari terakhir (Barang Masuk vs Keluar)
-   🔢 **Animated Counters** - Statistik yang count up secara smooth
-   📊 **Real-time Statistics** - Total jenis, total stok, transaksi hari ini
-   ⚠️ **Low Stock Alert** - Notifikasi stok menipis (< 5 unit)
-   🕒 **Recent Transactions** - Transaksi terbaru dengan timestamp
-   🎯 **Quick Actions** - Shortcut untuk aksi cepat

### ✅ Login Page Premium

-   🎨 **Animated Gradient Background** - Gradient bergerak dengan floating shapes
-   🏢 **Professional Branding** - Logo dan branding JDM Inventory System
-   🔒 **Password Toggle** - Show/hide password dengan icon
-   📱 **Fully Responsive** - Optimized untuk semua device
-   ✨ **Micro-animations** - Smooth transitions dan hover effects

### ✅ Role-Based Access Control

-   **Admin**: Akses penuh ke semua fitur
-   **Staff**: Kelola transaksi stok, lihat data

## 📋 Teknologi

-   **Framework**: Laravel 11
-   **Frontend**: Blade + Tailwind CSS + Alpine.js
-   **Database**: MySQL
-   **Charts**: Chart.js 4.x
-   **Fonts**: Google Fonts (Inter)
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

### v1.2.0 (2024-12-23)

#### 🎨 UI/UX Enhancements

-   ✨ **Login Page Redesign**
    -   Animated gradient background dengan floating shapes
    -   Glassmorphism card design
    -   Professional branding dengan logo JDM Inventory
    -   Password visibility toggle
    -   Enhanced form inputs dengan icons
    -   Smooth animations & micro-interactions
    -   Google Fonts (Inter) integration
-   ✨ **Dashboard Improvements**
    -   📊 Chart.js integration untuk visualisasi transaksi 7 hari
    -   🔢 Animated counters untuk statistik (count up effect)
    -   Enhanced hover effects pada semua cards
    -   Better layout dengan grid system
    -   Empty states dengan icons
    -   Improved spacing & visual hierarchy
-   ✨ **Interactive Elements**
    -   Card hover effects (lift up + shadow)
    -   Icon scale animations
    -   Smooth transitions di semua elemen
    -   Better button states & feedback
-   🌙 **Dark Mode Optimization**
    -   Chart colors adaptive dengan theme
    -   Better contrast untuk readability
    -   Consistent color scheme

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

## 🎯 Fitur yang Akan Datang

-   [ ] Notifikasi real-time
-   [ ] Barcode scanning
-   [ ] Multi-warehouse support
-   [ ] Advanced analytics & reporting
-   [ ] Mobile app

## 📸 Screenshots

### Login Page

-   Modern gradient background dengan glassmorphism effect
-   Password toggle untuk better UX
-   Fully responsive design

### Dashboard

-   Interactive charts dengan Chart.js
-   Animated statistics counters
-   Real-time data visualization
-   Quick actions untuk workflow cepat

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📄 License

MIT License
