<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;

class CharacterController extends Controller
{
    public function index()
    {
        $characters = Character::all();

        return response()->json([
            'data' => $characters
        ], 200);
    }

    public function store(Request $request)
    {
        $character = Character::create($request->all());

        return response()->json([
            'data' => $character,
            'message' => 'personaje creado correctamente'
        ], 201);
    }

    public function show($id)
    {
        $character = Character::findOrFail($id);

        return response()->json([
            'data' => $character
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $character = Character::findOrFail($id);
        $character->update($request->all());
        return response()->json([
            'data' => $character,
            'message' => 'personaje actualizado correctamente'
        ], 200);
    }

    public function destroy($id)
    {
        $character = Character::findOrFail($id);
        $character->delete();

        return response()->json([
            'message' => 'personaje eliminado correctamente'
        ], 200);
    }
}