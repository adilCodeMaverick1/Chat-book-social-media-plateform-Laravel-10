<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Theme;

class ThemesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Theme::create([
            'name' => 'Ocean Blue',
            'description' => 'A calming blue theme',
            'cost' => 20,
            'color' => '#1E90FF'
        ]);

        Theme::create([
            'name' => 'Sunset Orange',
            'description' => 'A warm orange theme',
            'cost' => 20,
            'color' => '#FF4500'
        ]);

        Theme::create([
            'name' => 'Forest Green',
            'description' => 'A refreshing green theme',
            'cost' => 20,
            'color' => '#228B22'
        ]);

        Theme::create([
            'name' => 'Royal Purple',
            'description' => 'A majestic purple theme',
            'cost' => 20,
            'color' => '#6A5ACD'
        ]);
    }
}
