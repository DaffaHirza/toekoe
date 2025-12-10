<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Produk::where('user_id', Auth::id())->get();
        return view('seller.pages.view', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('seller.pages.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kondisi' => 'required|in:baru,bekas',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Produk::create([
            'nama_produk' => $validated['nama_produk'],
            'deskripsi' => $validated['deskripsi'],
            'harga' => $validated['harga'],
            'stok' => $validated['stok'],
            'kondisi' => $validated['kondisi'],
            'image' => $imagePath,
            'user_id' => Auth::id(), // ID seller yang login
            'category_id' => $validated['category_id'],
        ]);

        return redirect()->route('seller.pages.view')
            ->with('success', 'Produk berhasil ditambahkan!');
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
        $product = Produk::where('user_id', Auth::id())->findOrFail($id);
        $categories = Category::all();
        return view('seller.pages.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Produk::where('user_id', Auth::id())->findOrFail($id);
        
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kondisi' => 'required|in:baru,bekas',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image && \Storage::disk('public')->exists($product->image)) {
                \Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('seller.pages.view')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Produk::where('user_id', Auth::id())->findOrFail($id);
        
        // Delete image if exists
        if ($product->image && \Storage::disk('public')->exists($product->image)) {
            \Storage::disk('public')->delete($product->image);
        }
        
        $product->delete();
        
        return redirect()->route('seller.pages.view')
            ->with('success', 'Produk berhasil dihapus!');
    }
}
