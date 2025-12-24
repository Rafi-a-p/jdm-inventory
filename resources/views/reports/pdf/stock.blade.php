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
            font-size: 8px;
            line-height: 1.3;
            color: #333;
        }
        .header {
            text-align: center;
            padding: 15px 0;
            border-bottom: 2px solid #4f46e5;
            margin-bottom: 15px;
        }
        .header h1 {
            font-size: 16px;
            color: #4f46e5;
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
            width: 25%;
            padding: 8px 4px;
            text-align: center;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
        }
        .stat-box .label {
            font-size: 7px;
            color: #64748b;
            text-transform: uppercase;
        }
        .stat-box .value {
            font-size: 12px;
            font-weight: bold;
            color: #1e293b;
            margin-top: 2px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background: #4f46e5;
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
            <div class="value">Rp {{ number_format($totalValue / 1000000, 1) }}jt</div>
        </div>
        <div class="stat-box">
            <div class="label">Stok Menipis</div>
            <div class="value" style="color: #f59e0b;">{{ $lowStockCount }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 20px;">No</th>
                <th style="width: 60px;">Kode Part</th>
                <th>Nama Barang</th>
                <th style="width: 50px;">Merk</th>
                <th style="width: 35px;" class="text-center">Stok</th>
                <th style="width: 30px;" class="text-center">Min</th>
                <th style="width: 55px;" class="text-right">Harga</th>
                <th style="width: 40px;" class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($spareparts as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->kode_part }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->merk }}</td>
                <td class="text-center">{{ $item->stok }}</td>
                <td class="text-center">{{ $item->stok_minimum }}</td>
                <td class="text-right">{{ number_format($item->harga / 1000, 0) }}k</td>
                <td class="text-center">
                    @if($item->stok <= 0)
                        <span class="status-out">HABIS</span>
                    @elseif($item->stok <= $item->stok_minimum)
                        <span class="status-low">LOW</span>
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
