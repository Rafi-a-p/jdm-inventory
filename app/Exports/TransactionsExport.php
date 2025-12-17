<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransactionsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $fromDate;
    protected $toDate;
    protected $type;
    protected $userId;

    public function __construct($fromDate = null, $toDate = null, $type = null, $userId = null)
    {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->type = $type;
        $this->userId = $userId;
    }

    public function collection()
    {
        $query = Transaction::with(['sparepart', 'user'])->orderBy('created_at', 'desc');

        if ($this->fromDate) {
            $query->whereDate('created_at', '>=', $this->fromDate);
        }

        if ($this->toDate) {
            $query->whereDate('created_at', '<=', $this->toDate);
        }

        if ($this->type) {
            $query->where('type', $this->type);
        }

        if ($this->userId) {
            $query->where('user_id', $this->userId);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal',
            'Waktu',
            'Tipe',
            'Kode Part',
            'Nama Barang',
            'Merk',
            'Jumlah',
            'Keterangan',
            'Dicatat Oleh',
        ];
    }

    public function map($transaction): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $transaction->created_at->format('d/m/Y'),
            $transaction->created_at->format('H:i'),
            $transaction->type === 'masuk' ? 'Barang Masuk' : 'Barang Keluar',
            $transaction->sparepart->kode_part,
            $transaction->sparepart->nama_barang,
            $transaction->sparepart->merk,
            ($transaction->type === 'masuk' ? '+' : '-') . $transaction->quantity,
            $transaction->keterangan ?? '-',
            $transaction->user->name,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']]],
        ];
    }
}
