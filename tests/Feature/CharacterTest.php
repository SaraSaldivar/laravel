<?php

namespace Tests\Feature;

use App\Models\Character;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Seeders\CharacterSeeder;


    uses(RefreshDatabase::class);

    beforeEach(function () {
        $this->seed(CharacterSeeder::class);
    });

    test('todos los personajes', function () {
        $this->getJson('/api/characters')
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'series', 'gender'] 
                ]
            ]); 
    });

    test('un personaje', function () {
        $character = Character::query()->firstOrFail();

        $this->getJson('/api/characters/' . $character->id)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $character->id,
                    'name' => $character->name,
                    'series' => $character->series,
                    'gender' => $character->gender,
                ]
            ]);
    });

    test('crear personaje', function () {
        $data = [
            'name' => 'Izuku Midoriya',
            'series' => 'My Hero Academia',
            'gender' => 'Male',
        ];

        $this->postJson('/api/characters', $data)
            ->assertStatus(201)
            ->assertJson([
                'data' => $data,
                'message' => 'personaje creado correctamente'
            ]);
    });

    test('actualizar personaje', function () {
        $character = Character::query()->firstOrFail();

        $data = [
            'name' => 'Eren Jaeger',
            'series' => 'Attack on Titan',
            'gender' => 'Male',
        ];

        $this->putJson('/api/characters/' . $character->id, $data)
            ->assertStatus(200)
            ->assertJson([
                'data' => array_merge(['id' => $character->id], $data),
                'message' => 'personaje actualizado correctamente'
            ]);
    });

    test('eliminar personaje', function () {
        $character = Character::query()->firstOrFail();

        $this->deleteJson('/api/characters/' . $character->id)
            ->assertStatus(200)
            ->assertJson([
                'message' => 'personaje eliminado correctamente'
            ]);

        $this->getJson('/api/characters/' . $character->id)
            ->assertStatus(404);
    });

    test('es un objeto', function(){
        $character = Character::first();
    
        $this->getJson('/api/characters' .  $character->id)
        ->assertJsonIsObject()

    });

    test('estructura exacta', function (){
    $data=['id' => $character->id, 'name' => $character->name, 'series' => $character->series, 'gender' => $character->gender];
    $response = $this->postJson('/api/characters/', $data);
    $response->assertExactJson([
        'data' => $data,
        'message' => 'personaje creado correctamente'
    ]);
    });