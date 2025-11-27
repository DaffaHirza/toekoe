<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua produk dari seller yang statusnya approved
        $products = Produk::with(['user', 'category'])
            ->whereHas('user', function($query) {
                $query->where('status', 'approved');
            })
            ->latest()
            ->get();

        return view('pages.beranda', compact('products'));
    }

    public function show($id)
    {
        $product = Produk::with(['user', 'category', 'reviews'])
            ->whereHas('user', function($query) {
                $query->where('status', 'approved');
            })
            ->findOrFail($id);

        return view('pages.detail-produk', compact('product'));
    }

    public function storeReview(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_pengunjung' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:1000',
        ]);

        $validated['produk_id'] = $id;

        Review::create($validated);

        return redirect()->route('produk.detail', $id)->with('success', 'Review berhasil ditambahkan!');
    }
}
