<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Programs;

class ProgramsSeeder extends Seeder
{
    public function run(): void
    {
        Programs::factory()->count(30)->create();
    }
}
