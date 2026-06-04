<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test halaman login bisa diakses.
     */
    public function halamandiakses(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function testguestaccesssellerpage(): void
    {
        $response = $this->get('/seller/beranda');

        $response->assertRedirect('/login');
    }

    public function testselleraccesssellerpage(): void
    {
        $seller = User::factory()->create([
            'role' => 'seller',
        ]);

        $response = $this->actingAs($seller)
            ->get('/seller/beranda');

        $response->assertStatus(200);
    }

    public function testadminaccesssellerpage(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)
            ->get('/seller/beranda');

        $response->assertStatus(403);
    }


    /**
     * Test login berhasil dengan email dan password yang benar.
     */
    public function testloginseller(): void
    {
        $user = User::factory()->create([
            'role' => 'seller',
            'status' => 'approved',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test login gagal dengan password salah.
     */
    public function testlogingagalpasswordsalah(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password_salah',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /**
     * Test login gagal dengan email yang tidak terdaftar.
     */
    public function testlogingagalemailtidakterdaftar(): void
    {
        $response = $this->post('/login', [
            'email' => 'tidakada@email.com',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /**
     * Test login gagal tanpa email.
     */
    public function testlogingagaltanpaemail(): void
    {
        $response = $this->post('/login', [
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /**
     * Test login gagal tanpa password.
     */
    public function testlogingagaltanpapassword(): void
    {
        $response = $this->post('/login', [
            'email' => 'test@example.com',
        ]);

        $response->assertSessionHasErrors('password');
    }


    /**
     * Test admin login dan redirect ke halaman admin beranda.
     */
    public function testadminlogin(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'status' => 'approved',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => $admin->email,
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('admin.beranda'));
        $this->assertAuthenticatedAs($admin);
    }

    /**
     * Test seller approved login dan redirect ke seller beranda.
     */
    public function testsellerlogin(): void
    {
        $seller = User::factory()->create([
            'role' => 'seller',
            'status' => 'approved',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => $seller->email,
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('seller.beranda'));
        $this->assertAuthenticatedAs($seller);
    }

    /**
     * Test seller pending tidak bisa login.
     */
    public function testtidakbisalogin(): void
    {
        $seller = User::factory()->create([
            'role' => 'seller',
            'status' => 'pending',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => $seller->email,
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /**
     * Test seller rejected tidak bisa login.
     */
    public function testtidakbisaloginrejected(): void
    {
        $seller = User::factory()->create([
            'role' => 'seller',
            'status' => 'rejected',
            'rejection_reason' => 'Dokumen tidak valid',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => $seller->email,
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /**
     * Test guest tidak bisa akses halaman seller.
     */
    public function guestakseshalamanseller(): void
    {
        $response = $this->get('/seller/produk');

        $response->assertRedirect('/login');
    }

    /**
     * Test guest tidak bisa akses halaman admin.
     */
    public function guestakseshalamanadmin(): void
    {
        $response = $this->get('/admin/beranda');

        $response->assertRedirect('/login');
    }

    /**
     * Test user bisa logout.
     */
    public function userlogout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $response->assertRedirect('/login');
        $this->assertGuest();
    }

    /**
     * Test session di-invalidate setelah logout.
     */
    public function invalidatesetelahlogout(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);
        $this->assertAuthenticatedAs($user);

        $this->post('/logout');

        $this->assertGuest();
    }
}
