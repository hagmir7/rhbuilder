<?php

namespace Database\Seeders;

use App\Models\CriteriaTypes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CriteriaTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CriteriaTypes::create([
            'name' => 'CV et Lettre de motivation',
        ]);


        CriteriaTypes::create([
            'name' => 'Qualité',
        ]);

        CriteriaTypes::create([
            'name' => 'Expériences',
        ]);

        CriteriaTypes::create([
            'name' => 'Connaissances / Compétences',
        ]);
    }
}
