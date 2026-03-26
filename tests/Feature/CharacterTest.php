<?php

use App\Models\Character;
use Database\Seeders\CharacterSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

  beforeEach(function () {
    $this->seed(CharacterSeeder::class);
   });

  test('index devuelve 200', function () {
    $this->getJson('/api/characters')
        ->assertStatus(200);
  });

   test('index regresa data como arreglo', function () {
    $this->getJson('/api/characters')
        ->assertStatus(200)
        ->assertJsonIsArray('data');
  });

   test('index tiene la estructura esperada', function () {
    $this->getJson('/api/characters')
        ->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'name', 'series', 'gender'],
            ],
        ]);
  });

    test('index contiene un fragmento esperado', function () {
    $character = Character::firstOrFail();

    $this->getJson('/api/characters')
        ->assertStatus(200)
        ->assertJsonFragment([
            'name' => $character->name,
            'series' => $character->series,
            'gender' => $character->gender,
        ]);
  });

  test('show devuelve 200', function () {
    $character = Character::firstOrFail();

    $this->getJson('/api/characters/' . $character->id)
        ->assertStatus(200);
   });

  test('show regresa un objeto', function () {
    $character = Character::firstOrFail();

    $this->getJson('/api/characters/' . $character->id)
        ->assertStatus(200)
        ->assertJsonIsObject('data');
     });

  test('show regresa el json exacto', function () {
    $character = Character::firstOrFail();

     $this->getJson('/api/characters/' . $character->id)
        ->assertStatus(200)
        ->assertJson([
            'data' => [
                'id' => $character->id,
                'name' => $character->name,
                'series' => $character->series,
                'gender' => $character->gender,
            ],
        ]);
   });

   test('show de un personaje q no existe regresa 404', function () {
    $this->getJson('/api/characters/99')
        ->assertStatus(404);
  });

   test('store regresa 201', function () {
    $data = [
        'name' => 'Izuku Midoriya',
        'series' => 'My Hero Academia',
        'gender' => 'Male',
    ];

    $this->postJson('/api/characters', $data)
        ->assertStatus(201);
   });

   test('store regresa json esperado', function () {
    $data = [
        'name' => 'Izuku Midoriya',
        'series' => 'My Hero Academia',
        'gender' => 'Male',
    ];

    $this->postJson('/api/characters', $data)
        ->assertStatus(201)
        ->assertJson([
            'data' => $data,
            'message' => 'personaje creado correctamente',
        ]);
  });

  test('store tiene un fragmento esperado', function () {
    $data = [
        'name' => 'Tanjiro Kamado',
        'series' => 'Demon Slayer',
        'gender' => 'Male',
    ];

    $this->postJson('/api/characters', $data)
        ->assertStatus(201)
        ->assertJsonFragment([
            'name' => 'Tanjiro Kamado',
            'series' => 'Demon Slayer',
            'gender' => 'Male',
            'message' => 'personaje creado correctamente',
        ]);
 });

  test('update regresa 200', function () {
    $character = Character::firstOrFail();

    $data = [
        'name' => 'Eren Jaeger',
        'series' => 'Attack on Titan',
        'gender' => 'Male',
    ];

    $this->putJson('/api/characters/' . $character->id, $data)
        ->assertStatus(200);
  });

    test('update regresa json esperado', function () {

    $character = Character::firstOrFail();

    $data = [
        'name' => 'Eren Jaeger',
        'series' => 'Attack on Titan',
        'gender' => 'Male',
    ];

    $this->putJson('/api/characters/' . $character->id, $data)
        ->assertStatus(200)
        ->assertJson([
            'data' => array_merge(['id' => $character->id], $data),
            'message' => 'personaje actualizado correctamente',
        ]);
  });

   test('delete regresa mensaje esperado', function () {
    $character = Character::firstOrFail();

    $this->deleteJson('/api/characters/' . $character->id)
        ->assertStatus(200)
        ->assertJson([
            'message' => 'personaje eliminado correctamente',
        ]);
   });

   test('delete elimina el personaje y regresa 404 al buscarlo', function () {
    $character = Character::firstOrFail();

    $this->deleteJson('/api/characters/' . $character->id)
        ->assertStatus(200);

    $this->getJson('/api/characters/' . $character->id)
        ->assertStatus(404);
  });