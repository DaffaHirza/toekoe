<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #000;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .header h1 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 10px;
            color: #666;
        }

        .info-box {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            font-size: 10px;
        }

        .summary {
            border: 1px solid #000;
            padding: 10px;
            margin-bottom: 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .summary-row label {
            font-weight: bold;
        }

        .section {
            margin-bottom: 20px;
            page-break-inside: avoid;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            margin-bottom: 15px;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        table th {
            font-weight: bold;
            background: #f0f0f0;
        }

        .no-data {
            text-align: center;
            padding: 15px;
            font-style: italic;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 9px;
            border-top: 1px solid #000;
            padding-top: 10px;
        }

        @media print {
            body {
                margin: 0;
                padding: 15px;
            }
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
            <label>Total Penjual Aktif (Approved):</label>
            <value>{{ $totalApproved }}</value>
        </div>
        <div class="summary-row">
            <label>Total Penjual Menunggu Verifikasi (Pending):</label>
            <value>{{ $totalPending }}</value>
        </div>
        <div class="summary-row">
            <label>Total Penjual Ditolak (Rejected):</label>
            <value>{{ $totalRejected }}</value>
        </div>
        <div class="summary-row">
            <label>Total Penjual Disuspend (Suspend):</label>
            <value>{{ $totalSuspend }}</value>
        </div>
        <div class="summary-row" style="border-top: 1px solid #bfdbfe; padding-top: 8px; margin-top: 8px;">
            <label style="font-size: 14px;">Total Keseluruhan:</label>
            <value style="font-size: 14px;">{{ $totalApproved + $totalPending + $totalRejected + $totalSuspend }}
            </value>
        </div>
    </div>

    <!-- Penjual Aktif -->
    <div class="section">
        <h2 class="section-title">
            <span style="color: #10b981;">✓</span> Penjual Aktif (Disetujui)
        </h2>
        @if ($sellerApproved->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 25%;">Nama Toko</th>
                        <th style="width: 20%;">Nama Pemilik</th>
                        <th style="width: 20%;">Email</th>
                        <th style="width: 15%;">No. HP</th>
                        <th style="width: 15%;">Provinsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sellerApproved as $index => $seller)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $seller->nama_toko }}</td>
                            <td>{{ $seller->nama }}</td>
                            <td>{{ $seller->email }}</td>
                            <td>{{ $seller->no_hp }}</td>
                            <td>{{ $seller->provinsi }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-data">Tidak ada penjual aktif</div>
        @endif
    </div>

    <!-- Penjual Menunggu Verifikasi -->
    <div class="section">
        <h2 class="section-title">
            <span style="color: #f59e0b;">⏳</span> Penjual Menunggu Verifikasi (Pending)
        </h2>
        @if ($sellerPending->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 25%;">Nama Toko</th>
                        <th style="width: 20%;">Nama Pemilik</th>
                        <th style="width: 20%;">Email</th>
                        <th style="width: 15%;">No. HP</th>
                        <th style="width: 15%;">Provinsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sellerPending as $index => $seller)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $seller->nama_toko }}</td>
                            <td>{{ $seller->nama }}</td>
                            <td>{{ $seller->email }}</td>
                            <td>{{ $seller->no_hp }}</td>
                            <td>{{ $seller->provinsi }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-data">Tidak ada penjual yang pending</div>
        @endif
    </div>

    <!-- Penjual Ditolak -->
    <div class="section">
        <h2 class="section-title">
            <span style="color: #ef4444;">✕</span> Penjual Ditolak (Rejected)
        </h2>
        @if ($sellerRejected->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 25%;">Nama Toko</th>
                        <th style="width: 20%;">Nama Pemilik</th>
                        <th style="width: 20%;">Email</th>
                        <th style="width: 15%;">No. HP</th>
                        <th style="width: 15%;">Provinsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sellerRejected as $index => $seller)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $seller->nama_toko }}</td>
                            <td>{{ $seller->nama }}</td>
                            <td>{{ $seller->email }}</td>
                            <td>{{ $seller->no_hp }}</td>
                            <td>{{ $seller->provinsi }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-data">Tidak ada penjual yang ditolak</div>
        @endif
    </div>

    <!-- Penjual Disuspend -->
    <div class="section">
        <h2 class="section-title">
            <span style="color: #8b5cf6;">⊗</span> Penjual Disuspend (Suspend)
        </h2>
        @if ($sellerSuspend->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 25%;">Nama Toko</th>
                        <th style="width: 20%;">Nama Pemilik</th>
                        <th style="width: 20%;">Email</th>
                        <th style="width: 15%;">No. HP</th>
                        <th style="width: 15%;">Provinsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sellerSuspend as $index => $seller)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $seller->nama_toko }}</td>
                            <td>{{ $seller->nama }}</td>
                            <td>{{ $seller->email }}</td>
                            <td>{{ $seller->no_hp }}</td>
                            <td>{{ $seller->provinsi }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-data">Tidak ada penjual yang disuspend</div>
        @endif
    </div>

    <div class="footer">
        <p>Laporan ini dicetak otomatis oleh sistem TOEKOE Marketplace pada {{ $tanggal_laporan }} pukul
            {{ date('H:i:s') }}</p>
    </div>
</body>

</html>
