<?php

namespace Tests\Unit;

use App\Models\Produk;
use PHPUnit\Framework\TestCase;

class ProdukTest extends TestCase
{
    /**
     * Test formatted harga menghasilkan format Rupiah yang benar.
     */
    public function test_formatted_harga_returns_rupiah_format(): void
    {
        $produk = new Produk();
        $produk->harga = 1500000;

        $this->assertEquals('Rp 1.500.000', $produk->formatted_harga);
    }

    /**
     * Test formatted harga dengan nilai nol.
     */
    public function test_formatted_harga_with_zero(): void
    {
        $produk = new Produk();
        $produk->harga = 0;

        $this->assertEquals('Rp 0', $produk->formatted_harga);
    }

    /**
     * Test is_baru attribute returns true untuk kondisi 'baru'.
     */
    public function test_is_baru_returns_true_for_baru_kondisi(): void
    {
        $produk = new Produk();
        $produk->kondisi = 'baru';

        $this->assertTrue($produk->is_baru);
    }

    /**
     * Test is_baru attribute returns false untuk kondisi 'bekas'.
     */
    public function test_is_baru_returns_false_for_bekas_kondisi(): void
    {
        $produk = new Produk();
        $produk->kondisi = 'bekas';

        $this->assertFalse($produk->is_baru);
    }

    /**
     * Test is_bekas attribute returns true untuk kondisi 'bekas'.
     */
    public function test_is_bekas_returns_true_for_bekas_kondisi(): void
    {
        $produk = new Produk();
        $produk->kondisi = 'bekas';

        $this->assertTrue($produk->is_bekas);
    }

    /**
     * Test is_bekas attribute returns false untuk kondisi 'baru'.
     */
    public function test_is_bekas_returns_false_for_baru_kondisi(): void
    {
        $produk = new Produk();
        $produk->kondisi = 'baru';

        $this->assertFalse($produk->is_bekas);
    }
}
