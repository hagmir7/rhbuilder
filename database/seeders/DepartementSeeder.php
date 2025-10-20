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
        $administratif = Departement::create([
            "name" => "Administratif et Financier",
            "description" => "est un département clé au sein d'une organisation, responsable de la gestion des aspects administratifs et financiers de celle-ci"
        ]);

        $logistique = Departement::create([
            "name" => "Logistique",
            "description" => "gère l'ensemble des flux de marchandises, de l'approvisionnement à la livraison, en passant par le stockage"
        ]);

        $production = Departement::create([
            "name" => "Production",
            "description" => "terme générique qui fait référence à l'ensemble des activités d'une entreprise liées à la fabrication de biens ou de services"
        ]);

        Service::create([
            "name" => "Achat et approvisionnement",
            "departement_id" => $logistique->id,
            "responsible_id" => 1
        ]);

        Service::create([
            "name" => "Stock et Magasinage",
            "departement_id" => $logistique->id,
            "responsible_id" => 1
        ]);

        Service::create([
            "name" => "Préparation expéditions",
            "departement_id" => $logistique->id,
            "responsible_id" => 1
        ]);


        Service::create([
            "name" => "RH et SI",
            "departement_id" => $administratif->id,
            "responsible_id" => 1
        ]);

        Service::create([
            "name" => "Comptabilité",
            "departement_id" => $administratif->id,
            "responsible_id" => 1
        ]);

        Service::create([
            "name" => "Marketing",
            "departement_id" => $administratif->id,
            "responsible_id" => 1
        ]);

        Service::create([
            "name" => "Fabrication",
            "departement_id" => $production->id,
            "responsible_id" => 1
        ]);

        Service::create([
            "name" => "Mantenance",
            "departement_id" => $production->id,
            "responsible_id" => 1
        ]);

        Service::create([
            "name" => "Conformité des produits et de la sécurité",
            "departement_id" => $production->id,
            "responsible_id" => 1
        ]);
    }
}
