<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Seeders\ProductSeeder;
use App\Models\Category;

class ProductSearchTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Seed database dengan data dummy awal menggunakan ProductSeeder yang telah dibuat
        $this->seed(ProductSeeder::class);
    }

    /**
     * Skenario 1 & 2: Ketika keyword “sepatu” digunakan, hasil harus memuat “Sepatu Sneakers”.
     * Dan tidak boleh memuat “Kaos Polos”, “Mouse Wireless”, dan “Tas Kuliah”.
     */
    public function test_filter_by_search_keyword_sepatu(): void
    {
        $response = $this->get(route('produk.filter', ['search' => 'sepatu']));

        $response->assertStatus(200);
        
        // Ambil data produk yang di-pass ke view
        $products = $response->viewData('products');

        // Pastikan "Sepatu Sneakers" ada
        $this->assertTrue($products->contains('nama_produk', 'Sepatu Sneakers'), 'Hasil pencarian "sepatu" harus memuat "Sepatu Sneakers"');

        // Pastikan produk lainnya tidak ada
        $this->assertFalse($products->contains('nama_produk', 'Kaos Polos'), 'Hasil pencarian "sepatu" tidak boleh memuat "Kaos Polos"');
        $this->assertFalse($products->contains('nama_produk', 'Mouse Wireless'), 'Hasil pencarian "sepatu" tidak boleh memuat "Mouse Wireless"');
        $this->assertFalse($products->contains('nama_produk', 'Tas Kuliah'), 'Hasil pencarian "sepatu" tidak boleh memuat "Tas Kuliah"');
    }

    /**
     * Skenario 3 & 4: Ketika filter kategori “Fashion” digunakan, hasil harus memuat produk dengan kategori Fashion.
     * Dan tidak boleh memuat produk kategori Elektronik.
     */
    public function test_filter_by_category_fashion(): void
    {
        // Ambil ID kategori Fashion
        $fashionCategory = Category::where('nama', 'Fashion')->firstOrFail();

        $response = $this->get(route('produk.filter', ['category' => $fashionCategory->id]));

        $response->assertStatus(200);

        $products = $response->viewData('products');

        // Produk Fashion (Sepatu Sneakers, Kaos Polos, Tas Kuliah) harus ada
        $this->assertTrue($products->contains('nama_produk', 'Sepatu Sneakers'), 'Katalog kategori Fashion harus memuat "Sepatu Sneakers"');
        $this->assertTrue($products->contains('nama_produk', 'Kaos Polos'), 'Katalog kategori Fashion harus memuat "Kaos Polos"');
        $this->assertTrue($products->contains('nama_produk', 'Tas Kuliah'), 'Katalog kategori Fashion harus memuat "Tas Kuliah"');

        // Produk Elektronik (Mouse Wireless) tidak boleh ada
        $this->assertFalse($products->contains('nama_produk', 'Mouse Wireless'), 'Katalog kategori Fashion tidak boleh memuat "Mouse Wireless"');
    }

    /**
     * Skenario 5 & 6: Ketika filter lokasi “Semarang” digunakan, hasil harus memuat produk dari Semarang.
     * Dan tidak boleh memuat produk dari Jakarta atau Bandung.
     */
    public function test_filter_by_location_semarang(): void
    {
        // Filter kabupaten_kota = Semarang
        $response = $this->get(route('produk.filter', ['kabupaten_kota' => 'Semarang']));

        $response->assertStatus(200);

        $products = $response->viewData('products');

        // Produk dari seller Semarang (Sepatu Sneakers, Mouse Wireless) harus ada
        $this->assertTrue($products->contains('nama_produk', 'Sepatu Sneakers'), 'Katalog lokasi Semarang harus memuat "Sepatu Sneakers"');
        $this->assertTrue($products->contains('nama_produk', 'Mouse Wireless'), 'Katalog lokasi Semarang harus memuat "Mouse Wireless"');

        // Produk dari Jakarta & Bandung (Kaos Polos, Tas Kuliah) tidak boleh ada
        $this->assertFalse($products->contains('nama_produk', 'Kaos Polos'), 'Katalog lokasi Semarang tidak boleh memuat "Kaos Polos" dari Jakarta');
        $this->assertFalse($products->contains('nama_produk', 'Tas Kuliah'), 'Katalog lokasi Semarang tidak boleh memuat "Tas Kuliah" dari Bandung');
    }
}
