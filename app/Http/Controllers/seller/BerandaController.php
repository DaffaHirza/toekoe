<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // 1. Stok setiap produk milik seller
        $stokProduk = Produk::where('user_id', $userId)
            ->select('nama_produk as nama', 'stok')
            ->orderBy('stok', 'desc')
            ->get();

        // 2. Rating per produk milik seller
        $ratingProduk = Produk::where('user_id', $userId)
            ->leftJoin('reviews', 'product.id', '=', 'reviews.produk_id')
            ->select(
                'product.nama_produk as nama',
                DB::raw('COALESCE(AVG(reviews.rating), 0) as rata_rating'),
                DB::raw('COUNT(reviews.id) as total_rating')
            )
            ->groupBy('product.id', 'product.nama_produk')
            ->orderBy('rata_rating', 'desc')
            ->get();

        // 3. Pemberi rating berdasarkan provinsi
        $ratingByProvinsi = Produk::where('product.user_id', $userId)
            ->leftJoin('reviews', 'product.id', '=', 'reviews.produk_id')
            ->select(
                'reviews.provinsi',
                DB::raw('COUNT(reviews.id) as total_rating')
            )
            ->where('reviews.provinsi', '!=', null)
            ->groupBy('reviews.provinsi')
            ->orderBy('total_rating', 'desc')
            ->get();

        // Statistik umum
        $totalProduk = Produk::where('user_id', $userId)->count();
        $totalStok = Produk::where('user_id', $userId)->sum('stok');
        $totalReview = Review::whereIn('produk_id', Produk::where('user_id', $userId)->pluck('id'))->count();
        $rataRating = Review::whereIn('produk_id', Produk::where('user_id', $userId)->pluck('id'))
            ->avg('rating') ?? 0;

        return view('seller.beranda', compact(
            'stokProduk',
            'ratingProduk',
            'ratingByProvinsi',
            'totalProduk',
            'totalStok',
            'totalReview',
            'rataRating'
        ));
    }
}
