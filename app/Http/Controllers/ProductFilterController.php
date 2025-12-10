<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class ProductFilterController extends Controller
{
    public function index(Request $request)
    {
        // Start dengan query produk dari seller yang approved
        $query = Produk::with(['user', 'category', 'reviews'])
            ->whereHas('user', function ($q) {
                $q->where('status', 'approved');
            });

        // Filter berdasarkan search keyword (nama produk, deskripsi, atau nama toko)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama_produk', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($q2) use ($search) {
                        $q2->where('nama_toko', 'like', "%{$search}%");
                    });
            });
        }

        // Filter berdasarkan kategori produk
        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        // Filter berdasarkan harga
        if ($request->filled('harga_min')) {
            $query->where('harga', '>=', $request->input('harga_min'));
        }
        if ($request->filled('harga_max')) {
            $query->where('harga', '<=', $request->input('harga_max'));
        }

        // Filter berdasarkan kondisi produk
        if ($request->filled('kondisi')) {
            $query->where('kondisi', $request->input('kondisi'));
        }

        // Filter berdasarkan provinsi toko (lokasi penjual)
        if ($request->filled('provinsi')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('provinsi', $request->input('provinsi'));
            });
        }

        // Filter berdasarkan kabupaten/kota toko
        if ($request->filled('kabupaten_kota')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('kabupaten_kota', $request->input('kabupaten_kota'));
            });
        }

        // Filter berdasarkan nama toko (store name)
        if ($request->filled('nama_toko')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('nama_toko', 'like', '%' . $request->input('nama_toko') . '%');
            });
        }

        // Sorting berdasarkan rating
        if ($request->filled('sort') && $request->input('sort') === 'rating') {
            // Sort akan dilakukan di PHP setelah fetch
        }

        $products = $query->latest()->get();

        // Sort berdasarkan rating jika diinginkan
        if ($request->filled('sort') && $request->input('sort') === 'rating') {
            $products = $products->sortByDesc(function ($product) {
                return $product->reviews->count() > 0 ? $product->reviews->avg('rating') : 0;
            });
        }

        // Ambil data untuk filter options
        $categories = Category::all();

        // Ambil list provinsi dari config locations.php
        $allLocations = config('locations');
        $provinces = collect(array_keys($allLocations))->sort()->values();

        // Ambil daftar kabupaten/kota berdasarkan provinsi yang dipilih
        $selectedProvince = $request->filled('provinsi') ? $request->input('provinsi') : null;

        if ($selectedProvince && isset($allLocations[$selectedProvince])) {
            $cities = collect($allLocations[$selectedProvince])->sort()->values();
        } else {
            // Jika tidak ada provinsi terpilih, ambil semua kota dari config
            $cities = collect();
            foreach ($allLocations as $province => $citiesList) {
                foreach ($citiesList as $city) {
                    $cities->push($city);
                }
            }
            $cities = $cities->unique()->sort()->values();
        }

        return view('pages.filter', compact('products', 'categories', 'provinces', 'cities'));
    }
}
