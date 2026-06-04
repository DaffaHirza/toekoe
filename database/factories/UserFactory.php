<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'no_hp' => fake()->numerify('08##########'),
            'email' => fake()->unique()->safeEmail(),
            'alamat' => fake()->address(),
            'rt' => fake()->numerify('###'),
            'rw' => fake()->numerify('###'),
            'nama_kelurahan' => fake()->city(),
            'kabupaten_kota' => fake()->city(),
            'provinsi' => fake()->state(),
            'no_ktp' => fake()->unique()->numerify('################'),
            'foto' => 'default.jpg',
            'foto_ktp' => 'default_ktp.jpg',
            'password' => static::$password ??= Hash::make('password'),
            'role' => 'seller',
            'status' => 'approved',
            'rejection_reason' => null,
            'is_active' => true,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
