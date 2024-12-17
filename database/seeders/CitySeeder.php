<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['name' => 'Tangier'],
            ['name' => 'Asilah'],
            ['name' => 'Beni-Mellal'],
            ['name' => 'Merzouga'],
            ['name' => 'Meknes'],
            ['name' => 'Ifran'],
            ['name' => 'Midelt'],
            ['name' => 'Imouzzer Kandar'],
            ['name' => 'Azrou'],
            ['name' => 'Bhalil'],
            ['name' => 'Sefrou'],
            ['name' => 'Fes'],
            ['name' => 'Igoudar, Marrakech-Safi'],
            ['name' => 'El Moukhtar'],
            ['name' => 'Tamanar'],
            ['name' => 'Marrakech'],
            ['name' => 'Oualidia'],
            ['name' => 'Ouahat Sidi Brahim'],
            ['name' => 'Chichaoua'],
            ['name' => 'Ghazoua'],
            ['name' => 'Diabat'],
            ['name' => 'Safi'],
            ['name' => 'Essaouira'],
            ['name' => 'Tazzarine'],
            ['name' => 'Ouarzazate'],
            ['name' => 'Erfoud'],
            ['name' => 'Tinejdad'],
            ['name' => 'Errachidia'],
            ['name' => 'Kalaat M\'Gouna'],
            ['name' => 'Tamegroute'],
            ['name' => 'Zagora'],
            ['name' => 'Rissani'],
            ['name' => 'Ksar Tanamouste'],
            ['name' => 'Tansikht'],
            ['name' => 'Tinghir'],
            ['name' => 'Hassilabied'],
            ['name' => 'Khemliya'],
            ['name' => 'Boumalne Dades'],
            ['name' => 'Ait Benhaddou'],
            ['name' => 'Kenitra'],
            ['name' => 'Salé, Morocco'],
            ['name' => 'Rabat'],
            ['name' => 'Oulad Mtaa'],
            ['name' => 'Anza Morocco'],
            ['name' => 'El Jadida'],
            ['name' => 'Casablanca'],
            ['name' => 'Mohammedia'],
            ['name' => 'Settat'],
            ['name' => 'Tamallalt'],
            ['name' => 'Massa, Morocco'],
            ['name' => 'Dakhla'],
            ['name' => 'Nador'],
            ['name' => 'Al Hoceima'],
            ['name' => 'Chefchaouen'],
            ['name' => 'Tetouan'],
            ['name' => 'Telouet'],
            ['name' => 'Tamatert'],
            ['name' => 'Lalla Takerkoust'],
            ['name' => 'Ouirgane'],
            ['name' => 'Ait Souka'],
            ['name' => 'Tagom'],
            ['name' => 'Oukaimeden'],
            ['name' => 'Imlil'],
            ['name' => 'Ouansakra'],
            ['name' => 'Tahnaout'],
            ['name' => 'Ijoukak'],
            ['name' => 'Asni'],
            ['name' => "Tizi N'Tacheddirt"],
            ['name' => 'Setti Fadma'],
            ['name' => 'Moulay Brahim'],
            ['name' => 'Aroumd'],
            ['name' => 'Marina Smir'],
            ['name' => 'Belyounech'],
            ['name' => 'Arbaa Rasmouka'],
            ['name' => 'Tifnit'],
            ['name' => 'Agdz'],
            ['name' => 'Agadir'],
        ];

        DB::table('cities')->insert($cities);
    }
}
