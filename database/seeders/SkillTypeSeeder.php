<?php

namespace Database\Seeders;

use App\Models\SkillType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SkillType::create([
            'name' => 'Techniques'
        ]);

        SkillType::create([
            'name' => 'Interpersonnelles'
        ]);
    }
}
