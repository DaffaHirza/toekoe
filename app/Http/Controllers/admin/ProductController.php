<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Produk::with(['user', 'category', 'reviews'])
            ->latest()
            ->paginate(10);

        return view('admin.pages.produk.view', compact('products'));
    }
}
