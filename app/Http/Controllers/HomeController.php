<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Category;
use App\Models\Review;
use App\Mail\ReviewThankYou;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Check if it's an AJAX request
        if ($request->ajax()) {
            return $this->getProductsAjax($request);
        }

        // Ambil parameter kategori dari request
        $categoryFilter = $request->get('category');

        // Query produk dari seller yang statusnya approved
        $products = Produk::with(['user', 'category', 'reviews'])
            ->whereHas('user', function ($query) {
                $query->where('status', 'approved');
            })
            ->when($categoryFilter && $categoryFilter !== 'all', function ($query) use ($categoryFilter) {
                $query->where('category_id', $categoryFilter);
            })
            ->latest()
            ->get();

        $categories = Category::all();

        return view('pages.beranda', compact('products', 'categories', 'categoryFilter'));
    }

    private function getProductsAjax(Request $request)
    {
        $categoryFilter = $request->get('category');

        $products = Produk::with(['user', 'category', 'reviews'])
            ->whereHas('user', function ($query) {
                $query->where('status', 'approved');
            })
            ->when($categoryFilter && $categoryFilter !== 'all', function ($query) use ($categoryFilter) {
                $query->where('category_id', $categoryFilter);
            })
            ->latest()
            ->get();

        $categories = Category::all();
        $selectedCategory = $categoryFilter ? $categories->firstWhere('id', $categoryFilter) : null;

        return response()->json([
            'products' => $products,
            'count' => $products->count(),
            'category_name' => $selectedCategory ? $selectedCategory->nama : 'Semua Produk',
            'category_id' => $categoryFilter
        ]);
    }

    public function show($id)
    {
        $product = Produk::with(['user', 'category', 'reviews'])
            ->whereHas('user', function ($query) {
                $query->where('status', 'approved');
            })
            ->findOrFail($id);

        $provinsi_list = array_keys(config('locations'));

        return view('pages.detail-produk', compact('product', 'provinsi_list'));
    }

    public function storeReview(Request $request, $id)
    {
        // Cek apakah email sudah pernah review produk ini
        $existingReview = Review::where('produk_id', $id)
            ->where('email', $request->email)
            ->first();

        if ($existingReview) {
            return redirect()->back()->withErrors(['email' => 'Email ini sudah pernah memberikan review untuk produk ini.']);
        }

        $validated = $request->validate([
            'nama_pengunjung' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nomor_hp' => 'required|string|max:20',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|max:1000',
            'provinsi' => 'required|string|in:' . implode(',', array_map(function ($v) {
                return addslashes($v);
            }, array_keys(config('locations')))),
        ]);

        $validated['produk_id'] = $id;

        $review = Review::create($validated);

        // Kirim email terima kasih ke pengunjung
        try {
            $product = Produk::find($id);
            Mail::to($validated['email'])->send(new ReviewThankYou($review, $product));
        } catch (\Exception $e) {
            // jangan ganggu UX jika email gagal; log bila perlu
            // 
        }

        return redirect()->route('produk.detail', $id)->with('success', 'Terima kasih sudah memberikan rating dan review!');
    }
}
