<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            AdminSeeder::class,
        ]);

        if (User::where('email', 'test@example.com')->doesntExist()) {
            User::factory()->create([
                'nama' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }
    }
}
