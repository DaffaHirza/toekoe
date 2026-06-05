<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Produk;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SellerReportPdfTest extends TestCase
{
    use RefreshDatabase;

    private $seller;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seller = User::factory()->create([
            'role' => 'seller',
            'status' => 'approved',
        ]);

        // Buat kategori dan produk milik seller
        $category = Category::create(['nama' => 'Fashion']);

        Produk::create([
            'nama_produk' => 'Sepatu Sneakers',
            'deskripsi' => 'Sepatu sneakers keren.',
            'harga' => 350000.00,
            'stok' => 15,
            'kondisi' => 'baru',
            'user_id' => $this->seller->id,
            'category_id' => $category->id,
        ]);

        Produk::create([
            'nama_produk' => 'Kaos Polos',
            'deskripsi' => 'Kaos polos katun.',
            'harga' => 50000.00,
            'stok' => 50,
            'kondisi' => 'baru',
            'user_id' => $this->seller->id,
            'category_id' => $category->id,
        ]);
    }

    /**
     * Skenario 1: Laporan Stock By Stock harus memanggil Pdf::loadView
     * dengan view 'seller.reports.stock-by-stock' dan data yang benar.
     */
    public function test_stock_by_stock_report_calls_pdf_with_correct_view_and_data(): void
    {
        Pdf::shouldReceive('loadView')
            ->once()
            ->with('seller.reports.stock-by-stock', \Mockery::on(function ($data) {
                // Data harus memiliki key yang diperlukan
                return isset($data['title'])
                    && isset($data['tanggal_laporan'])
                    && isset($data['products'])
                    && isset($data['totalProducts'])
                    && isset($data['seller'])
                    // Jumlah produk harus sesuai (2 produk milik seller ini)
                    && $data['totalProducts'] === 2
                    // Title harus sesuai
                    && $data['title'] === 'Laporan Stock Produk (Urut: Stok Menurun)'
                    // Seller harus sesuai
                    && $data['seller']->id === $this->seller->id;
            }))
            ->andReturnSelf();

        Pdf::shouldReceive('download')
            ->once()
            ->andReturn(response('PDF content', 200, [
                'Content-Type' => 'application/pdf',
            ]));

        $response = $this->actingAs($this->seller)
            ->get(route('seller.reports.stockByStock'));

        $response->assertStatus(200);
    }

    /**
     * Skenario 2: Laporan Stock By Rating harus memanggil Pdf::loadView
     * dengan view 'seller.reports.stock-by-rating' dan data yang benar.
     */
    public function test_stock_by_rating_report_calls_pdf_with_correct_view_and_data(): void
    {
        Pdf::shouldReceive('loadView')
            ->once()
            ->with('seller.reports.stock-by-rating', \Mockery::on(function ($data) {
                return isset($data['title'])
                    && isset($data['products'])
                    && isset($data['totalProducts'])
                    && isset($data['seller'])
                    && $data['totalProducts'] === 2
                    && $data['title'] === 'Laporan Stock Produk (Urut: Rating Menurun)';
            }))
            ->andReturnSelf();

        Pdf::shouldReceive('download')
            ->once()
            ->andReturn(response('PDF content', 200, [
                'Content-Type' => 'application/pdf',
            ]));

        $response = $this->actingAs($this->seller)
            ->get(route('seller.reports.stockByRating'));

        $response->assertStatus(200);
    }

    /**
     * Skenario 3: Laporan Low Stock harus hanya memuat produk dengan stok < 2.
     * Karena kedua produk di setUp memiliki stok >= 2, totalProducts harus 0.
     */
    public function test_low_stock_report_only_includes_products_with_stock_below_two(): void
    {
        Pdf::shouldReceive('loadView')
            ->once()
            ->with('seller.reports.low-stock', \Mockery::on(function ($data) {
                // Tidak ada produk dengan stok < 2, jadi totalProducts harus 0
                return $data['totalProducts'] === 0
                    && $data['products']->isEmpty();
            }))
            ->andReturnSelf();

        Pdf::shouldReceive('download')
            ->once()
            ->andReturn(response('PDF content', 200, [
                'Content-Type' => 'application/pdf',
            ]));

        $response = $this->actingAs($this->seller)
            ->get(route('seller.reports.lowStock'));

        $response->assertStatus(200);
    }

    /**
     * Skenario 4: Laporan tidak boleh memuat produk milik seller lain.
     */
    public function test_report_only_contains_products_owned_by_authenticated_seller(): void
    {
        // Buat seller lain dengan produknya sendiri
        $otherSeller = User::factory()->create([
            'role' => 'seller',
            'status' => 'approved',
        ]);

        $category = Category::first();

        Produk::create([
            'nama_produk' => 'Produk Seller Lain',
            'deskripsi' => 'Ini milik seller lain.',
            'harga' => 99000.00,
            'stok' => 30,
            'kondisi' => 'baru',
            'user_id' => $otherSeller->id,
            'category_id' => $category->id,
        ]);

        Pdf::shouldReceive('loadView')
            ->once()
            ->with('seller.reports.stock-by-stock', \Mockery::on(function ($data) {
                // Harus tetap 2 produk (hanya milik $this->seller)
                // Produk milik seller lain tidak boleh masuk
                if ($data['totalProducts'] !== 2) {
                    return false;
                }

                foreach ($data['products'] as $product) {
                    if ($product->user_id !== $this->seller->id) {
                        return false;
                    }
                }

                return true;
            }))
            ->andReturnSelf();

        Pdf::shouldReceive('download')
            ->once()
            ->andReturn(response('PDF content', 200, [
                'Content-Type' => 'application/pdf',
            ]));

        $response = $this->actingAs($this->seller)
            ->get(route('seller.reports.stockByStock'));

        $response->assertStatus(200);
    }
}
