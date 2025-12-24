# Toast Notification System - JDM Inventory

## 📋 Overview

Sistem notifikasi toast modern yang cantik dengan animasi smooth untuk memberikan feedback kepada user saat melakukan aksi (tambah, edit, hapus data, dll).

## ✨ Fitur

-   🎨 **4 Tipe Notifikasi**: Success, Error, Warning, Info
-   🌙 **Dark Mode Support**: Adaptive dengan dark/light theme
-   ⚡ **Smooth Animations**: Slide-in dan fade-out yang halus
-   🎯 **Auto-dismiss**: Hilang otomatis setelah 5 detik
-   ❌ **Manual Close**: Bisa ditutup manual dengan tombol X
-   📱 **Responsive**: Bekerja sempurna di semua device
-   🔄 **Multiple Toasts**: Bisa menampilkan beberapa notifikasi sekaligus
-   🎭 **Icon Berbeda**: Setiap tipe punya icon unik

## 🎨 Tipe Notifikasi

### 1. **Success** (Hijau)

Digunakan untuk: Aksi berhasil (tambah, edit, hapus data berhasil)

```php
return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
```

### 2. **Error** (Merah)

Digunakan untuk: Error atau kegagalan

```php
return redirect()->back()->with('error', 'Gagal menghapus data!');
```

### 3. **Warning** (Kuning)

Digunakan untuk: Peringatan

```php
return redirect()->back()->with('warning', 'Stok menipis! Segera lakukan restock.');
```

### 4. **Info** (Biru)

Digunakan untuk: Informasi umum

```php
return redirect()->back()->with('info', 'Data telah disinkronkan.');
```

## 🔧 Implementasi di Controller

### Contoh di SparepartController

**Tambah Data:**

```php
public function store(Request $request)
{
    // Validation...

    Sparepart::create($validated);

    return redirect()->route('spareparts.index')
        ->with('success', 'Data sparepart berhasil ditambahkan!');
}
```

**Update Data:**

```php
public function update(Request $request, Sparepart $sparepart)
{
    // Validation...

    $sparepart->update($validated);

    return redirect()->route('spareparts.index')
        ->with('success', 'Data sparepart berhasil diperbarui!');
}
```

**Hapus Data:**

```php
public function destroy(Sparepart $sparepart)
{
    $sparepart->delete();

    return redirect()->route('spareparts.index')
        ->with('success', 'Data sparepart berhasil dihapus!');
}
```

**Error Handling:**

```php
try {
    // Do something...
    return redirect()->back()
        ->with('success', 'Operasi berhasil!');
} catch (\Exception $e) {
    return redirect()->back()
        ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
}
```

## 🎯 Lokasi File

### Layout dengan Toast

**File**: `resources/views/layouts/app.blade.php`

Toast notification sudah terintegrasi di layout utama, jadi otomatis tersedia di semua halaman yang menggunakan layout ini.

### Script Alpine.js

Fungsi `toastNotification()` sudah ada di dalam `app.blade.php`:

-   Mendeteksi Laravel flash messages otomatis
-   Menampilkan toast dengan animasi
-   Auto-dismiss setelah 5 detik
-   Bisa di-close manual

## 📍 Posisi Toast

**Desktop/Tablet**: Pojok kanan atas
**Mobile**: Pojok kanan atas (responsive)
**Z-index**: 50 (di atas semua elemen)

## 🎨 Design Specifications

### Colors by Type

| Type    | Background (Light) | Background (Dark) | Border     | Text           |
| ------- | ------------------ | ----------------- | ---------- | -------------- |
| Success | Green-50           | Green-900/30      | Green-500  | Green-800/200  |
| Error   | Red-50             | Red-900/30        | Red-500    | Red-800/200    |
| Warning | Yellow-50          | Yellow-900/30     | Yellow-500 | Yellow-800/200 |
| Info    | Blue-50            | Blue-900/30       | Blue-500   | Blue-800/200   |

### Animations

**Enter:**

-   Duration: 300ms
-   Effect: Slide from right + fade in
-   Easing: ease-out

**Leave:**

-   Duration: 100ms
-   Effect: Fade out
-   Easing: ease-in

### Sizing

-   **Max Width**: 384px (max-w-sm)
-   **Padding**: 16px (p-4)
-   **Border**: 4px left border
-   **Border Radius**: 8px (rounded-lg)
-   **Shadow**: Large shadow (shadow-lg)

## 🚀 Cara Menggunakan

### 1. **Dari Controller (Recommended)**

Gunakan Laravel flash messages:

```php
// Success
return redirect()->back()->with('success', 'Berhasil!');

// Error
return redirect()->back()->with('error', 'Gagal!');

// Warning
return redirect()->back()->with('warning', 'Hati-hati!');

// Info
return redirect()->back()->with('info', 'Informasi');
```

### 2. **Dari JavaScript (Manual)**

Trigger event window:

```javascript
window.dispatchEvent(
    new CustomEvent("notify", {
        detail: {
            message: "Ini adalah notifikasi",
            type: "success", // success, error, warning, info
        },
    })
);
```

### 3. **Dari Alpine.js Component**

```html
<button @click="$dispatch('notify', { message: 'Hello!', type: 'success' })">
    Tampilkan Toast
</button>
```

## ✅ Controller yang Sudah Menggunakan

Semua controller berikut sudah menggunakan flash message yang kompatibel:

1. ✅ **SparepartController**

    - store() - Success saat tambah
    - update() - Success saat update
    - destroy() - Success saat hapus

2. ✅ **TransactionController**

    - storeMasuk() - Success saat barang masuk
    - storeKeluar() - Success saat barang keluar
    - storeKeluar() - Error jika stok tidak cukup (via withErrors)

3. ✅ **CategoryController** (jika ada)

## 📝 Contoh Pesan yang Bagus

### Success Messages

```php
'Data sparepart berhasil ditambahkan!'
'Data berhasil diperbarui!'
'Data berhasil dihapus!'
'Transaksi berhasil dicatat!'
'Stok telah diperbarui!'
'Data berhasil disimpan!'
```

### Error Messages

```php
'Gagal menyimpan data!'
'Terjadi kesalahan saat menghapus!'
'Stok tidak mencukupi!'
'Data tidak ditemukan!'
'Akses ditolak!'
```

### Warning Messages

```php
'Stok menipis! Tersisa 5 unit.'
'Stok minimum tercapai!'
'Perhatian: Data ini memiliki transaksi terkait.'
```

### Info Messages

```php
'Data telah disinkronkan.'
'Export sedang diproses.'
'Laporan siap diunduh.'
```

## 🔄 Auto-dismiss Timing

**Default**: 5000ms (5 detik)

Untuk mengubah timing, edit di `app.blade.php`:

```javascript
// Auto remove after 5 seconds
setTimeout(() => {
    this.remove(this.toasts.indexOf(toast));
}, 5000); // Ubah angka ini (dalam milliseconds)
```

## 🎭 Customization

### Mengubah Posisi

Edit class di container toast:

```html
<!-- Pojok kanan atas (default) -->
<div class="fixed top-4 right-4 z-50 space-y-3">
    <!-- Pojok kiri atas -->
    <div class="fixed top-4 left-4 z-50 space-y-3">
        <!-- Pojok kanan bawah -->
        <div class="fixed bottom-4 right-4 z-50 space-y-3">
            <!-- Tengah atas -->
            <div
                class="fixed top-4 left-1/2 -translate-x-1/2 z-50 space-y-3"
            ></div>
        </div>
    </div>
</div>
```

### Mengubah Durasi Auto-dismiss

```javascript
// Lebih cepat (3 detik)
setTimeout(() => {
    this.remove(this.toasts.indexOf(toast));
}, 3000);

// Lebih lama (10 detik)
setTimeout(() => {
    this.remove(this.toasts.indexOf(toast));
}, 10000);
```

## 🐛 Troubleshooting

### Toast tidak muncul?

1. **Cek Alpine.js loaded**

    - Buka DevTools Console
    - Ketik `Alpine` - harus return object

2. **Cek flash message**

    - `dd(session('success'))` di blade

3. **Cek syntax Blade**
    - Pastikan `@if(session('success'))` benar

### Toast muncul tapi tidak ada animasi?

1. **Rebuild Tailwind**

    ```bash
    npm run dev
    ```

2. **Clear browser cache**
    - Ctrl + Shift + R

### Dark mode tidak bekerja?

Pastikan layout parent (`<html>`) punya class `dark` saat dark mode aktif.

## 📊 Browser Support

-   ✅ Chrome/Edge 90+
-   ✅ Firefox 88+
-   ✅ Safari 14+
-   ✅ Opera 76+
-   ✅ Mobile browsers (iOS Safari, Chrome Mobile)

## 🎉 Best Practices

1. **Gunakan tipe yang sesuai**

    - Success untuk aksi berhasil
    - Error untuk kegagalan
    - Warning untuk peringatan
    - Info untuk informasi

2. **Pesan yang jelas dan singkat**

    - Maksimal 1-2 kalimat
    - Hindari technical jargon
    - Gunakan bahasa yang user-friendly

3. **Konsisten**

    - Gunakan format pesan yang sama
    - "Data berhasil ditambahkan!" bukan "Berhasil menambah data!"

4. **Action-oriented**
    - "Data sparepart berhasil ditambahkan!"
    - Bukan hanya "Berhasil!"

---

**Version**: 1.0
**Last Updated**: 2025-12-24
**Status**: ✅ Fully Implemented & Tested
