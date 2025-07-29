<?php

namespace Database\Seeders;

use App\Models\Departement;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fabrication = Departement::create([
            "name" => "Fabrication"
        ]);

        $administratif = Departement::create([
            "name" => "Administratif et Financier"
        ]);


        $Logistique = Departement::create([
            "name" => "Logistique"
        ]);

        Service::create([
            "name" => "Production",
            "departement_id" =>  $fabrication->id,
            "responsible_id" => 1,
        ]);

        Service::create([
            "name" => "Maintenance",
            "departement_id" =>  $fabrication->id,
            "responsible_id" => 1,
        ]);

        Service::create([
            "name" => "Qualité",
            "departement_id" =>  $fabrication->id,
            "responsible_id" => 1,
        ]);

        Service::create([
            "name" => "RH et SI",
            "departement_id" =>  $administratif->id,
            "responsible_id" => 1,
        ]);

        Service::create([
            "name" => "Comptabilité",
            "departement_id" =>  $administratif->id,
            "responsible_id" => 1,
        ]);

        Service::create([
            "name" => "Marketing",
            "departement_id" =>  $administratif->id,
            "responsible_id" => 1,
        ]);

        Service::create([
            "name" => "Achat",
            "departement_id" =>  $Logistique->id,
            "responsible_id" => 1,
        ]);

        Service::create([
            "name" => "Preparation et expedition",
            "departement_id" =>  $Logistique->id,
            "responsible_id" => 1,
        ]);

    }
}
