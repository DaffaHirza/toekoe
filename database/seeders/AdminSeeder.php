<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Pastikan data Admin TIDAK duplikat
        if (User::where('email', 'admin@example.com')->doesntExist()) {
            User::create([
                // Data Admin
                'nama_toko' => 'Admin Panel',
                'deskripsi_singkat' => 'Akun khusus untuk administrasi sistem.',
                'nama' => 'Super Admin',
                'no_hp' => '081234567890',
                'email' => 'admin@example.com',
                'alamat' => 'Kantor Pusat',
                'rt' => '001',
                'rw' => '001',
                'nama_kelurahan' => 'Admin Jaya',
                'kabupaten_kota' => 'Jakarta',
                'provinsi' => 'DKI Jakarta',
                'no_ktp' => '1234567890123456',
                'foto' => 'placeholder_admin_photo.jpg',
                'foto_ktp' => 'placeholder_admin_ktp.jpg',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'status' => 'approved',
                'rejection_reason' => null,
            ]);
        }
    }
}
