<?php

namespace Database\Factories;

use App\Models\Programs;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProgramsFactory extends Factory
{
    protected $model = Programs::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(4);

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(100, 999),
            'description' => $this->faker->paragraph(3),
            'category' => $this->faker->randomElement([
                'Offline Action',
                'Online Webinar',
                'Modul Development For Kids',
            ]),
            'is_registrasi' => false,
            'image' => null,
            'youtube_url' => null,
            'link_url' => null,
            'lokasi' => $this->faker->city,
            'start_date' => now()->addDays(rand(1, 10)),
            'end_date' => now()->addDays(rand(11, 20)),
            'status_publikasi' => 'Published',
        ];
    }
}
