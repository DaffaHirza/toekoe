<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Produk;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1. Produk berdasarkan Kategori
        $produkByKategori = Category::withCount('produk')
            ->get()
            ->pluck('produk_count', 'nama')
            ->toArray();

        // 2. Toko (User Seller) berdasarkan Provinsi
        $tokoByProvinsi = User::where('role', 'seller')
            ->select('provinsi', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('provinsi')
            ->pluck('jumlah', 'provinsi')
            ->toArray();

        // 3. User Penjual Aktif vs Tidak Aktif (berdasarkan status: approved/rejected)
        $userSellerStatus = User::where('role', 'seller')
            ->select(DB::raw('CASE WHEN status = "approved" THEN "Aktif" ELSE "Tidak Aktif" END as status_label'), DB::raw('COUNT(*) as jumlah'))
            ->groupBy('status')
            ->pluck('jumlah', 'status_label')
            ->toArray();

        // 4. Pengunjung yang memberikan komentar dan rating
        $pengunjungReview = Review::select(DB::raw('COUNT(*) as jumlah'))
            ->first()
            ->jumlah ?? 0;

        // Total statistik kartu
        $totalProduk = Produk::count();
        $totalToko = User::where('role', 'seller')->count();
        $totalUserAktif = User::where('role', 'seller')->where('status', 'approved')->count();
        $totalReview = $pengunjungReview;

        return view('admin.beranda', [
            'produkByKategori' => $produkByKategori,
            'tokoByProvinsi' => $tokoByProvinsi,
            'userSellerStatus' => $userSellerStatus,
            'totalProduk' => $totalProduk,
            'totalToko' => $totalToko,
            'totalUserAktif' => $totalUserAktif,
            'totalReview' => $totalReview,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
