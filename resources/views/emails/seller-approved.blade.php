<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Disetujui - TOEKOE</title>
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
            border-bottom: 3px solid #1154D4;
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
            color: #1154D4;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .message {
            font-size: 16px;
            color: #555;
            margin-bottom: 15px;
        }
        .highlight {
            background-color: #E8F4FD;
            padding: 15px;
            border-left: 4px solid #1154D4;
            margin: 20px 0;
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
        .success-icon {
            text-align: center;
            font-size: 60px;
            color: #28a745;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">TOEKOE</div>
            <p style="color: #666; margin: 0;">Marketplace Produk Pilihan</p>
        </div>

        <div class="success-icon">✓</div>

        <div class="content">
            <div class="greeting">Selamat, {{ $user->nama }}! 🎉</div>
            
            <p class="message">
                Kami dengan senang hati memberitahukan bahwa pendaftaran toko Anda di TOEKOE telah <strong style="color: #28a745;">DISETUJUI</strong> oleh tim admin kami.
            </p>

            <div class="highlight">
                <strong>Akun Anda sekarang aktif dan siap digunakan!</strong><br>
                Anda dapat mulai mengelola toko dan mengunggah produk Anda.
            </div>

            <div class="info-box">
                <div class="info-item">
                    <span class="info-label">Nama Toko:</span> {{ $user->nama_toko }}
                </div>
                <div class="info-item">
                    <span class="info-label">Email:</span> {{ $user->email }}
                </div>
                <div class="info-item">
                    <span class="info-label">Status:</span> <span style="color: #28a745; font-weight: bold;">Approved</span>
                </div>
            </div>

            <p class="message">
                <strong>Langkah selanjutnya:</strong>
            </p>
            <ul style="color: #555;">
                <li>Login ke dashboard penjual Anda</li>
                <li>Lengkapi profil toko Anda</li>
                <li>Mulai mengunggah produk pertama Anda</li>
                <li>Kelola stok dan harga produk</li>
            </ul>

            <div style="text-align: center;">
                <a href="{{ url('/login') }}" class="button">Login ke Dashboard</a>
            </div>

            <p class="message">
                Jika Anda memiliki pertanyaan atau memerlukan bantuan, jangan ragu untuk menghubungi tim support kami.
            </p>

            <p class="message">
                Terima kasih telah bergabung dengan TOEKOE. Kami berharap kesuksesan untuk toko Anda!
            </p>
        </div>

        <div class="footer">
            <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
            <p>&copy; {{ date('Y') }} TOEKOE. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
