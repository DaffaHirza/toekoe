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
            border-bottom: 3px solid #1e40af;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #1e40af;
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
            background: #f0f7ff;
            border-left: 4px solid #1e40af;
            padding: 10px 15px;
            margin-bottom: 15px;
            border-radius: 3px;
            font-size: 11px;
        }

        .summary-value {
            color: #1e40af;
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
            background: #1e40af;
            color: white;
            padding: 8px;
            text-align: left;
            font-weight: 600;
            border: 1px solid #1e40af;
        }

        td {
            padding: 7px 8px;
            border: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
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
            <span>Toko Elektronik Marketplace</span>
            <span>{{ $tanggal_laporan }}</span>
        </div>
    </div>
    <div class="summary">
        <strong style="color: #1e40af;">Total Produk:</strong> <span class="summary-value">{{ $totalProducts }}</span>
    </div>
    <table>
        <thead>
            <tr>
                <th class="center" style="width: 5%;">No</th>
                <th style="width: 20%;">Nama Produk</th>
                <th style="width: 15%;">Toko</th>
                <th style="width: 12%;">Kategori</th>
                <th class="right" style="width: 12%;">Harga</th>
                <th class="right" style="width: 10%;">Rating</th>
                <th style="width: 16%;">Provinsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $i => $p)
                <tr>
                    <td class="center">{{ $i + 1 }}</td>
                    <td>{{ substr($p->nama_produk, 0, 30) }}</td>
                    <td>{{ optional($p->user)->nama_toko ?? '-' }}</td>
                    <td>{{ optional($p->category)->nama ?? '-' }}</td>
                    <td class="right">Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                    <td class="right">{{ $p->reviews_avg_rating ? number_format($p->reviews_avg_rating, 1) : '0.0' }} ⭐
                    </td>
                    <td>{{ optional($p->user)->provinsi ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        <p>Laporan ini dibuat otomatis oleh sistem | © 2025 Toko Elektronik</p>
    </div>
</body>

</html>
