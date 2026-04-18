<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_toko' => fake()->company(),
            'deskripsi_singkat' => fake()->sentence(),
            'nama' => fake()->name(),
            'no_hp' => '08'.fake()->numerify('##########'),
            'email' => fake()->unique()->safeEmail(),
            'alamat' => fake()->address(),
            'rt' => str_pad((string) fake()->numberBetween(1, 999), 3, '0', STR_PAD_LEFT),
            'rw' => str_pad((string) fake()->numberBetween(1, 999), 3, '0', STR_PAD_LEFT),
            'nama_kelurahan' => fake()->citySuffix(),
            'kabupaten_kota' => fake()->city(),
            'provinsi' => fake()->state(),
            'no_ktp' => fake()->unique()->numerify('################'),
            'foto' => 'placeholder_user_photo.jpg',
            'foto_ktp' => 'placeholder_user_ktp.jpg',
            'password' => static::$password ??= Hash::make('password'),
            'role' => 'seller',
            'status' => 'approved',
            'rejection_reason' => null,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this;
    }
}
