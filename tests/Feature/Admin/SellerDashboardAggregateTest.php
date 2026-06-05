<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\Produk;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

/**
 * DUPL-08-02: Unit Test - Agregasi Rata-rata Rating per Produk Seller Dashboard
 * File: app/Http/Controllers/seller/BerandaController.php
 * Method: index() - Baris 23-32
 * Query: Produk::leftJoin('reviews')->select(AVG, COUNT)
 */
class SellerDashboardAggregateTest extends TestCase
{
    use RefreshDatabase;

    protected User $seller;
    protected Category $category;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seller = User::factory()->create(['role' => 'seller', 'status' => 'approved']);
        $this->category = Category::create(['nama' => 'Elektronik']);
    }

    public function test_produk_tanpa_review_menampilkan_rating_nol(): void
    {
        // Skenario: Produk tanpa review → rata_rating = 0, total_rating = 0
        Produk::create([
            'nama_produk' => 'Laptop Dell',
            'deskripsi' => 'Laptop gaming',
            'harga' => 15000000,
            'stok' => 5,
            'kondisi' => 'baru',
            'user_id' => $this->seller->id,
            'category_id' => $this->category->id,
        ]);

        $result = Produk::where('user_id', $this->seller->id)
            ->leftJoin('reviews', 'product.id', '=', 'reviews.produk_id')
            ->select(
                'product.nama_produk as nama',
                DB::raw('COALESCE(AVG(reviews.rating), 0) as rata_rating'),
                DB::raw('COUNT(reviews.id) as total_rating')
            )
            ->groupBy('product.id', 'product.nama_produk')
            ->get();

        $this->assertCount(1, $result);
        $this->assertEquals(0, $result[0]->rata_rating);
        $this->assertEquals(0, $result[0]->total_rating);
    }

    public function test_produk_dengan_multiple_review_rata_rata_akurat(): void
    {
        // Skenario: 1 produk, 3 review (rating: 5, 4, 3) → rata_rating = 4.0
        $produk = Produk::create([
            'nama_produk' => 'Keyboard Mechanical',
            'deskripsi' => 'Keyboard gaming',
            'harga' => 1500000,
            'stok' => 10,
            'kondisi' => 'baru',
            'user_id' => $this->seller->id,
            'category_id' => $this->category->id,
        ]);

        Review::create([
            'produk_id' => $produk->id,
            'nama_pengunjung' => 'Andi',
            'email' => 'andi@example.com',
            'nomor_hp' => '082234567890',
            'rating' => 5,
            'komentar' => 'Sangat memuaskan',
            'provinsi' => 'Jawa Tengah',
        ]);

        Review::create([
            'produk_id' => $produk->id,
            'nama_pengunjung' => 'Budi',
            'email' => 'budi@example.com',
            'nomor_hp' => '083234567890',
            'rating' => 4,
            'komentar' => 'Bagus',
            'provinsi' => 'Jawa Timur',
        ]);

        Review::create([
            'produk_id' => $produk->id,
            'nama_pengunjung' => 'Citra',
            'email' => 'citra@example.com',
            'nomor_hp' => '084234567890',
            'rating' => 3,
            'komentar' => 'Cukup',
            'provinsi' => 'DKI Jakarta',
        ]);

        $result = Produk::where('user_id', $this->seller->id)
            ->leftJoin('reviews', 'product.id', '=', 'reviews.produk_id')
            ->select(
                'product.nama_produk as nama',
                DB::raw('COALESCE(AVG(reviews.rating), 0) as rata_rating'),
                DB::raw('COUNT(reviews.id) as total_rating')
            )
            ->groupBy('product.id', 'product.nama_produk')
            ->get();

        $this->assertCount(1, $result);
        $this->assertEqualsWithDelta(4.0, $result[0]->rata_rating, 0.01);
        $this->assertEquals(3, $result[0]->total_rating);
    }

    public function test_multiple_produk_diurutkan_by_rating_descending(): void
    {
        // Skenario: 3 produk dengan rating berbeda, sorted rating tertinggi pertama
        $produkA = Produk::create([
            'nama_produk' => 'Produk A (Rating 5)',
            'deskripsi' => 'Produk A',
            'harga' => 100000,
            'stok' => 10,
            'kondisi' => 'baru',
            'user_id' => $this->seller->id,
            'category_id' => $this->category->id,
        ]);

        $produkB = Produk::create([
            'nama_produk' => 'Produk B (Rating 4)',
            'deskripsi' => 'Produk B',
            'harga' => 200000,
            'stok' => 20,
            'kondisi' => 'baru',
            'user_id' => $this->seller->id,
            'category_id' => $this->category->id,
        ]);

        $produkC = Produk::create([
            'nama_produk' => 'Produk C (No Rating)',
            'deskripsi' => 'Produk C',
            'harga' => 300000,
            'stok' => 30,
            'kondisi' => 'baru',
            'user_id' => $this->seller->id,
            'category_id' => $this->category->id,
        ]);

        // Produk A: 2 review, avg = 5.0
        Review::create(['produk_id' => $produkA->id, 'nama_pengunjung' => 'User1', 'email' => 'u1@ex.com', 'nomor_hp' => '081', 'rating' => 5, 'komentar' => 'A', 'provinsi' => 'JT']);
        Review::create(['produk_id' => $produkA->id, 'nama_pengunjung' => 'User2', 'email' => 'u2@ex.com', 'nomor_hp' => '082', 'rating' => 5, 'komentar' => 'A', 'provinsi' => 'JT']);

        // Produk B: 3 review, avg = 4.0
        Review::create(['produk_id' => $produkB->id, 'nama_pengunjung' => 'User3', 'email' => 'u3@ex.com', 'nomor_hp' => '083', 'rating' => 5, 'komentar' => 'B', 'provinsi' => 'JT']);
        Review::create(['produk_id' => $produkB->id, 'nama_pengunjung' => 'User4', 'email' => 'u4@ex.com', 'nomor_hp' => '084', 'rating' => 4, 'komentar' => 'B', 'provinsi' => 'JT']);
        Review::create(['produk_id' => $produkB->id, 'nama_pengunjung' => 'User5', 'email' => 'u5@ex.com', 'nomor_hp' => '085', 'rating' => 3, 'komentar' => 'B', 'provinsi' => 'JT']);

        // Produk C: no review

        $result = Produk::where('user_id', $this->seller->id)
            ->leftJoin('reviews', 'product.id', '=', 'reviews.produk_id')
            ->select(
                'product.nama_produk as nama',
                DB::raw('COALESCE(AVG(reviews.rating), 0) as rata_rating'),
                DB::raw('COUNT(reviews.id) as total_rating')
            )
            ->groupBy('product.id', 'product.nama_produk')
            ->orderBy('rata_rating', 'desc')
            ->get();

        // Urutan: A (5.0), B (4.0), C (0)
        $this->assertCount(3, $result);
        $this->assertEqualsWithDelta(5.0, $result[0]->rata_rating, 0.01);
        $this->assertEqualsWithDelta(4.0, $result[1]->rata_rating, 0.01);
        $this->assertEquals(0, $result[2]->rata_rating);
    }

    public function test_filter_by_user_id_hanya_produk_seller_login(): void
    {
        // Skenario: 2 seller berbeda, query hanya return produk seller login
        $sellerLain = User::factory()->create(['role' => 'seller', 'status' => 'approved']);

        // Produk dari seller login
        $produkSeller1 = Produk::create([
            'nama_produk' => 'Produk Seller 1',
            'deskripsi' => 'Dari seller 1',
            'harga' => 100000,
            'stok' => 10,
            'kondisi' => 'baru',
            'user_id' => $this->seller->id,
            'category_id' => $this->category->id,
        ]);

        // Produk dari seller lain
        $produkSeller2 = Produk::create([
            'nama_produk' => 'Produk Seller 2',
            'deskripsi' => 'Dari seller 2',
            'harga' => 200000,
            'stok' => 20,
            'kondisi' => 'baru',
            'user_id' => $sellerLain->id,
            'category_id' => $this->category->id,
        ]);

        Review::create(['produk_id' => $produkSeller1->id, 'nama_pengunjung' => 'User1', 'email' => 'u1@ex.com', 'nomor_hp' => '081', 'rating' => 5, 'komentar' => 'A', 'provinsi' => 'JT']);
        Review::create(['produk_id' => $produkSeller2->id, 'nama_pengunjung' => 'User2', 'email' => 'u2@ex.com', 'nomor_hp' => '082', 'rating' => 4, 'komentar' => 'B', 'provinsi' => 'JT']);

        // Query hanya untuk seller login
        $result = Produk::where('user_id', $this->seller->id)
            ->leftJoin('reviews', 'product.id', '=', 'reviews.produk_id')
            ->select(
                'product.nama_produk as nama',
                DB::raw('COALESCE(AVG(reviews.rating), 0) as rata_rating'),
                DB::raw('COUNT(reviews.id) as total_rating')
            )
            ->groupBy('product.id', 'product.nama_produk')
            ->get();

        // Harus hanya 1 produk dari seller login
        $this->assertCount(1, $result);
        $this->assertEquals('Produk Seller 1', $result[0]->nama);
        $this->assertEquals(5.0, $result[0]->rata_rating);
    }

    public function test_coalesce_handle_null_rating_menjadi_nol(): void
    {
        // Skenario: Produk dengan dan tanpa review, COALESCE handle NULL → 0
        $produk1 = Produk::create([
            'nama_produk' => 'Produk Ada Review',
            'deskripsi' => 'Ada review',
            'harga' => 100000,
            'stok' => 10,
            'kondisi' => 'baru',
            'user_id' => $this->seller->id,
            'category_id' => $this->category->id,
        ]);

        $produk2 = Produk::create([
            'nama_produk' => 'Produk Tanpa Review',
            'deskripsi' => 'Tidak ada review',
            'harga' => 200000,
            'stok' => 20,
            'kondisi' => 'baru',
            'user_id' => $this->seller->id,
            'category_id' => $this->category->id,
        ]);

        Review::create([
            'produk_id' => $produk1->id,
            'nama_pengunjung' => 'User1',
            'email' => 'u1@ex.com',
            'nomor_hp' => '081',
            'rating' => 3,
            'komentar' => 'Oke',
            'provinsi' => 'JT',
        ]);

        $result = Produk::where('user_id', $this->seller->id)
            ->leftJoin('reviews', 'product.id', '=', 'reviews.produk_id')
            ->select(
                'product.nama_produk as nama',
                DB::raw('COALESCE(AVG(reviews.rating), 0) as rata_rating'),
                DB::raw('COUNT(reviews.id) as total_rating')
            )
            ->groupBy('product.id', 'product.nama_produk')
            ->get();

        $this->assertCount(2, $result);

        // Produk dengan review
        $prod1Result = $result->where('nama', 'Produk Ada Review')->first();
        $this->assertEquals(3, $prod1Result->rata_rating);
        $this->assertNotNull($prod1Result->rata_rating);

        // Produk tanpa review - COALESCE → 0, tidak NULL
        $prod2Result = $result->where('nama', 'Produk Tanpa Review')->first();
        $this->assertEquals(0, $prod2Result->rata_rating);
        $this->assertNotNull($prod2Result->rata_rating);
    }
}
