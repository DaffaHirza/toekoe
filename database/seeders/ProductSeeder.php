<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Produk;
use Illuminate\Support\Facades\Hash;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Pastikan kategori Fashion dan Elektronik tersedia
        $fashion = Category::firstOrCreate(['nama' => 'Fashion']);
        $elektronik = Category::firstOrCreate(['nama' => 'Elektronik']);

        // 2. Buat/pastikan user/seller untuk tiap lokasi (Semarang, Jakarta, Bandung) dengan status approved
        $sellerSemarang = User::firstOrCreate(
            ['email' => 'seller.semarang@example.com'],
            [
                'nama' => 'Seller Semarang',
                'nama_toko' => 'Toko Semarang',
                'deskripsi_singkat' => 'Toko di Semarang',
                'no_hp' => '081211111111',
                'alamat' => 'Jl. Semarang No. 1',
                'rt' => '001',
                'rw' => '001',
                'nama_kelurahan' => 'Semarang Tengah',
                'kabupaten_kota' => 'Semarang',
                'provinsi' => 'Jawa Tengah',
                'no_ktp' => '3301010101010001',
                'foto' => 'placeholder_foto.jpg',
                'foto_ktp' => 'placeholder_foto_ktp.jpg',
                'password' => Hash::make('password'),
                'role' => 'seller',
                'status' => 'approved',
            ]
        );

        $sellerJakarta = User::firstOrCreate(
            ['email' => 'seller.jakarta@example.com'],
            [
                'nama' => 'Seller Jakarta',
                'nama_toko' => 'Toko Jakarta',
                'deskripsi_singkat' => 'Toko di Jakarta',
                'no_hp' => '081222222222',
                'alamat' => 'Jl. Jakarta No. 1',
                'rt' => '002',
                'rw' => '002',
                'nama_kelurahan' => 'Kebayoran',
                'kabupaten_kota' => 'Jakarta',
                'provinsi' => 'DKI Jakarta',
                'no_ktp' => '3101010101010002',
                'foto' => 'placeholder_foto.jpg',
                'foto_ktp' => 'placeholder_foto_ktp.jpg',
                'password' => Hash::make('password'),
                'role' => 'seller',
                'status' => 'approved',
            ]
        );

        $sellerBandung = User::firstOrCreate(
            ['email' => 'seller.bandung@example.com'],
            [
                'nama' => 'Seller Bandung',
                'nama_toko' => 'Toko Bandung',
                'deskripsi_singkat' => 'Toko di Bandung',
                'no_hp' => '081233333333',
                'alamat' => 'Jl. Bandung No. 1',
                'rt' => '003',
                'rw' => '003',
                'nama_kelurahan' => 'Coblong',
                'kabupaten_kota' => 'Bandung',
                'provinsi' => 'Jawa Barat',
                'no_ktp' => '3201010101010003',
                'foto' => 'placeholder_foto.jpg',
                'foto_ktp' => 'placeholder_foto_ktp.jpg',
                'password' => Hash::make('password'),
                'role' => 'seller',
                'status' => 'approved',
            ]
        );

        // 3. Masukkan Data Produk Dummy
        // Produk 1: Sepatu Sneakers, kategori Fashion, lokasi Semarang
        Produk::firstOrCreate(
            ['nama_produk' => 'Sepatu Sneakers'],
            [
                'deskripsi' => 'Sepatu sneakers keren dan nyaman digunakan sehari-hari.',
                'harga' => 350000.00,
                'stok' => 15,
                'kondisi' => 'baru',
                'user_id' => $sellerSemarang->id,
                'category_id' => $fashion->id,
            ]
        );

        // Produk 2: Kaos Polos, kategori Fashion, lokasi Jakarta
        Produk::firstOrCreate(
            ['nama_produk' => 'Kaos Polos'],
            [
                'deskripsi' => 'Kaos polos katun combed 30s berkualitas tinggi.',
                'harga' => 50000.00,
                'stok' => 50,
                'kondisi' => 'baru',
                'user_id' => $sellerJakarta->id,
                'category_id' => $fashion->id,
            ]
        );

        // Produk 3: Mouse Wireless, kategori Elektronik, lokasi Semarang
        Produk::firstOrCreate(
            ['nama_produk' => 'Mouse Wireless'],
            [
                'deskripsi' => 'Mouse wireless responsif dan hemat baterai.',
                'harga' => 120000.00,
                'stok' => 20,
                'kondisi' => 'baru',
                'user_id' => $sellerSemarang->id,
                'category_id' => $elektronik->id,
            ]
        );

        // Produk 4: Tas Kuliah, kategori Fashion, lokasi Bandung
        Produk::firstOrCreate(
            ['nama_produk' => 'Tas Kuliah'],
            [
                'deskripsi' => 'Tas punggung kuliah modis dan berkapasitas besar.',
                'harga' => 180000.00,
                'stok' => 10,
                'kondisi' => 'baru',
                'user_id' => $sellerBandung->id,
                'category_id' => $fashion->id,
            ]
        );
    }
}
