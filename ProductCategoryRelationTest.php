<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductCategoryRelationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Skenario 1: Produk yang memiliki category_id harus mengembalikan instance Category
     * melalui relasi belongsTo.
     */
    public function test_product_belongs_to_category(): void
    {
        $seller = User::factory()->create([
            'role' => 'seller',
            'status' => 'approved',
        ]);

        $category = Category::create(['nama' => 'Elektronik']);

        $product = Produk::create([
            'nama_produk' => 'Mouse Wireless',
            'deskripsi' => 'Mouse wireless responsif dan hemat baterai.',
            'harga' => 120000.00,
            'stok' => 20,
            'kondisi' => 'baru',
            'user_id' => $seller->id,
            'category_id' => $category->id,
        ]);

        // Relasi category() harus mengembalikan instance Category
        $this->assertInstanceOf(Category::class, $product->category);
    }

    /**
     * Skenario 2: ID kategori yang dikembalikan oleh relasi harus sesuai
     * dengan category_id yang diberikan saat produk dibuat.
     */
    public function test_product_category_id_matches(): void
    {
        $seller = User::factory()->create([
            'role' => 'seller',
            'status' => 'approved',
        ]);

        $category = Category::create(['nama' => 'Fashion']);

        $product = Produk::create([
            'nama_produk' => 'Sepatu Sneakers',
            'deskripsi' => 'Sepatu sneakers keren.',
            'harga' => 350000.00,
            'stok' => 15,
            'kondisi' => 'baru',
            'user_id' => $seller->id,
            'category_id' => $category->id,
        ]);

        // ID kategori dari relasi harus sama dengan ID kategori asli
        $this->assertEquals($category->id, $product->category->id);
    }

    /**
     * Skenario 3: Nama kategori yang dikembalikan oleh relasi harus sesuai
     * dengan nama kategori yang diberikan.
     */
    public function test_product_category_name_matches(): void
    {
        $seller = User::factory()->create([
            'role' => 'seller',
            'status' => 'approved',
        ]);

        $category = Category::create(['nama' => 'Aksesoris']);

        $product = Produk::create([
            'nama_produk' => 'Tas Kuliah',
            'deskripsi' => 'Tas punggung kuliah modis.',
            'harga' => 180000.00,
            'stok' => 10,
            'kondisi' => 'baru',
            'user_id' => $seller->id,
            'category_id' => $category->id,
        ]);

        // Nama kategori dari relasi harus sesuai
        $this->assertEquals('Aksesoris', $product->category->nama);
    }

    /**
     * Skenario 4: Produk tanpa category_id harus mengembalikan null
     * pada relasi category.
     */
    public function test_product_without_category_returns_null(): void
    {
        $seller = User::factory()->create([
            'role' => 'seller',
            'status' => 'approved',
        ]);

        $product = Produk::create([
            'nama_produk' => 'Barang Tanpa Kategori',
            'deskripsi' => 'Produk ini tidak memiliki kategori.',
            'harga' => 50000.00,
            'stok' => 5,
            'kondisi' => 'bekas',
            'user_id' => $seller->id,
            'category_id' => null,
        ]);

        // Relasi category harus null jika category_id tidak diisi
        $this->assertNull($product->category);
    }
}
