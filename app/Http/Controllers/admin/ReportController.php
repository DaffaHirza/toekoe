<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Laporan Daftar Akun Penjual Aktif dan Tidak Aktif (PDF)
     * SRS-MartPlace-09
     */
    public function sellerStatusReport()
    {
        // Ambil data penjual berdasarkan status
        $sellerApproved = User::where('role', 'seller')
            ->where('status', 'approved')
            ->orderBy('nama_toko')
            ->get();

        $sellerPending = User::where('role', 'seller')
            ->where('status', 'pending')
            ->orderBy('nama_toko')
            ->get();

        $sellerRejected = User::where('role', 'seller')
            ->where('status', 'rejected')
            ->orderBy('nama_toko')
            ->get();

        $sellerSuspend = User::where('role', 'seller')
            ->where('status', 'suspend')
            ->orderBy('nama_toko')
            ->get();

        $data = [
            'title' => 'Laporan Daftar Akun Penjual',
            'tanggal_laporan' => Carbon::now()->locale('id')->format('d F Y'),
            'sellerApproved' => $sellerApproved,
            'sellerPending' => $sellerPending,
            'sellerRejected' => $sellerRejected,
            'sellerSuspend' => $sellerSuspend,
            'totalApproved' => $sellerApproved->count(),
            'totalPending' => $sellerPending->count(),
            'totalRejected' => $sellerRejected->count(),
            'totalSuspend' => $sellerSuspend->count(),
        ];

        $pdf = Pdf::loadView('admin.reports.seller-status', $data);
        return $pdf->download('laporan_akun_penjual_' . date('Y-m-d') . '.pdf');
    }

    /**
     * Laporan Daftar Penjual (Toko) Per Provinsi (PDF)
     * SRS-MartPlace-10
     */
    public function sellerByProvinceReport()
    {
        // Ambil data penjual yang approved, grouped by provinsi
        $sellerByProvince = User::where('role', 'seller')
            ->where('status', 'approved')
            ->orderBy('provinsi')
            ->orderBy('nama_toko')
            ->get()
            ->groupBy('provinsi');

        $data = [
            'title' => 'Laporan Daftar Penjual (Toko) Per Provinsi',
            'tanggal_laporan' => Carbon::now()->locale('id')->format('d F Y'),
            'sellerByProvince' => $sellerByProvince,
            'totalSeller' => User::where('role', 'seller')->where('status', 'approved')->count(),
        ];

        $pdf = Pdf::loadView('admin.reports.seller-by-province', $data);
        return $pdf->download('laporan_penjual_per_provinsi_' . date('Y-m-d') . '.pdf');
    }

    /**
     * Laporan daftar produk dan ratingnya, diurutkan berdasarkan rating menurun (PDF)
     * SRS-MartPlace-11
     */
    public function productsByRatingReport()
    {
        // Ambil produk beserta rata-rata rating, user (toko) dan kategori
        $products = \App\Models\Produk::with(['user', 'category'])
            ->withAvg('reviews', 'rating')
            ->orderByDesc('reviews_avg_rating')
            ->orderByDesc('stok')
            ->get();

        $data = [
            'title' => 'Laporan Produk Berdasarkan Rating',
            'tanggal_laporan' => Carbon::now()->locale('id')->format('d F Y'),
            'products' => $products,
            'totalProducts' => $products->count(),
        ];

        $pdf = Pdf::loadView('admin.reports.products-by-rating', $data);
        return $pdf->download('laporan_produk_berdasarkan_rating_' . date('Y-m-d') . '.pdf');
    }
}
