<?php

namespace Tests\Feature\Seller;

use App\Models\Category;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadProdukTest extends TestCase
{
    use RefreshDatabase;

    private User $seller;
    private Category $category;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seller = User::factory()->create([
            'role' => 'seller',
            'status' => 'approved',
        ]);

        $this->category = Category::factory()->create(['nama' => 'Elektronik']);
    }




    /**
     * Test upload produk berhasil dengan semua data lengkap.
     */
    public function test_datalengkap(): void
    {
        Storage::fake('public');

        $response = $this->actingAs($this->seller)->post('/seller/produk', [
            'nama_produk' => 'Laptop Gaming ASUS',
            'deskripsi' => 'Laptop gaming dengan spesifikasi tinggi, cocok untuk gaming dan desain.',
            'harga' => 15000000,
            'stok' => 5,
            'kondisi' => 'baru',
            'category_id' => 4,
            'image' => UploadedFile::fake()->image('laptop.jpg'),
        ]);

        $response->assertRedirect(route('seller.pages.view'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('product', [
            'nama_produk' => 'Laptop Gaming ASUS',
            'deskripsi' => 'Laptop gaming dengan spesifikasi tinggi, cocok untuk gaming dan desain.',
            'harga' => 15000000,
            'stok' => 5,
            'kondisi' => 'baru',
            'category_id' => $this->category->id,
            'user_id' => $this->seller->id,
        ]);
    }

    /**
     * Test upload produk gagal tanpa nama_produk.
     */
    public function tanpanama(): void
    {
        $response = $this->actingAs($this->seller)->post('/seller/produk', [
            'deskripsi' => 'Deskripsi produk',
            'harga' => 100000,
            'stok' => 10,
            'kondisi' => 'baru',
            'category_id' => $this->category->id,
        ]);

        $response->assertSessionHasErrors('nama_produk');
    }

    /**
     * Test upload produk gagal tanpa deskripsi.
     */
    public function tanpadeskripsi(): void
    {
        $response = $this->actingAs($this->seller)->post('/seller/produk', [
            'nama_produk' => 'Produk Test',
            'harga' => 100000,
            'stok' => 10,
            'kondisi' => 'baru',
            'category_id' => $this->category->id,
        ]);

        $response->assertSessionHasErrors('deskripsi');
    }

    /**
     * Test upload produk gagal tanpa harga.
     */
    public function tanpaharga(): void
    {
        $response = $this->actingAs($this->seller)->post('/seller/produk', [
            'nama_produk' => 'Produk Test',
            'deskripsi' => 'Deskripsi produk',
            'stok' => 10,
            'kondisi' => 'baru',
            'category_id' => $this->category->id,
        ]);

        $response->assertSessionHasErrors('harga');
    }

    /**
     * Test upload produk gagal tanpa stok.
     */
    public function tanpastok(): void
    {
        $response = $this->actingAs($this->seller)->post('/seller/produk', [
            'nama_produk' => 'Produk Test',
            'deskripsi' => 'Deskripsi produk',
            'harga' => 100000,
            'kondisi' => 'baru',
            'category_id' => $this->category->id,
        ]);

        $response->assertSessionHasErrors('stok');
    }

    /**
     * Test upload produk gagal tanpa kategori.
     */
    public function tanpakategori(): void
    {
        $response = $this->actingAs($this->seller)->post('/seller/produk', [
            'nama_produk' => 'Produk Test',
            'deskripsi' => 'Deskripsi produk',
            'harga' => 100000,
            'stok' => 10,
            'kondisi' => 'baru',
        ]);

        $response->assertSessionHasErrors('category_id');
    }

    /**
     * Test upload gambar JPEG berhasil.
     */
    public function jpegberhasil(): void
    {
        Storage::fake('public');

        $response = $this->actingAs($this->seller)->post('/seller/produk', [
            'nama_produk' => 'Produk JPEG',
            'deskripsi' => 'Deskripsi',
            'harga' => 100000,
            'stok' => 10,
            'kondisi' => 'baru',
            'category_id' => $this->category->id,
            'image' => UploadedFile::fake()->image('foto.jpeg'),
        ]);

        $response->assertRedirect(route('seller.pages.view'));
        $response->assertSessionHas('success');
    }

    /**
     * Test upload gambar PNG berhasil.
     */
    public function pngberhasil(): void
    {
        Storage::fake('public');

        $response = $this->actingAs($this->seller)->post('/seller/produk', [
            'nama_produk' => 'Produk PNG',
            'deskripsi' => 'Deskripsi',
            'harga' => 100000,
            'stok' => 10,
            'kondisi' => 'baru',
            'category_id' => $this->category->id,
            'image' => UploadedFile::fake()->image('foto.png'),
        ]);

        $response->assertRedirect(route('seller.pages.view'));
        $response->assertSessionHas('success');
    }

    /**
     * Test upload gambar JPG berhasil.
     */
    public function jpgberhasil(): void
    {
        Storage::fake('public');

        $response = $this->actingAs($this->seller)->post('/seller/produk', [
            'nama_produk' => 'Produk JPG',
            'deskripsi' => 'Deskripsi',
            'harga' => 100000,
            'stok' => 10,
            'kondisi' => 'baru',
            'category_id' => $this->category->id,
            'image' => UploadedFile::fake()->image('foto.jpg'),
        ]);

        $response->assertRedirect(route('seller.pages.view'));
        $response->assertSessionHas('success');
    }

    /**
     * Test upload gambar GIF berhasil.
     */
    public function gifberhasil(): void
    {
        Storage::fake('public');

        $response = $this->actingAs($this->seller)->post('/seller/produk', [
            'nama_produk' => 'Produk GIF',
            'deskripsi' => 'Deskripsi',
            'harga' => 100000,
            'stok' => 10,
            'kondisi' => 'baru',
            'category_id' => $this->category->id,
            'image' => UploadedFile::fake()->image('foto.gif'),
        ]);

        $response->assertRedirect(route('seller.pages.view'));
        $response->assertSessionHas('success');
    }

    /**
     * Test upload gambar gagal jika bukan format yang diizinkan (misal: BMP).
     */
    public function gagalformattidakdiizinkan(): void
    {
        Storage::fake('public');

        $response = $this->actingAs($this->seller)->post('/seller/produk', [
            'nama_produk' => 'Produk BMP',
            'deskripsi' => 'Deskripsi',
            'harga' => 100000,
            'stok' => 10,
            'kondisi' => 'baru',
            'category_id' => $this->category->id,
            'image' => UploadedFile::fake()->create('foto.bmp', 500, 'image/bmp'),
        ]);

        $response->assertSessionHasErrors('image');
    }

    /**
     * Test upload gambar gagal jika ukuran melebihi 2MB.
     */
    public function gagalukuranmelebihi2mb(): void
    {
        Storage::fake('public');

        $response = $this->actingAs($this->seller)->post('/seller/produk', [
            'nama_produk' => 'Produk Gambar Besar',
            'deskripsi' => 'Deskripsi',
            'harga' => 100000,
            'stok' => 10,
            'kondisi' => 'baru',
            'category_id' => $this->category->id,
            'image' => UploadedFile::fake()->image('foto_besar.jpg')->size(3000), // 3MB > 2MB
        ]);

        $response->assertSessionHasErrors('image');
    }

    /**
     * Test upload gambar tepat 2MB berhasil.
     */
    public function tepat2mbberhasil(): void
    {
        Storage::fake('public');

        $response = $this->actingAs($this->seller)->post('/seller/produk', [
            'nama_produk' => 'Produk 2MB',
            'deskripsi' => 'Deskripsi',
            'harga' => 100000,
            'stok' => 10,
            'kondisi' => 'baru',
            'category_id' => $this->category->id,
            'image' => UploadedFile::fake()->image('foto.jpg')->size(2048), // tepat 2MB
        ]);

        $response->assertRedirect(route('seller.pages.view'));
        $response->assertSessionHas('success');
    }

    /**
     * Test upload produk tanpa gambar tetap berhasil (gambar opsional).
     */
    public function tanpagambar(): void
    {
        $response = $this->actingAs($this->seller)->post('/seller/produk', [
            'nama_produk' => 'Produk Tanpa Gambar',
            'deskripsi' => 'Deskripsi produk tanpa gambar',
            'harga' => 50000,
            'stok' => 20,
            'kondisi' => 'bekas',
            'category_id' => $this->category->id,
        ]);

        $response->assertRedirect(route('seller.pages.view'));

        $this->assertDatabaseHas('product', [
            'nama_produk' => 'Produk Tanpa Gambar',
            'image' => null,
        ]);
    }


    /**
     * Test harga harus numeric - gagal dengan string.
     */
    public function test_bukannumeric(): void
    {
        $response = $this->actingAs($this->seller)->post('/seller/produk', [
            'nama_produk' => 'Produk Test',
            'deskripsi' => 'Deskripsi',
            'harga' => 'sepuluh ribu',
            'stok' => 10,
            'kondisi' => 'baru',
            'category_id' => $this->category->id,
        ]);

        $response->assertSessionHasErrors('harga');
    }

    /**
     * Test harga gagal jika negatif.
     */
    public function harganegatif(): void
    {
        $response = $this->actingAs($this->seller)->post('/seller/produk', [
            'nama_produk' => 'Produk Test',
            'deskripsi' => 'Deskripsi',
            'harga' => -50000,
            'stok' => 10,
            'kondisi' => 'baru',
            'category_id' => $this->category->id,
        ]);

        $response->assertSessionHasErrors('harga');
    }

    /**
     * Test harga berhasil dengan nilai decimal.
     */
    public function hargadecimal(): void
    {
        $response = $this->actingAs($this->seller)->post('/seller/produk', [
            'nama_produk' => 'Produk Decimal',
            'deskripsi' => 'Deskripsi',
            'harga' => 99999.99,
            'stok' => 10,
            'kondisi' => 'baru',
            'category_id' => $this->category->id,
        ]);

        $response->assertRedirect(route('seller.pages.view'));
        $response->assertSessionHas('success');
    }

    /**
     * Test harga berhasil dengan nol.
     */
    public function hargaberhasildengannol(): void
    {
        $response = $this->actingAs($this->seller)->post('/seller/produk', [
            'nama_produk' => 'Produk Gratis',
            'deskripsi' => 'Deskripsi produk gratis',
            'harga' => 0,
            'stok' => 100,
            'kondisi' => 'baru',
            'category_id' => $this->category->id,
        ]);

        $response->assertRedirect(route('seller.pages.view'));
    }

    /**
     * Test stok harus integer - gagal dengan decimal.
     */
    public function stokgagaldecimal(): void
    {
        $response = $this->actingAs($this->seller)->post('/seller/produk', [
            'nama_produk' => 'Produk Test',
            'deskripsi' => 'Deskripsi',
            'harga' => 100000,
            'stok' => 5.5,
            'kondisi' => 'baru',
            'category_id' => $this->category->id,
        ]);

        $response->assertSessionHasErrors('stok');
    }

    /**
     * Test stok harus integer - gagal dengan string.
     */
    public function stokgagalbukaninteger(): void
    {
        $response = $this->actingAs($this->seller)->post('/seller/produk', [
            'nama_produk' => 'Produk Test',
            'deskripsi' => 'Deskripsi',
            'harga' => 100000,
            'stok' => 'lima',
            'kondisi' => 'baru',
            'category_id' => $this->category->id,
        ]);

        $response->assertSessionHasErrors('stok');
    }

    /**
     * Test stok gagal jika negatif.
     */
    public function stokgagaljikaneatif(): void
    {
        $response = $this->actingAs($this->seller)->post('/seller/produk', [
            'nama_produk' => 'Produk Test',
            'deskripsi' => 'Deskripsi',
            'harga' => 100000,
            'stok' => -5,
            'kondisi' => 'baru',
            'category_id' => $this->category->id,
        ]);

        $response->assertSessionHasErrors('stok');
    }

    /**
     * Test kondisi 'baru' berhasil.
     */
    public function kondisibaru(): void
    {
        $response = $this->actingAs($this->seller)->post('/seller/produk', [
            'nama_produk' => 'Produk Baru',
            'deskripsi' => 'Deskripsi produk baru',
            'harga' => 200000,
            'stok' => 15,
            'kondisi' => 'baru',
            'category_id' => $this->category->id,
        ]);

        $response->assertRedirect(route('seller.pages.view'));

        $this->assertDatabaseHas('product', [
            'nama_produk' => 'Produk Baru',
            'kondisi' => 'baru',
        ]);
    }

    /**
     * Test kondisi 'bekas' berhasil.
     */
    public function kondisibekas(): void
    {
        $response = $this->actingAs($this->seller)->post('/seller/produk', [
            'nama_produk' => 'Produk Bekas',
            'deskripsi' => 'Deskripsi produk bekas',
            'harga' => 75000,
            'stok' => 3,
            'kondisi' => 'bekas',
            'category_id' => $this->category->id,
        ]);

        $response->assertRedirect(route('seller.pages.view'));

        $this->assertDatabaseHas('product', [
            'nama_produk' => 'Produk Bekas',
            'kondisi' => 'bekas',
        ]);
    }

    /**
     * Test kondisi gagal dengan nilai selain 'baru' atau 'bekas'.
     */
    public function kondisigagalnilaiinvalid(): void
    {
        $response = $this->actingAs($this->seller)->post('/seller/produk', [
            'nama_produk' => 'Produk Test',
            'deskripsi' => 'Deskripsi',
            'harga' => 100000,
            'stok' => 10,
            'kondisi' => 'rusak',
            'category_id' => $this->category->id,
        ]);

        $response->assertSessionHasErrors('kondisi');
    }

    /**
     * Test kondisi gagal dengan string acak.
     */
    public function kondisigagalstringacak(): void
    {
        $response = $this->actingAs($this->seller)->post('/seller/produk', [
            'nama_produk' => 'Produk Test',
            'deskripsi' => 'Deskripsi',
            'harga' => 100000,
            'stok' => 10,
            'kondisi' => 'second',
            'category_id' => $this->category->id,
        ]);

        $response->assertSessionHasErrors('kondisi');
    }

    /**
     * Test kondisi wajib diisi.
     */
    public function kondisiwajibdiisi(): void
    {
        $response = $this->actingAs($this->seller)->post('/seller/produk', [
            'nama_produk' => 'Produk Test',
            'deskripsi' => 'Deskripsi',
            'harga' => 100000,
            'stok' => 10,
            'category_id' => $this->category->id,
        ]);

        $response->assertSessionHasErrors('kondisi');
    }

    /**
     * Test upload berhasil dengan kategori yang ada di database.
     */
    public function kategorivalidberhasil(): void
    {
        $kategori = Category::factory()->create(['nama' => 'Fashion']);

        $response = $this->actingAs($this->seller)->post('/seller/produk', [
            'nama_produk' => 'Baju Batik',
            'deskripsi' => 'Batik khas Jawa',
            'harga' => 150000,
            'stok' => 25,
            'kondisi' => 'baru',
            'category_id' => $kategori->id,
        ]);

        $response->assertRedirect(route('seller.pages.view'));

        $this->assertDatabaseHas('product', [
            'nama_produk' => 'Baju Batik',
            'category_id' => $kategori->id,
        ]);
    }

    /**
     * Test upload gagal dengan category_id yang tidak ada di database.
     */
    public function kategorigagaljikatidakadadatabase(): void
    {
        $response = $this->actingAs($this->seller)->post('/seller/produk', [
            'nama_produk' => 'Produk Test',
            'deskripsi' => 'Deskripsi',
            'harga' => 100000,
            'stok' => 10,
            'kondisi' => 'baru',
            'category_id' => 99999, // ID tidak ada
        ]);

        $response->assertSessionHasErrors('category_id');
    }

    /**
     * Test upload gagal dengan category_id nol.
     */
    public function kategorigagaljikaidnol(): void
    {
        $response = $this->actingAs($this->seller)->post('/seller/produk', [
            'nama_produk' => 'Produk Test',
            'deskripsi' => 'Deskripsi',
            'harga' => 100000,
            'stok' => 10,
            'kondisi' => 'baru',
            'category_id' => 0,
        ]);

        $response->assertSessionHasErrors('category_id');
    }

    /**
     * Test upload gagal dengan category_id string.
     */
    public function kategorigagaljikastrings(): void
    {
        $response = $this->actingAs($this->seller)->post('/seller/produk', [
            'nama_produk' => 'Produk Test',
            'deskripsi' => 'Deskripsi',
            'harga' => 100000,
            'stok' => 10,
            'kondisi' => 'baru',
            'category_id' => 'elektronik',
        ]);

        $response->assertSessionHasErrors('category_id');
    }

    /**
     * Test produk yang diupload terhubung ke seller yang login.
     */
    public function produkterhubung_ke_seller_yang_login(): void
    {
        $seller2 = User::factory()->create([
            'role' => 'seller',
            'status' => 'approved',
        ]);

        $this->actingAs($this->seller)->post('/seller/produk', [
            'nama_produk' => 'Produk Seller 1',
            'deskripsi' => 'Deskripsi',
            'harga' => 100000,
            'stok' => 10,
            'kondisi' => 'baru',
            'category_id' => $this->category->id,
        ]);

        $this->assertDatabaseHas('product', [
            'nama_produk' => 'Produk Seller 1',
            'user_id' => $this->seller->id,
        ]);

        $this->assertDatabaseMissing('product', [
            'nama_produk' => 'Produk Seller 1',
            'user_id' => $seller2->id,
        ]);
    }
}
