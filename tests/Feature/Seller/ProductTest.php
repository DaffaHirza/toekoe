<?php

namespace Tests\Feature\Seller;

use App\Models\Category;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Helper: buat seller approved.
     */
    private function createApprovedSeller(array $overrides = []): User
    {
        return User::factory()->create(array_merge([
            'role' => 'seller',
            'status' => 'approved',
        ], $overrides));
    }

    // ==========================================
    // Test Authorization
    // ==========================================

    /**
     * Test guest tidak bisa akses halaman seller.
     */
    public function test_guest_cannot_access_seller_product_page(): void
    {
        $response = $this->get('/seller/produk');

        $response->assertRedirect('/login');
    }

    /**
     * Test admin tidak bisa akses halaman seller.
     */
    public function test_admin_cannot_access_seller_product_page(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'status' => 'approved',
        ]);

        $response = $this->actingAs($admin)->get('/seller/produk');

        // Middleware role seharusnya mencegah akses
        $response->assertStatus(403);
    }

    // ==========================================
    // Test View Products
    // ==========================================

    /**
     * Test seller bisa melihat halaman produk.
     */
    public function test_seller_can_view_product_page(): void
    {
        $seller = $this->createApprovedSeller();

        $response = $this->actingAs($seller)->get('/seller/produk');

        $response->assertStatus(200);
        $response->assertViewIs('seller.pages.view');
    }

    /**
     * Test seller hanya melihat produk miliknya sendiri.
     */
    public function test_seller_only_sees_own_products(): void
    {
        $seller1 = $this->createApprovedSeller();
        $seller2 = $this->createApprovedSeller();
        $category = Category::factory()->create();

        Produk::create([
            'nama_produk' => 'Produk Seller 1',
            'deskripsi' => 'Deskripsi',
            'harga' => 100000,
            'stok' => 10,
            'kondisi' => 'baru',
            'image' => 'products/test.jpg',
            'user_id' => $seller1->id,
            'category_id' => $category->id,
        ]);

        Produk::create([
            'nama_produk' => 'Produk Seller 2',
            'deskripsi' => 'Deskripsi',
            'harga' => 200000,
            'stok' => 5,
            'kondisi' => 'bekas',
            'image' => 'products/test2.jpg',
            'user_id' => $seller2->id,
            'category_id' => $category->id,
        ]);

        $response = $this->actingAs($seller1)->get('/seller/produk');

        $response->assertStatus(200);
        $response->assertViewHas('products', function ($products) {
            return $products->count() === 1 && $products->first()->nama_produk === 'Produk Seller 1';
        });
    }

    // ==========================================
    // Test Create Product
    // ==========================================

    /**
     * Test seller bisa melihat halaman buat produk.
     */
    public function test_seller_can_view_create_product_page(): void
    {
        $seller = $this->createApprovedSeller();

        $response = $this->actingAs($seller)->get('/seller/produk/create');

        $response->assertStatus(200);
        $response->assertViewIs('seller.pages.create');
        $response->assertViewHas('categories');
    }

    /**
     * Test seller bisa membuat produk baru.
     */
    public function test_seller_can_store_product(): void
    {
        Storage::fake('public');
        $seller = $this->createApprovedSeller();
        $category = Category::factory()->create();

        $response = $this->actingAs($seller)->post('/seller/produk', [
            'nama_produk' => 'Produk Baru',
            'deskripsi' => 'Deskripsi produk baru',
            'harga' => 150000,
            'stok' => 20,
            'kondisi' => 'baru',
            'category_id' => $category->id,
            'image' => UploadedFile::fake()->image('product.jpg'),
        ]);

        $response->assertRedirect(route('seller.pages.view'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('product', [
            'nama_produk' => 'Produk Baru',
            'harga' => 150000,
            'user_id' => $seller->id,
        ]);
    }

    /**
     * Test buat produk tanpa gambar tetap berhasil (image nullable).
     */
    public function test_seller_can_store_product_without_image(): void
    {
        $seller = $this->createApprovedSeller();
        $category = Category::factory()->create();

        $response = $this->actingAs($seller)->post('/seller/produk', [
            'nama_produk' => 'Produk Tanpa Gambar',
            'deskripsi' => 'Tidak ada gambar',
            'harga' => 75000,
            'stok' => 10,
            'kondisi' => 'bekas',
            'category_id' => $category->id,
        ]);

        $response->assertRedirect(route('seller.pages.view'));

        $this->assertDatabaseHas('product', [
            'nama_produk' => 'Produk Tanpa Gambar',
            'image' => null,
        ]);
    }

    // ==========================================
    // Test Validation
    // ==========================================

    /**
     * Test validasi gagal tanpa field required.
     */
    public function test_store_product_fails_without_required_fields(): void
    {
        $seller = $this->createApprovedSeller();

        $response = $this->actingAs($seller)->post('/seller/produk', []);

        $response->assertSessionHasErrors([
            'nama_produk',
            'deskripsi',
            'harga',
            'stok',
            'kondisi',
            'category_id',
        ]);
    }

    /**
     * Test validasi gagal dengan harga negatif.
     */
    public function test_store_product_fails_with_negative_price(): void
    {
        $seller = $this->createApprovedSeller();
        $category = Category::factory()->create();

        $response = $this->actingAs($seller)->post('/seller/produk', [
            'nama_produk' => 'Produk Test',
            'deskripsi' => 'Deskripsi',
            'harga' => -10000,
            'stok' => 10,
            'kondisi' => 'baru',
            'category_id' => $category->id,
        ]);

        $response->assertSessionHasErrors('harga');
    }

    /**
     * Test validasi gagal dengan kondisi invalid.
     */
    public function test_store_product_fails_with_invalid_kondisi(): void
    {
        $seller = $this->createApprovedSeller();
        $category = Category::factory()->create();

        $response = $this->actingAs($seller)->post('/seller/produk', [
            'nama_produk' => 'Produk Test',
            'deskripsi' => 'Deskripsi',
            'harga' => 100000,
            'stok' => 10,
            'kondisi' => 'rusak',  // invalid value
            'category_id' => $category->id,
        ]);

        $response->assertSessionHasErrors('kondisi');
    }

    /**
     * Test validasi gagal dengan category_id yang tidak ada.
     */
    public function test_store_product_fails_with_nonexistent_category(): void
    {
        $seller = $this->createApprovedSeller();

        $response = $this->actingAs($seller)->post('/seller/produk', [
            'nama_produk' => 'Produk Test',
            'deskripsi' => 'Deskripsi',
            'harga' => 100000,
            'stok' => 10,
            'kondisi' => 'baru',
            'category_id' => 99999,
        ]);

        $response->assertSessionHasErrors('category_id');
    }
}
