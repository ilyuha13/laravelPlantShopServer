<?php

namespace Database\Seeders;

use App\Models\Species;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpeciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Species::factory()->create([
                    'id' => 1,
                   'name' => 'Species 1',
                   'description' => 'Description for species 1',
                   'image_urls' => json_encode(['url1', 'url2']),
                   'created_at' => now(),
                   'updated_at' => now(),
           ]);
        //
    }
}
