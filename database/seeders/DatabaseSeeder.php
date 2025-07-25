<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CompanySeeder::class,
            CitySeeder::class,
            LevelSeeder::class,
            SkillTypeSeeder::class,
            SkillSeeder::class,
            LanguageSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
        ]);
    }
}
