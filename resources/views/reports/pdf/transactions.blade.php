<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
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
            font-size: 20px;
            color: #4f46e5;
            margin-bottom: 5px;
        }
        .header p {
            color: #666;
            font-size: 11px;
        }
        .period {
            background: #f0f9ff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center;
        }
        .period strong {
            color: #0369a1;
        }
        .stats-grid {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        .stat-box {
            display: table-cell;
            width: 33.33%;
            padding: 10px;
            text-align: center;
            border: 1px solid #e2e8f0;
        }
        .stat-box .label {
            font-size: 9px;
            color: #64748b;
            text-transform: uppercase;
        }
        .stat-box .value {
            font-size: 18px;
            font-weight: bold;
        }
        .stat-box.masuk .value {
            color: #22c55e;
        }
        .stat-box.keluar .value {
            color: #ef4444;
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
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 8px;
            font-weight: bold;
        }
        .badge-masuk {
            background: #dcfce7;
            color: #166534;
        }
        .badge-keluar {
            background: #fee2e2;
            color: #991b1b;
        }
        .qty-masuk {
            color: #22c55e;
            font-weight: bold;
        }
        .qty-keluar {
            color: #ef4444;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            font-size: 9px;
            color: #64748b;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>JDM Inventory - Laporan Transaksi</h1>
        <p>Dicetak pada: {{ now()->format('d M Y, H:i') }} WIB</p>
    </div>

    <div class="period">
        <strong>Periode:</strong> {{ $stats['from_date'] }} - {{ $stats['to_date'] }}
    </div>

    <div class="stats-grid">
        <div class="stat-box">
            <div class="label">Total Transaksi</div>
            <div class="value">{{ $stats['total'] }}</div>
        </div>
        <div class="stat-box masuk">
            <div class="label">Total Masuk</div>
            <div class="value">+{{ number_format($stats['masuk']) }} unit</div>
        </div>
        <div class="stat-box keluar">
            <div class="label">Total Keluar</div>
            <div class="value">-{{ number_format($stats['keluar']) }} unit</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 30px;">No</th>
                <th style="width: 70px;">Tanggal</th>
                <th style="width: 45px;">Waktu</th>
                <th style="width: 60px;">Tipe</th>
                <th style="width: 70px;">Kode Part</th>
                <th>Nama Barang</th>
                <th style="width: 60px;">Merk</th>
                <th class="text-center" style="width: 50px;">Jumlah</th>
                <th>Keterangan</th>
                <th style="width: 80px;">Dicatat Oleh</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $index => $trans)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $trans->created_at->format('d/m/Y') }}</td>
                <td>{{ $trans->created_at->format('H:i') }}</td>
                <td>
                    <span class="badge {{ $trans->type === 'masuk' ? 'badge-masuk' : 'badge-keluar' }}">
                        {{ $trans->type === 'masuk' ? 'MASUK' : 'KELUAR' }}
                    </span>
                </td>
                <td>{{ $trans->sparepart->kode_part }}</td>
                <td>{{ $trans->sparepart->nama_barang }}</td>
                <td>{{ $trans->sparepart->merk }}</td>
                <td class="text-center {{ $trans->type === 'masuk' ? 'qty-masuk' : 'qty-keluar' }}">
                    {{ $trans->type === 'masuk' ? '+' : '-' }}{{ $trans->quantity }}
                </td>
                <td>{{ $trans->keterangan ?? '-' }}</td>
                <td>{{ $trans->user->name }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="10" class="text-center" style="padding: 30px;">Tidak ada transaksi pada periode ini</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>JDM Inventory System &copy; {{ date('Y') }} - Laporan ini digenerate secara otomatis</p>
    </div>
</body>
</html>
