<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #2563eb;
            padding-bottom: 15px;
        }

        .header h1 {
            font-size: 24px;
            color: #1e40af;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 12px;
            color: #666;
        }

        .info-box {
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            font-size: 12px;
        }

        .section {
            margin-bottom: 40px;
            page-break-inside: avoid;
        }

        .province-title {
            font-size: 16px;
            font-weight: bold;
            color: white;
            background: #2563eb;
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 4px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .province-count {
            font-size: 14px;
            background: rgba(255, 255, 255, 0.2);
            padding: 4px 12px;
            border-radius: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            margin-bottom: 20px;
        }

        table thead {
            background: #2563eb;
            color: white;
        }

        table th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
        }

        table td {
            padding: 10px 12px;
            border-bottom: 1px solid #e5e7eb;
        }

        table tbody tr:nth-child(even) {
            background: #f9fafb;
        }

        table tbody tr:hover {
            background: #f3f4f6;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            color: #9ca3af;
            font-style: italic;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 11px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
            padding-top: 15px;
        }

        .summary {
            background: #eff6ff;
            border-left: 4px solid #2563eb;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            margin-bottom: 8px;
        }

        .summary-row label {
            font-weight: 600;
            color: #374151;
        }

        .summary-row value {
            color: #1f2937;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>{{ $title }}</h1>
        <p>Laporan Otomatis Sistem TOEKOE Marketplace</p>
    </div>

    <div class="info-box">
        <div>
            <strong>Tanggal Laporan:</strong> {{ $tanggal_laporan }}
        </div>
        <div>
            <strong>Waktu Cetak:</strong> {{ date('H:i:s') }}
        </div>
    </div>

    <!-- Statistik Ringkas -->
    <div class="summary">
        <div class="summary-row">
            <label>Total Penjual Aktif:</label>
            <value>{{ $totalSeller }}</value>
        </div>
        <div class="summary-row">
            <label>Total Provinsi:</label>
            <value>{{ $sellerByProvince->count() }}</value>
        </div>
    </div>

    <!-- Data Per Provinsi -->
    @forelse($sellerByProvince as $province => $sellers)
        <div class="section">
            <div class="province-title">
                <span>📍 {{ $province }}</span>
                <span class="province-count">{{ $sellers->count() }} Toko</span>
            </div>

            <table>
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 25%;">Nama Toko</th>
                        <th style="width: 20%;">Nama Pemilik</th>
                        <th style="width: 20%;">Email</th>
                        <th style="width: 15%;">No. HP</th>
                        <th style="width: 15%;">Kabupaten/Kota</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sellers as $index => $seller)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $seller->nama_toko }}</td>
                            <td>{{ $seller->nama }}</td>
                            <td>{{ $seller->email }}</td>
                            <td>{{ $seller->no_hp }}</td>
                            <td>{{ $seller->kabupaten_kota }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @empty
        <div class="no-data">Tidak ada data penjual aktif untuk ditampilkan</div>
    @endforelse

    <div class="footer">
        <p>Laporan ini dicetak otomatis oleh sistem TOEKOE Marketplace pada {{ $tanggal_laporan }} pukul
            {{ date('H:i:s') }}</p>
    </div>
</body>

</html>
