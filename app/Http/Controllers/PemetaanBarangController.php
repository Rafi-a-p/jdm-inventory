<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sparepart;
use Illuminate\Http\Request;

class PemetaanBarangController extends Controller
{
    /**
     * Display item mapping by category and location for physical search.
     */
    public function index(Request $request)
    {
        $categoryId = $request->get('category_id');
        $search = $request->get('search');
        $lokasi = $request->get('lokasi_rak'); // filter by shelf location

        $categories = Category::withCount('spareparts')->orderBy('nama')->get();

        // Get spareparts grouped by category (and optionally by lokasi_rak)
        $query = Sparepart::with('category')->orderBy('lokasi_rak')->orderBy('nama_barang');

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_part', 'like', "%{$search}%")
                    ->orWhere('nama_barang', 'like', "%{$search}%")
                    ->orWhere('merk', 'like', "%{$search}%")
                    ->orWhere('lokasi_rak', 'like', "%{$search}%");
            });
        }

        if ($lokasi) {
            $query->where('lokasi_rak', 'like', "%{$lokasi}%");
        }

        $spareparts = $query->get();

        // Group by category for display
        $byCategory = $spareparts->groupBy('category_id')->map(function ($items, $catId) use ($categories) {
            $category = $catId ? $categories->find($catId) : null;
            return [
                'category' => $category,
                'category_name' => $category ? $category->nama : 'Tanpa Kategori',
                'category_color' => $category?->warna ?? '#6B7280',
                'items' => $items->groupBy('lokasi_rak'),
            ];
        });

        // Unique lokasi_rak for filter dropdown
        $lokasiList = Sparepart::whereNotNull('lokasi_rak')->where('lokasi_rak', '!=', '')->distinct()->orderBy('lokasi_rak')->pluck('lokasi_rak');

        return view('pemetaan-barang.index', compact('categories', 'byCategory', 'lokasiList'));
    }
}
