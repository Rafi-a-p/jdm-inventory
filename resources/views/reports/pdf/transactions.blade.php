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
            font-size: 8px;
            line-height: 1.3;
            color: #333;
        }
        .header {
            text-align: center;
            padding: 15px 0;
            border-bottom: 2px solid #10b981;
            margin-bottom: 15px;
        }
        .header h1 {
            font-size: 16px;
            color: #10b981;
            margin-bottom: 3px;
        }
        .header p {
            color: #666;
            font-size: 9px;
        }
        .stats-grid {
            display: table;
            width: 100%;
            margin-bottom: 15px;
        }
        .stat-box {
            display: table-cell;
            width: 33.33%;
            padding: 8px 4px;
            text-align: center;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
        }
        .stat-box .label {
            font-size: 7px;
            color: #166534;
            text-transform: uppercase;
        }
        .stat-box .value {
            font-size: 12px;
            font-weight: bold;
            color: #15803d;
            margin-top: 2px;
        }
        .period {
            text-align: center;
            padding: 8px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            margin-bottom: 12px;
            font-size: 9px;
            color: #475569;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background: #10b981;
            color: white;
            padding: 5px 3px;
            text-align: left;
            font-size: 7px;
            text-transform: uppercase;
            font-weight: bold;
        }
        td {
            padding: 4px 3px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 7px;
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
        .badge-masuk {
            background: #dcfce7;
            color: #166534;
            padding: 1px 4px;
            border-radius: 2px;
            font-weight: bold;
            font-size: 6px;
        }
        .badge-keluar {
            background: #fee2e2;
            color: #991b1b;
            padding: 1px 4px;
            border-radius: 2px;
            font-weight: bold;
            font-size: 6px;
        }
        .footer {
            margin-top: 20px;
            padding-top: 8px;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            font-size: 7px;
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
        <strong>Periode:</strong> {{ $stats['from_date'] }} s/d {{ $stats['to_date'] }}
    </div>

    <div class="stats-grid">
        <div class="stat-box">
            <div class="label">Total Transaksi</div>
            <div class="value">{{ number_format($stats['total']) }}</div>
        </div>
        <div class="stat-box">
            <div class="label">Barang Masuk</div>
            <div class="value">{{ number_format($stats['masuk']) }}</div>
        </div>
        <div class="stat-box">
            <div class="label">Barang Keluar</div>
            <div class="value">{{ number_format($stats['keluar']) }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 18px;">No</th>
                <th style="width: 55px;">Tanggal/Waktu</th>
                <th style="width: 45px;">Tipe</th>
                <th style="width: 55px;">Kode Part</th>
                <th>Nama Barang</th>
                <th class="text-center" style="width: 35px;">Qty</th>
                <th style="width: 80px;">Keterangan</th>
                <th style="width: 60px;">User</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->created_at->format('d/m/y H:i') }}</td>
                <td>
                    @if($item->type === 'masuk')
                        <span class="badge-masuk">MASUK</span>
                    @else
                        <span class="badge-keluar">KELUAR</span>
                    @endif
                </td>
                <td>{{ $item->sparepart->kode_part }}</td>
                <td>{{ $item->sparepart->nama_barang }}</td>
                <td class="text-center">
                    @if($item->type === 'masuk')
                        <span style="color: #16a34a; font-weight: bold;">+{{ $item->quantity }}</span>
                    @else
                        <span style="color: #dc2626; font-weight: bold;">-{{ $item->quantity }}</span>
                    @endif
                </td>
                <td>{{ Str::limit($item->keterangan ?? '-', 30) }}</td>
                <td>{{ $item->user->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>JDM Inventory System &copy; {{ date('Y') }} - Laporan ini digenerate secara otomatis</p>
    </div>
</body>
</html>
