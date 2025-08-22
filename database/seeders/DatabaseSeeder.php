<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Use firstOrCreate to prevent duplicate entry errors.
        // It will find the user by email or create them if they don't exist.
        User::firstOrCreate(
            ['email' => 'hireme@michaelpragsdale.com'],
            [
                'name' => 'Michael Ragsdale',
                'password' => Hash::make('AXBrkQlZMmFY137'), // A default password is required for creation
            ]
        );

        // Call your new ProjectSeeder
        $this->call([
            ProjectSeeder::class,
        ]);
    }
}
