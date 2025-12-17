<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Stok Sparepart</title>
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
        .stats-grid {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        .stat-box {
            display: table-cell;
            width: 25%;
            padding: 10px;
            text-align: center;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
        }
        .stat-box .label {
            font-size: 9px;
            color: #64748b;
            text-transform: uppercase;
        }
        .stat-box .value {
            font-size: 16px;
            font-weight: bold;
            color: #1e293b;
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
        .status-normal {
            color: #22c55e;
            font-weight: bold;
        }
        .status-low {
            color: #f59e0b;
            font-weight: bold;
        }
        .status-out {
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
        <h1>JDM Inventory - Laporan Stok Sparepart</h1>
        <p>Dicetak pada: {{ now()->format('d M Y, H:i') }} WIB</p>
    </div>

    <div class="stats-grid">
        <div class="stat-box">
            <div class="label">Total Item</div>
            <div class="value">{{ number_format($totalItems) }}</div>
        </div>
        <div class="stat-box">
            <div class="label">Total Stok</div>
            <div class="value">{{ number_format($totalStock) }}</div>
        </div>
        <div class="stat-box">
            <div class="label">Total Nilai</div>
            <div class="value">Rp {{ number_format($totalValue, 0, ',', '.') }}</div>
        </div>
        <div class="stat-box">
            <div class="label">Stok Menipis</div>
            <div class="value" style="color: #f59e0b;">{{ $lowStockCount }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 30px;">No</th>
                <th style="width: 80px;">Kode Part</th>
                <th>Nama Barang</th>
                <th style="width: 70px;">Merk</th>
                <th style="width: 70px;">Kategori</th>
                <th style="width: 50px;">Lokasi</th>
                <th class="text-center" style="width: 50px;">Stok</th>
                <th class="text-center" style="width: 40px;">Min</th>
                <th class="text-right" style="width: 80px;">Harga</th>
                <th class="text-right" style="width: 90px;">Total Nilai</th>
                <th class="text-center" style="width: 60px;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($spareparts as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->kode_part }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->merk }}</td>
                <td>{{ $item->category?->nama ?? '-' }}</td>
                <td>{{ $item->lokasi_rak ?? '-' }}</td>
                <td class="text-center">{{ $item->stok }}</td>
                <td class="text-center">{{ $item->stok_minimum }}</td>
                <td class="text-right">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($item->stok * $item->harga, 0, ',', '.') }}</td>
                <td class="text-center">
                    @if($item->stok <= 0)
                        <span class="status-out">HABIS</span>
                    @elseif($item->stok <= $item->stok_minimum)
                        <span class="status-low">MENIPIS</span>
                    @else
                        <span class="status-normal">OK</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>JDM Inventory System &copy; {{ date('Y') }} - Laporan ini digenerate secara otomatis</p>
    </div>
</body>
</html>
