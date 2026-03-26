<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Character;

class CharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Character::create([
            'name' => 'Higuruma Hiromi',
            'series' => 'Jujutsu Kaisen',
            'gender' => 'Male',
        ]);

        Character::create([
            'name' => 'Megumi Fushiguro',
            'series' => 'Jujutsu Kaisen',
            'gender' => 'Male',
        ]);

        Character::create([
            'name' => 'Tsukishima kei',
            'series' => ' Haikyuu',
            'gender' => 'Male',
        ]);

        Character::create([
            'name' => 'Vladimir Makarov',
            'series' => 'Call of Duty',
            'gender' => 'Male',
        ]);

        Character::create([
            'name' => 'Andrei Nolan',
            'series' => 'Call of Duty',
            'gender' => 'Male',
        ]);

        Character::create([
            'name' => 'Nanami Kento',
            'series' => 'Jujutsu Kaisen',
            'gender' => 'Male',
        ]);

        Character::create([
            'name' => 'Goku',
            'series' => 'Dragon Ball',
            'gender' => 'Male',
        ]);

        Character::create([
            'name' => 'Vegeta',
            'series' => 'Dragon Ball',
            'gender' => 'Male',
        ]);

        Character::create([
            'name' => 'Vincent Whittman',
            'series' => 'Hazbin Hotel',
            'gender' => 'Male',
        ]);

        Character::create([
            'name' => 'Katsuki Bakugo',
            'series' => 'My Hero Academia',
            'gender' => 'Male',
        ]);
    }
}