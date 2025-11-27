<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemberitahuan Pendaftaran - TOEKOE</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 3px solid #dc3545;
        }
        .logo {
            font-size: 32px;
            font-weight: bold;
            color: #1154D4;
            margin-bottom: 10px;
        }
        .content {
            padding: 30px 0;
        }
        .greeting {
            font-size: 24px;
            color: #dc3545;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .message {
            font-size: 16px;
            color: #555;
            margin-bottom: 15px;
        }
        .highlight {
            background-color: #fff3cd;
            padding: 15px;
            border-left: 4px solid #ffc107;
            margin: 20px 0;
        }
        .reason-box {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .reason-label {
            font-weight: bold;
            color: #721c24;
            margin-bottom: 10px;
            display: block;
        }
        .reason-text {
            color: #721c24;
            font-size: 15px;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #1154D4;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: bold;
        }
        .button:hover {
            background-color: #0d3fa8;
        }
        .info-box {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .info-item {
            margin: 10px 0;
        }
        .info-label {
            font-weight: bold;
            color: #1154D4;
        }
        .footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 14px;
            color: #777;
        }
        .warning-icon {
            text-align: center;
            font-size: 60px;
            color: #dc3545;
            margin: 20px 0;
        }
        .steps {
            background-color: #e7f3ff;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .steps ol {
            margin: 10px 0;
            padding-left: 20px;
        }
        .steps li {
            margin: 8px 0;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">TOEKOE</div>
            <p style="color: #666; margin: 0;">Marketplace Produk Pilihan</p>
        </div>

        <div class="warning-icon">⚠</div>

        <div class="content">
            <div class="greeting">Pemberitahuan Pendaftaran</div>
            
            <p class="message">
                Halo <strong>{{ $user->nama }}</strong>,
            </p>

            <p class="message">
                Terima kasih atas minat Anda untuk bergabung sebagai penjual di TOEKOE. Setelah meninjau pendaftaran Anda, kami mohon maaf untuk memberitahukan bahwa pendaftaran toko <strong>"{{ $user->nama_toko }}"</strong> belum dapat kami setujui pada saat ini.
            </p>

            @if($reason)
            <div class="reason-box">
                <span class="reason-label">Alasan Penolakan:</span>
                <div class="reason-text">{{ $reason }}</div>
            </div>
            @endif

            <div class="highlight">
                <strong>Apa yang dapat Anda lakukan?</strong><br>
                Anda dapat mendaftar kembali dengan memperbaiki informasi sesuai dengan alasan penolakan di atas.
            </div>

            <div class="steps">
                <strong style="color: #1154D4;">Langkah untuk Mendaftar Ulang:</strong>
                <ol>
                    <li>Tinjau kembali alasan penolakan di atas</li>
                    <li>Pastikan semua informasi yang diberikan akurat dan lengkap</li>
                    <li>Pastikan dokumen KTP jelas dan terbaca</li>
                    <li>Foto toko/produk berkualitas baik</li>
                    <li>Daftar kembali melalui website TOEKOE</li>
                </ol>
            </div>

            <div class="info-box">
                <div class="info-item">
                    <span class="info-label">Nama Toko:</span> {{ $user->nama_toko }}
                </div>
                <div class="info-item">
                    <span class="info-label">Email:</span> {{ $user->email }}
                </div>
                <div class="info-item">
                    <span class="info-label">Status:</span> <span style="color: #dc3545; font-weight: bold;">Rejected</span>
                </div>
            </div>

            <p class="message">
                Kami menghargai usaha Anda dan berharap Anda dapat memperbaiki pendaftaran dan bergabung kembali dengan kami.
            </p>

            <div style="text-align: center;">
                <a href="{{ url('/register') }}" class="button">Daftar Ulang</a>
            </div>

            <p class="message">
                Jika Anda memiliki pertanyaan atau memerlukan klarifikasi lebih lanjut, silakan hubungi tim support kami.
            </p>

            <p class="message">
                Terima kasih atas pengertian Anda.
            </p>
        </div>

        <div class="footer">
            <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
            <p>Untuk bantuan, hubungi: support@toekoe.com</p>
            <p>&copy; {{ date('Y') }} TOEKOE. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
