<?php

namespace App\Exports;

use App\Models\Sparepart;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SparepartsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $categoryId;

    public function __construct($categoryId = null)
    {
        $this->categoryId = $categoryId;
    }

    public function collection()
    {
        $query = Sparepart::with('category')->orderBy('nama_barang');

        if ($this->categoryId) {
            $query->where('category_id', $this->categoryId);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
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
            'Status',
        ];
    }

    public function map($sparepart): array
    {
        static $no = 0;
        $no++;

        $status = 'Normal';
        if ($sparepart->stok <= 0) {
            $status = 'Habis';
        } elseif ($sparepart->stok <= $sparepart->stok_minimum) {
            $status = 'Stok Menipis';
        }

        return [
            $no,
            $sparepart->kode_part,
            $sparepart->nama_barang,
            $sparepart->merk,
            $sparepart->category?->nama ?? '-',
            $sparepart->lokasi_rak ?? '-',
            $sparepart->stok,
            $sparepart->stok_minimum,
            number_format($sparepart->harga, 0, ',', '.'),
            number_format($sparepart->stok * $sparepart->harga, 0, ',', '.'),
            $status,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']]],
        ];
    }
}
