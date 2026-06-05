<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Produk;

/**
 * DUPL-07-01: Unit Test - Agregasi Jumlah Produk per Kategori Admin Dashboard
 * File: app/Http/Controllers/admin/BerandaController.php
 * Method: index() - Baris 23-24
 * Query: Category::withCount('produk')
 */
class AdminDashboardAggregateTest extends TestCase
{
    use RefreshDatabase;

    public function test_kategori_kosong_menampilkan_count_zero(): void
    {
        // Skenario: Kategori tanpa produk harus menampilkan count = 0
        Category::create(['nama' => 'Elektronik']);
        Category::create(['nama' => 'Fashion']);

        $result = Category::withCount('produk')
            ->get()
            ->pluck('produk_count', 'nama')
            ->toArray();

        $this->assertEquals(0, $result['Elektronik']);
        $this->assertEquals(0, $result['Fashion']);
    }

    public function test_kategori_dengan_multiple_produk_count_akurat(): void
    {
        // Skenario: Kategori dengan 5 produk harus menampilkan count = 5
        $kategori = Category::create(['nama' => 'Fashion']);
        
        for ($i = 1; $i <= 5; $i++) {
            Produk::create([
                'nama_produk' => "Produk {$i}",
                'deskripsi' => "Deskripsi {$i}",
                'harga' => 100000,
                'stok' => 10,
                'kondisi' => 'baru',
                'category_id' => $kategori->id,
            ]);
        }

        $result = Category::withCount('produk')
            ->where('nama', 'Fashion')
            ->first();

        $this->assertEquals(5, $result->produk_count);
    }

    public function test_multiple_kategori_aggregate_total_akurat(): void
    {
        // Skenario: 3 kategori dengan 2, 3, 4 produk masing-masing = total 9
        $kat1 = Category::create(['nama' => 'Elektronik']);
        $kat2 = Category::create(['nama' => 'Fashion']);
        $kat3 = Category::create(['nama' => 'Makanan']);

        // 2 produk di Elektronik
        for ($i = 1; $i <= 2; $i++) {
            Produk::create([
                'nama_produk' => "Elektronik {$i}",
                'deskripsi' => 'Desc',
                'harga' => 500000,
                'stok' => 10,
                'kondisi' => 'baru',
                'category_id' => $kat1->id,
            ]);
        }

        // 3 produk di Fashion
        for ($i = 1; $i <= 3; $i++) {
            Produk::create([
                'nama_produk' => "Fashion {$i}",
                'deskripsi' => 'Desc',
                'harga' => 200000,
                'stok' => 10,
                'kondisi' => 'baru',
                'category_id' => $kat2->id,
            ]);
        }

        // 4 produk di Makanan
        for ($i = 1; $i <= 4; $i++) {
            Produk::create([
                'nama_produk' => "Makanan {$i}",
                'deskripsi' => 'Desc',
                'harga' => 50000,
                'stok' => 100,
                'kondisi' => 'baru',
                'category_id' => $kat3->id,
            ]);
        }

        $result = Category::withCount('produk')->get();
        $counts = $result->pluck('produk_count', 'nama')->toArray();

        $this->assertEquals(2, $counts['Elektronik']);
        $this->assertEquals(3, $counts['Fashion']);
        $this->assertEquals(4, $counts['Makanan']);
        $this->assertEquals(9, array_sum($counts));
    }

    public function test_delete_produk_update_count_otomatis(): void
    {
        // Skenario: Delete produk harus update count (3 → 2)
        $kategori = Category::create(['nama' => 'Fashion']);
        
        $p1 = Produk::create([
            'nama_produk' => 'Produk 1',
            'deskripsi' => 'Desc',
            'harga' => 100000,
            'stok' => 10,
            'kondisi' => 'baru',
            'category_id' => $kategori->id,
        ]);
        
        Produk::create([
            'nama_produk' => 'Produk 2',
            'deskripsi' => 'Desc',
            'harga' => 100000,
            'stok' => 10,
            'kondisi' => 'baru',
            'category_id' => $kategori->id,
        ]);
        
        Produk::create([
            'nama_produk' => 'Produk 3',
            'deskripsi' => 'Desc',
            'harga' => 100000,
            'stok' => 10,
            'kondisi' => 'baru',
            'category_id' => $kategori->id,
        ]);

        // Verify awal = 3
        $this->assertEquals(3, Category::withCount('produk')->find($kategori->id)->produk_count);

        // Delete 1 produk
        $p1->delete();

        // Verify menjadi 2
        $this->assertEquals(2, Category::withCount('produk')->find($kategori->id)->produk_count);
    }

    public function test_left_join_include_kategori_kosong(): void
    {
        // Skenario: withCount menggunakan LEFT JOIN, kategori kosong tetap ditampilkan
        Category::create(['nama' => 'Elektronik']); // Kosong
        Category::create(['nama' => 'Fashion']); // Kosong
        Category::create(['nama' => 'Makanan']); // Punya produk
        
        $makanan = Category::where('nama', 'Makanan')->first();
        Produk::create([
            'nama_produk' => 'Nasi',
            'deskripsi' => 'Nasi putih',
            'harga' => 15000,
            'stok' => 100,
            'kondisi' => 'baru',
            'category_id' => $makanan->id,
        ]);

        $result = Category::withCount('produk')->get();
        $counts = $result->pluck('produk_count', 'nama')->toArray();

        // Semua 3 kategori harus ada (LEFT JOIN)
        $this->assertCount(3, $result);
        $this->assertEquals(0, $counts['Elektronik']);
        $this->assertEquals(0, $counts['Fashion']);
        $this->assertEquals(1, $counts['Makanan']);
    }
}
