<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Level::create(['name' => "Bac", 'years' => 0, 'coefficient' => 1]);
        Level::create(['name' => "DEUG", 'years' => 2, 'coefficient' => 2]);
        Level::create(['name' => "DEUST", 'years' => 2, 'coefficient' => 2]);
        Level::create(['name' => "DUT", 'years' => 2, 'coefficient' => 2]);
        Level::create(['name' => "BTS", 'years' => 2, 'coefficient' => 2]);
        Level::create(['name' => "DTS", 'years' => 2, 'coefficient' => 2]);
        Level::create(['name' => "DT", 'years' => 2, 'coefficient' => 2]);
        Level::create(['name' => "LF", 'years' => 3, 'coefficient' => 3]);
        Level::create(['name' => "LST", 'years' => 3, 'coefficient' => 3]);
        Level::create(['name' => "LP", 'years' => 3, 'coefficient' => 3]);
        Level::create(['name' => "MS", 'years' => 5, 'coefficient' => 5]);
        Level::create(['name' => "MR", 'years' => 5, 'coefficient' => 5]);
        Level::create(['name' => "MST", 'years' => 5, 'coefficient' => 5]);
        Level::create(['name' => "IE", 'years' => 2, 'coefficient' => 2]);
        Level::create(['name' => "MST", 'years' => 2, 'coefficient' => 2]);
        Level::create(['name' => "Doctorat", 'years' => 6, 'coefficient' => 2]);
        Level::create(['name' => "MBA", 'years' => 5, 'coefficient' => 2]);
        Level::create(['name' => "Bachelor", 'years' => 3, 'coefficient' => 2]);
    }
}
