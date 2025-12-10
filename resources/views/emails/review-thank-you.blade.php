<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih atas Review Anda - TOEKOE</title>
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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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

        .star-rating {
            text-align: center;
            font-size: 36px;
            margin: 15px 0;
            letter-spacing: 5px;
        }

        .product-name {
            font-size: 18px;
            color: #1154D4;
            font-weight: bold;
            margin: 15px 0;
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
            <div class="greeting">Terima Kasih, {{ $review->nama_pengunjung }}! 🎉</div>

            <p class="message">
                Kami berterima kasih atas review yang telah Anda berikan untuk produk di TOEKOE.
            </p>

            <div class="product-name">
                @if (isset($product))
                    📦 {{ $product->nama_produk }}
                @else
                    📦 Produk Anda
                @endif
            </div>

            <div class="star-rating">
                @for ($i = 0; $i < $review->rating; $i++)
                    ⭐
                @endfor
            </div>

            <div class="highlight">
                <strong>Review Anda telah berhasil ditambahkan!</strong><br>
                Masukan Anda sangat berharga dan membantu komunitas Toekoe berkembang dengan lebih baik.
            </div>

            <div class="info-box">
                <div class="info-item">
                    <span class="info-label">Nama Anda:</span> {{ $review->nama_pengunjung }}
                </div>
                <div class="info-item">
                    <span class="info-label">Email:</span> {{ $review->email }}
                </div>
                <div class="info-item">
                    <span class="info-label">No. Handphone:</span> {{ $review->nomor_hp }}
                </div>
                <div class="info-item">
                    <span class="info-label">Rating:</span> <span
                        style="color: #FFC107; font-weight: bold;">{{ $review->rating }} ⭐</span>
                </div>
                @if (!empty($review->provinsi))
                    <div class="info-item">
                        <span class="info-label">Provinsi:</span> {{ $review->provinsi }}
                    </div>
                @endif
            </div>

            <p class="message">
                <strong>Komentar Anda:</strong>
            </p>
            <div
                style="background-color: #f8f9fa; padding: 15px; border-radius: 5px; border-left: 4px solid #1154D4; margin: 15px 0;">
                <p style="color: #555; margin: 0;">{{ $review->komentar }}</p>
            </div>

            <p class="message" style="margin-top: 25px;">
                Semua review kami moderasi untuk memastikan kualitas dan kepercayaan dalam komunitas Toekoe. Review Anda
                akan membantu pembeli lain membuat keputusan yang tepat.
            </p>

            <p class="message">
                Jika Anda ingin memberikan review tambahan untuk produk lain, silakan kunjungi toko kami kembali.
            </p>

            <div style="text-align: center;">
                <a href="{{ url('/') }}" class="button">Kembali ke TOEKOE</a>
            </div>
        </div>

        <div class="footer">
            <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
            <p>&copy; {{ date('Y') }} TOEKOE. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
