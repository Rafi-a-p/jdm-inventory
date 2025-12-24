<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    /**
     * Export spareparts to Excel/CSV.
     */
    public function spareparts(Request $request)
    {
        $filename = 'data-sparepart-' . now()->format('Y-m-d-His') . '.csv';

        $query = Sparepart::with('category')->orderBy('nama_barang');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $spareparts = $query->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function() use ($spareparts) {
            $file = fopen('php://output', 'w');

            // Add BOM for Excel to recognize UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Header row
            fputcsv($file, [
                'No',
                'Kode Part',
                'Nama Barang',
                'Merk',
                'Kategori',
                'Lokasi Rak',
                'Stok',
                'Stok Minimum',
                'Harga (Rp)',
                'Total Nilai (Rp)',
                'Status'
            ], ';');

            $no = 0;
            foreach ($spareparts as $item) {
                $no++;

                $status = 'Normal';
                if ($item->stok <= 0) {
                    $status = 'Habis';
                } elseif ($item->stok <= $item->stok_minimum) {
                    $status = 'Stok Menipis';
                }

                fputcsv($file, [
                    $no,
                    $item->kode_part,
                    $item->nama_barang,
                    $item->merk,
                    $item->category?->nama ?? '-',
                    $item->lokasi_rak ?? '-',
                    $item->stok,
                    $item->stok_minimum,
                    number_format($item->harga, 0, ',', '.'),
                    number_format($item->stok * $item->harga, 0, ',', '.'),
                    $status
                ], ';');
            }

            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }

    /**
     * Export transactions to Excel/CSV.
     */
    public function transactions(Request $request)
    {
        $filename = 'data-transaksi-' . now()->format('Y-m-d-His') . '.csv';

        $query = Transaction::with(['sparepart', 'user'])->orderBy('created_at', 'desc');

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Staff only see their transactions
        if (Auth::user()->role !== 'admin') {
            $query->where('user_id', Auth::id());
        }

        $transactions = $query->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function() use ($transactions) {
            $file = fopen('php://output', 'w');

            // Add BOM for Excel to recognize UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Header row
            fputcsv($file, [
                'No',
                'Tanggal',
                'Waktu',
                'Tipe',
                'Kode Part',
                'Nama Barang',
                'Merk',
                'Jumlah',
                'Keterangan',
                'Dicatat Oleh'
            ], ';');

            $no = 0;
            foreach ($transactions as $item) {
                $no++;

                fputcsv($file, [
                    $no,
                    $item->created_at->format('d/m/Y'),
                    $item->created_at->format('H:i'),
                    $item->type === 'masuk' ? 'Barang Masuk' : 'Barang Keluar',
                    $item->sparepart->kode_part,
                    $item->sparepart->nama_barang,
                    $item->sparepart->merk,
                    ($item->type === 'masuk' ? '+' : '-') . $item->quantity,
                    $item->keterangan ?? '-',
                    $item->user->name
                ], ';');
            }

            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }
}
