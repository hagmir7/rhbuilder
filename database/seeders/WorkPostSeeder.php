<?php

namespace Database\Seeders;

use App\Models\CompanyWorkPost;
use App\Models\WorkPost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workPosts = [
            "name" => "Comptabilité et Gestion",
            "name" => "Service Client et Centres d'Appels",
            "name" => "Commercial et Ventes",
            "name" => "Administration et Support",
            "name" => "Transport et Logistique",
            "name" => "Technologie et Informatique",

            // "name" => "Banque et Finance",
            // "name" => "Production et Qualité",
            // "name" => "Tourisme et Hôtellerie",
            // "name" => "Assistant Administratif",
            // "name" => "Postes pour Débutants",
            // "name" => "Magasinier",
            // "name" => "Technicien Support N1",
            // "name" => "Ingénieur Efficacité Énergétique",
            // "name" => "Vendeur Détail",
            // "name" => "Technicien Laboratoire Analyse Métaux",
            // "name" => "Consultant BI/BW",
            // "name" => "Agent de Réservation",
        ];

        foreach ($workPosts as $post) {
            CompanyWorkPost::create(["name" => $post]);
        }
    }
}
