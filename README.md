# JDM Inventory System

Sistem Manajemen Inventaris Sparepart untuk bengkel kendaraan JDM (Japanese Domestic Market) dengan UI/UX modern dan interaktif.

## ✨ Highlights

-   🎨 **Modern UI/UX** - Glassmorphism design dengan animasi smooth & vibrant colors
-   📊 **Data Visualization** - Interactive charts dengan Chart.js
-   🌙 **Dark Mode** - Fully optimized untuk light & dark theme
-   📱 **Responsive Design** - Mobile-first approach
-   🔐 **Secure Authentication** - Role-based access control
-   🔔 **SweetAlert2** - Modern notifications & confirmation modals

## 🚀 Fitur Utama

### ✅ Manajemen Sparepart

-   CRUD lengkap untuk data sparepart
-   **Pencarian global** (kode, nama, merk)
-   **Filter** berdasarkan kategori, merk, dan status stok
-   Lokasi rak untuk mempermudah pencarian di gudang
-   Stok minimum dengan alert otomatis & status visual

### ✅ Kategori Sparepart

-   Pengelompokan sparepart berdasarkan kategori
-   Warna badge untuk identifikasi visual
-   Kategori default: Engine Parts, Body Parts, Suspension, Brake System, Electrical, Interior, Exhaust, Cooling System

### ✅ Transaksi Stok

-   Barang Masuk & Keluar
-   Update stok otomatis
-   Validasi stok tidak mencukupi
-   Real-time transaction tracking
-   Audit trail per transaksi (timestamp & user)

### ✅ Kartu Stok

-   Histori transaksi per sparepart
-   Running balance (saldo berjalan)
-   Export ke PDF (A4 Portrait)

### ✅ Laporan & Export

-   **Laporan Stok PDF** - Format A4 Portrait, dioptimalkan untuk cetak
-   **Laporan Transaksi PDF** - Riwayat transaksi periode tertentu (A4 Portrait)
-   **Native CSV Export** - Export data Sparepart & Transaksi ke format CSV (Excel Ready)
-   **Filter Laporan** - Filter berdasarkan kategori, tanggal, dan tipe transaksi

### ✅ Dashboard Interaktif

-   📈 **Grafik Transaksi** - Line chart 7 hari terakhir (Barang Masuk vs Keluar)
-   🔢 **Animated Counters** - Statistik yang count up secara smooth
-   📊 **Real-time Statistics** - Total jenis, total stok, nilai inventaris, transaksi hari ini
-   ⚠️ **Low Stock Alert** - Notifikasi stok menipis secara visual
-   🕒 **Recent Transactions** - Transaksi terbaru dengan timestamp

### ✅ Login Page Premium

-   🎨 **Animated Gradient Background** - Gradient bergerak dengan floating shapes
-   🏢 **Professional Branding** - Logo dan branding JDM Inventory System
-   🔒 **Password Toggle** - Show/hide password dengan icon

## 📋 Teknologi

-   **Framework**: Laravel 12
-   **Frontend**: Blade + Tailwind CSS + Alpine.js
-   **Database**: MySQL
-   **Charts**: Chart.js 4.x
-   **Modals**: SweetAlert2
-   **PDF Generation**: barryvdh/laravel-dompdf
-   **CSV Export**: Native PHP Streamed Response (Excel Ready)
-   **Icons**: Heroicons

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
├── Kategori           # CRUD kategori
├── Transaksi          # Barang masuk/keluar
└── Laporan            # PDF & CSV export (Simplified)
    ├── Laporan Stok (Portrait PDF)
    ├── Laporan Transaksi (Portrait PDF)
    └── Export CSV (Native Stream)
```

## 📝 Changelog

### v1.3.0 (2024-12-24)

#### 📊 Reporting & Export Overhaul

-   🚀 **Redesigned Report Page**: Halaman laporan yang lebih clean dan fokus pada fungsi export.
-   📄 **PDF Portrait Optimization**: Semua laporan PDF (Stok & Transaksi) diubah ke format **A4 Portrait** dengan layout yang disesuaikan agar tidak terpotong.
-   📊 **Native CSV Export**: Implementasi export data ke CSV menggunakan native PHP untuk kompatibilitas Excel yang lebih baik dan performa lebih cepat.
-   🎨 **Favicon Update**: Migrasi ke `favicon.ico` standar untuk branding yang lebih konsisten.

#### 🛠️ Internal Improvements

-   🔔 **SweetAlert2 Integration**: Mengganti modal konfirmasi hapus standar dengan SweetAlert2 yang lebih modern dan aman.
-   🔒 **Role Access Tweaks**: Perbaikan akses filter transaksi untuk staff.
-   🧹 **Code Optimization**: Pembersihan view yang tidak digunakan dan penyederhanaan controller laporan.

### v1.2.0 (2024-12-23)

#### 🎨 UI/UX Enhancements

-   ✨ **Login Page Redesign**: Animated gradient, glassmorphism card, branding JDM, password visibility toggle.
-   ✨ **Dashboard Improvements**: Chart.js integration, animated counters, enhanced hover effects, better grid layout.
-   🌙 **Dark Mode Optimization**: Adaptive chart colors dan consistent color scheme.

### v1.1.0 (2024-12-17)

-   ✨ Tambah fitur Kategori Sparepart
-   ✨ Tambah fitur Pencarian & Filter
-   ✨ Tambah fitur Kartu Stok
-   ✨ Tambah fitur Export PDF & Excel
-   ✨ Tambah field Lokasi Rak & Stok Minimum

### v1.0.0

-   🎉 Initial release
-   Manajemen Sparepart dasar & Transaksi Barang Masuk/Keluar

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📄 License

MIT License
