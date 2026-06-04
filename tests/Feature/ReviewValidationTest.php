<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Seeders\ProductSeeder;
use App\Models\Produk;
use App\Models\Review;
use Illuminate\Support\Facades\Mail;

class ReviewValidationTest extends TestCase
{
    use RefreshDatabase;

    private $product;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Seed database dengan data dummy awal menggunakan ProductSeeder
        $this->seed(ProductSeeder::class);

        // Ambil salah satu produk hasil seeder
        $this->product = Produk::firstOrFail();

        // Gunakan Mail fake agar tidak mengirimkan email asli saat pengetesan
        Mail::fake();
    }

    /**
     * Skenario 1: Jika nama kosong, sistem harus menolak input dan menghasilkan error validasi.
     */
    public function test_name_is_required(): void
    {
        $response = $this->post(route('produk.review.store', $this->product->id), [
            'nama_pengunjung' => '', // Kosong
            'email' => 'ega@example.com',
            'nomor_hp' => '081234567890',
            'rating' => 5,
            'komentar' => 'Produknya bagus dan sesuai deskripsi',
            'provinsi' => 'Jawa Tengah',
        ]);

        $response->assertSessionHasErrors(['nama_pengunjung']);
        $this->assertEquals(0, Review::count());
    }

    /**
     * Skenario 2: Jika nomor HP kosong, sistem harus menolak input dan menghasilkan error validasi.
     */
    public function test_phone_number_is_required(): void
    {
        $response = $this->post(route('produk.review.store', $this->product->id), [
            'nama_pengunjung' => 'Ega Aryabima',
            'email' => 'ega@example.com',
            'nomor_hp' => '', // Kosong
            'rating' => 5,
            'komentar' => 'Produknya bagus dan sesuai deskripsi',
            'provinsi' => 'Jawa Tengah',
        ]);

        $response->assertSessionHasErrors(['nomor_hp']);
        $this->assertEquals(0, Review::count());
    }

    /**
     * Skenario 3: Jika email kosong, sistem harus menolak input dan menghasilkan error validasi.
     */
    public function test_email_is_required(): void
    {
        $response = $this->post(route('produk.review.store', $this->product->id), [
            'nama_pengunjung' => 'Ega Aryabima',
            'email' => '', // Kosong
            'nomor_hp' => '081234567890',
            'rating' => 5,
            'komentar' => 'Produknya bagus dan sesuai deskripsi',
            'provinsi' => 'Jawa Tengah',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertEquals(0, Review::count());
    }

    /**
     * Skenario 4: Jika format email tidak valid, sistem harus menolak input dan menghasilkan error validasi.
     */
    public function test_email_format_must_be_valid(): void
    {
        $response = $this->post(route('produk.review.store', $this->product->id), [
            'nama_pengunjung' => 'Ega Aryabima',
            'email' => 'egaemail.com', // Format tidak valid
            'nomor_hp' => '081234567890',
            'rating' => 5,
            'komentar' => 'Produknya bagus dan sesuai deskripsi',
            'provinsi' => 'Jawa Tengah',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertEquals(0, Review::count());
    }

    /**
     * Skenario Tambahan: Jika rating kosong, sistem harus menolak input dan menghasilkan error validasi.
     */
    public function test_rating_is_required(): void
    {
        $response = $this->post(route('produk.review.store', $this->product->id), [
            'nama_pengunjung' => 'Ega Aryabima',
            'email' => 'ega@example.com',
            'nomor_hp' => '081234567890',
            'rating' => '', // Kosong
            'komentar' => 'Produknya bagus dan sesuai deskripsi',
            'provinsi' => 'Jawa Tengah',
        ]);

        $response->assertSessionHasErrors(['rating']);
        $this->assertEquals(0, Review::count());
    }

    /**
     * Skenario Tambahan: Jika komentar kosong, sistem harus menolak input dan menghasilkan error validasi.
     */
    public function test_comment_is_required(): void
    {
        $response = $this->post(route('produk.review.store', $this->product->id), [
            'nama_pengunjung' => 'Ega Aryabima',
            'email' => 'ega@example.com',
            'nomor_hp' => '081234567890',
            'rating' => 5,
            'komentar' => '', // Kosong
            'provinsi' => 'Jawa Tengah',
        ]);

        $response->assertSessionHasErrors(['komentar']);
        $this->assertEquals(0, Review::count());
    }

    /**
     * Skenario Tambahan: Jika provinsi kosong, sistem harus menolak input dan menghasilkan error validasi.
     */
    public function test_provinsi_is_required(): void
    {
        $response = $this->post(route('produk.review.store', $this->product->id), [
            'nama_pengunjung' => 'Ega Aryabima',
            'email' => 'ega@example.com',
            'nomor_hp' => '081234567890',
            'rating' => 5,
            'komentar' => 'oke aja deh',
            'provinsi' => '', //kosong
        ]);

        $response->assertSessionHasErrors(['provinsi']);
        $this->assertEquals(0, Review::count());
    }


    /**
     * Skenario 5 & 6: Jika seluruh data wajib terisi dengan benar, sistem harus menerima input komentar/rating.
     * Serta data tersimpan di database dan mengarahkan kembali dengan sukses.
     */
    public function test_valid_data_is_accepted_and_stored(): void
    {
        $response = $this->post(route('produk.review.store', $this->product->id), [
            'nama_pengunjung' => 'Ega Aryabima',
            'email' => 'ega@example.com',
            'nomor_hp' => '081234567890',
            'rating' => 5,
            'komentar' => 'Produknya bagus dan sesuai deskripsi',
            'provinsi' => 'Jawa Tengah',
        ]);

        // Harus redirect kembali ke detail produk
        $response->assertRedirect(route('produk.detail', $this->product->id));
        $response->assertSessionHas('success');

        // Pastikan tersimpan di database
        $this->assertEquals(1, Review::count());
        $this->assertDatabaseHas('reviews', [
            'produk_id' => $this->product->id,
            'nama_pengunjung' => 'Ega Aryabima',
            'email' => 'ega@example.com',
            'nomor_hp' => '081234567890',
            'rating' => 5,
            'komentar' => 'Produknya bagus dan sesuai deskripsi',
            'provinsi' => 'Jawa Tengah',
        ]);
    }
}
