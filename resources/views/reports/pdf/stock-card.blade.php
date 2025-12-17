<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Stok - {{ $sparepart->nama_barang }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 10px;
            line-height: 1.4;
            color: #333;
        }
        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 2px solid #4f46e5;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 18px;
            color: #4f46e5;
            margin-bottom: 5px;
        }
        .header p {
            color: #666;
            font-size: 11px;
        }
        .item-info {
            background: #f8fafc;
            padding: 15px;
            border: 1px solid #e2e8f0;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .item-info h2 {
            font-size: 14px;
            color: #1e293b;
            margin-bottom: 10px;
        }
        .info-grid {
            display: table;
            width: 100%;
        }
        .info-item {
            display: table-cell;
            width: 25%;
        }
        .info-item .label {
            font-size: 9px;
            color: #64748b;
            text-transform: uppercase;
        }
        .info-item .value {
            font-size: 11px;
            font-weight: bold;
            color: #1e293b;
        }
        .period {
            background: #eff6ff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center;
            font-size: 10px;
        }
        .period strong {
            color: #1d4ed8;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background: #4f46e5;
            color: white;
            padding: 8px 6px;
            text-align: left;
            font-size: 9px;
            text-transform: uppercase;
        }
        td {
            padding: 8px 6px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 9px;
        }
        tr:nth-child(even) {
            background: #f8fafc;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .qty-masuk {
            color: #22c55e;
            font-weight: bold;
        }
        .qty-keluar {
            color: #ef4444;
            font-weight: bold;
        }
        .balance {
            font-weight: bold;
            color: #1e293b;
        }
        .footer {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            font-size: 9px;
            color: #64748b;
        }
        .saldo-awal {
            background: #fef3c7;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>KARTU STOK</h1>
        <p>JDM Inventory System</p>
    </div>

    <div class="item-info">
        <h2>{{ $sparepart->nama_barang }}</h2>
        <div class="info-grid">
            <div class="info-item">
                <div class="label">Kode Part</div>
                <div class="value">{{ $sparepart->kode_part }}</div>
            </div>
            <div class="info-item">
                <div class="label">Merk</div>
                <div class="value">{{ $sparepart->merk }}</div>
            </div>
            <div class="info-item">
                <div class="label">Kategori</div>
                <div class="value">{{ $sparepart->category?->nama ?? '-' }}</div>
            </div>
            <div class="info-item">
                <div class="label">Lokasi Rak</div>
                <div class="value">{{ $sparepart->lokasi_rak ?? '-' }}</div>
            </div>
        </div>
    </div>

    <div class="period">
        <strong>Periode:</strong> {{ $fromDate }} - {{ $toDate }}
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 30px;">No</th>
                <th style="width: 80px;">Tanggal</th>
                <th style="width: 50px;">Waktu</th>
                <th>Keterangan</th>
                <th class="text-center" style="width: 70px;">Masuk</th>
                <th class="text-center" style="width: 70px;">Keluar</th>
                <th class="text-center" style="width: 70px;">Saldo</th>
                <th style="width: 80px;">Oleh</th>
            </tr>
        </thead>
        <tbody>
            <tr class="saldo-awal">
                <td></td>
                <td colspan="3"><strong>Saldo Awal</strong></td>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
                <td class="text-center balance">{{ $stockBefore }}</td>
                <td>-</td>
            </tr>
            @forelse($transactions as $index => $trans)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $trans->created_at->format('d/m/Y') }}</td>
                <td>{{ $trans->created_at->format('H:i') }}</td>
                <td>{{ $trans->keterangan ?? ($trans->type === 'masuk' ? 'Barang Masuk' : 'Barang Keluar') }}</td>
                <td class="text-center qty-masuk">
                    {{ $trans->type === 'masuk' ? '+' . $trans->quantity : '-' }}
                </td>
                <td class="text-center qty-keluar">
                    {{ $trans->type === 'keluar' ? '-' . $trans->quantity : '-' }}
                </td>
                <td class="text-center balance">{{ $trans->running_balance }}</td>
                <td>{{ $trans->user->name }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center" style="padding: 20px;">Tidak ada transaksi pada periode ini</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px; padding: 10px; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 5px;">
        <strong>Stok Akhir Saat Ini:</strong> {{ $sparepart->stok }} unit
        @if($sparepart->stok <= $sparepart->stok_minimum)
            <span style="color: #dc2626; margin-left: 10px;">⚠ Stok di bawah minimum ({{ $sparepart->stok_minimum }})</span>
        @endif
    </div>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d M Y, H:i') }} WIB</p>
        <p>JDM Inventory System &copy; {{ date('Y') }}</p>
    </div>
</body>
</html>
