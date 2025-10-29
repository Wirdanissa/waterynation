<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::create([
            'name' => 'Admin',
            'email' => 'waterynation@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('12345678'),
            'role' => 'Admin',
        ]);
    }
}
