<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        @page {
            size: A4;
            margin: 20mm 15mm 25mm 15mm;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Segoe UI, Arial, sans-serif;
            color: #333;
            line-height: 1.4;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #10b981;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #10b981;
            font-size: 18px;
            margin-bottom: 5px;
            font-weight: 700;
        }

        .header-info {
            font-size: 10px;
            color: #666;
            display: flex;
            justify-content: space-between;
            margin-top: 8px;
        }

        .summary {
            background: #f0fdf4;
            border-left: 4px solid #10b981;
            padding: 10px 15px;
            margin-bottom: 15px;
            border-radius: 3px;
            font-size: 11px;
        }

        .summary-value {
            color: #10b981;
            font-weight: 700;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            margin-bottom: 15px;
        }

        th {
            background: #10b981;
            color: white;
            padding: 8px;
            text-align: left;
            font-weight: 600;
            border: 1px solid #10b981;
        }

        td {
            padding: 7px 8px;
            border: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background: #f9faf8;
        }

        .right {
            text-align: right;
        }

        .center {
            text-align: center;
        }

        .footer {
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 8px;
            font-size: 9px;
            color: #666;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>{{ $title }}</h1>
        <div class="header-info">
            <span>{{ optional($seller)->nama_toko ?? 'Toko' }}</span>
            <span>{{ $tanggal_laporan }}</span>
        </div>
    </div>
    <div class="summary">
        <strong style="color: #10b981;">Total Produk:</strong> <span class="summary-value">{{ $products->count() }}</span>
    </div>
    <table>
        <thead>
            <tr>
                <th class="center" style="width: 5%;">No</th>
                <th style="width: 30%;">Nama Produk</th>
                <th style="width: 15%;">Kategori</th>
                <th class="right" style="width: 15%;">Harga</th>
                <th class="right" style="width: 12%;">Stok</th>
                <th class="right" style="width: 13%;">Rating</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $i => $p)
                <tr>
                    <td class="center">{{ $i + 1 }}</td>
                    <td>{{ substr($p->nama_produk, 0, 35) }}</td>
                    <td>{{ optional($p->category)->nama ?? '-' }}</td>
                    <td class="right">Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                    <td class="right">{{ $p->stok }}</td>
                    <td class="right">{{ $p->reviews_avg_rating ? number_format($p->reviews_avg_rating, 1) : '0.0' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        <p>Laporan ini dibuat otomatis oleh sistem | © 2025 Toko Elektronik</p>
    </div>
</body>

</html>
