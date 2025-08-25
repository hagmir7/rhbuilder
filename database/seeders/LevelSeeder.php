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
        Level::create(['name' => "Bac", 'description' => "Baccalauréat", 'years' => 0, 'coefficient' => 1]);
        Level::create(['name' => "DEUG", 'description' => "Diplôme d'Études Universitaires Générales", 'years' => 2, 'coefficient' => 2]);
        Level::create(['name' => "DEUST", 'description' => "Diplôme d'Études Universitaires Scientifiques et Techniques", 'years' => 2, 'coefficient' => 2]);
        Level::create(['name' => "DUT", 'description' => "Diplôme Universitaire de Technologie", 'years' => 2, 'coefficient' => 2]);
        Level::create(['name' => "BTS", 'description' => "Brevet de Technicien Supérieur", 'years' => 2, 'coefficient' => 2]);
        Level::create(['name' => "DTS", 'description' => "Diplôme de Technicien Spécialisé", 'years' => 2, 'coefficient' => 2]);
        Level::create(['name' => "DT", 'description' => "Diplôme de Technicien", 'years' => 2, 'coefficient' => 2]);
        Level::create(['name' => "LF", 'description' => "Licence Fondamentale", 'years' => 3, 'coefficient' => 3]);
        Level::create(['name' => "LST", 'description' => "Licence Sciences et Techniques", 'years' => 3, 'coefficient' => 3]);
        Level::create(['name' => "LP", 'description' => "Licence Professionnelle", 'years' => 3, 'coefficient' => 3]);
        Level::create(['name' => "MS", 'description' => "Master Spécialisé", 'years' => 5, 'coefficient' => 5]);
        Level::create(['name' => "MR", 'description' => "Master Recherche", 'years' => 5, 'coefficient' => 5]);
        Level::create(['name' => "MST", 'description' => "Master Sciences et Techniques", 'years' => 5, 'coefficient' => 5]);
        Level::create(['name' => "IE", 'description' => "Ingénieur d'État", 'years' => 2, 'coefficient' => 2]);
        Level::create(['name' => "MST", 'description' => "Maîtrise Sciences et Techniques", 'years' => 2, 'coefficient' => 2]);
        Level::create(['name' => "Doctorat", 'description' => "Doctorat", 'years' => 6, 'coefficient' => 2]);
        Level::create(['name' => "MBA", 'description' => "Master of Business Administration", 'years' => 5, 'coefficient' => 2]);
        Level::create(['name' => "Bachelor", 'description' => "Bachelor", 'years' => 3, 'coefficient' => 2]);
    }
}
