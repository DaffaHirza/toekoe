<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Laporan daftar stock produk yang diurutkan berdasarkan stok menurun (PDF)
     * SRS-MartPlace-12
     */
    public function stockByStockReport()
    {
        $user = Auth::user();
        $products = Produk::where('user_id', $user->id)
            ->withAvg('reviews', 'rating')
            ->with('category')
            ->orderByDesc('stok')
            ->get();

        $data = [
            'title' => 'Laporan Stock Produk',
            'tanggal_laporan' => Carbon::now()->locale('id')->format('d F Y'),
            'products' => $products,
            'totalProducts' => $products->count(),
            'seller' => $user,
        ];

        $pdf = Pdf::loadView('seller.reports.stock-by-stock', $data);
        return $pdf->download('laporan_stock_produk_by_stock_' . date('Y-m-d') . '.pdf');
    }

    /**
     * Laporan daftar stock produk yang diurutkan berdasarkan rating menurun (PDF)
     * SRS-MartPlace-13
     */
    public function stockByRatingReport()
    {
        $user = Auth::user();
        $products = Produk::where('user_id', $user->id)
            ->withAvg('reviews', 'rating')
            ->with('category')
            ->orderByDesc('reviews_avg_rating')
            ->orderByDesc('stok')
            ->get();

        $data = [
            'title' => 'Laporan Stock Produk',
            'tanggal_laporan' => Carbon::now()->locale('id')->format('d F Y'),
            'products' => $products,
            'totalProducts' => $products->count(),
            'seller' => $user,
        ];

        $pdf = PDF::loadView('seller.reports.stock-by-rating', $data);
        return $pdf->download('laporan_stock_produk_by_rating_' . date('Y-m-d') . '.pdf');
    }

    /**
     * Laporan daftar stock produk yang harus segera dipesan (stok < 2) (PDF)
     * SRS-MartPlace-14
     */
    public function lowStockReport()
    {
        $user = Auth::user();
        $products = Produk::where('user_id', $user->id)
            ->withAvg('reviews', 'rating')
            ->with('category')
            ->where('stok', '<', 2)
            ->orderBy('stok')
            ->get();

        $data = [
            'title' => 'Laporan Produk Low Stock',
            'tanggal_laporan' => Carbon::now()->locale('id')->format('d F Y'),
            'products' => $products,
            'totalProducts' => $products->count(),
            'seller' => $user,
        ];

        $pdf = PDF::loadView('seller.reports.low-stock', $data);
        return $pdf->download('laporan_low_stock_' . date('Y-m-d') . '.pdf');
    }
}
