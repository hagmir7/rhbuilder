<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Activity::create([
            "name" => "Communication de la fiche de poste de la nouvelle recrue"
        ]);

        Activity::create([
            "name" => "Communication du règlement interne"
        ]);

        Activity::create([
            "name" => "Communication du matériel de travail"
        ]);

        Activity::create([
            "name" => "Communication des procédures de travail"
        ]);

        Activity::create([
            "name" => "Communication des documents de la qualité liés à l’amélioration"
        ]);
        Activity::create([
            "name" => "Visite du chantier"
        ]);
    }
}
