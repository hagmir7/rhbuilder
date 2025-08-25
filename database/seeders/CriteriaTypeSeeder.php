<?php

namespace Database\Seeders;

use App\Models\Criteria;
use App\Models\CriteriaType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CriteriaTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CriteriaType::create([
            'name' => 'CV et Lettre de motivation',
        ]);

        Criteria::create([
            'code' => 'C00001',
            'description' => "Présentation générale du CV",
            'criteria_type_id' => 1
        ]);

          Criteria::create([
            'code' => 'C00002',
            'description' => "Présentation générale de la LM/DT",
            'criteria_type_id' => 1
        ]);

        Criteria::create([
            'code' => 'C00003',
            'description' => "Expression écrite",
            'criteria_type_id' => 1
        ]);



        CriteriaType::create([
            'name' => 'Qualité',
        ]);

           Criteria::create([
            'code' => 'C00004',
            'description' => "Polyvalence",
            'criteria_type_id' => 2
        ]);

           Criteria::create([
            'code' => 'C00005',
            'description' => "Organisation",
            'criteria_type_id' => 2
        ]);
          Criteria::create([
            'code' => 'C00006',
            'description' => "Travail en équipe",
            'criteria_type_id' => 2
        ]);

         Criteria::create([
            'code' => 'C00007',
            'description' => "Mobilité",
            'criteria_type_id' => 2
        ]);

         Criteria::create([
            'code' => 'C00008',
            'description' => "Ponctualité",
            'criteria_type_id' => 2
        ]);


        CriteriaType::create([
            'name' => 'Expériences',
        ]);

        Criteria::create([
            'code' => 'C00009',
            'description' => "Expériences significatives",
            'criteria_type_id' => 3
        ]);

        CriteriaType::create([
            'name' => 'Connaissances / Compétences',
        ]);
    }
}
