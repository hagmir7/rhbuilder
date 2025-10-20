<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $skills = [
            [
                'name' => 'Programmation',
                'skill_type_id' => 1
            ],
            [
                'name' => 'Développement web',
                'skill_type_id' => 1
            ],
            [
                'name' => 'Base de données',
                'skill_type_id' => 1,
            ],
            [
                'name' => 'Cybersécurité',
                'skill_type_id' => 1
            ],
            [
                'name' => 'Réseaux et systèmes',
                'skill_type_id' => 1
            ],
            [
                'name' => 'Analyse de données',
                'skill_type_id' => 1
            ],
            [
                'name' => 'Compétences Cloud',
                'skill_type_id' => 1
            ],
            [
                'name' => 'Gestion de projet IT',
                'skill_type_id' => 1
            ]
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }
}
