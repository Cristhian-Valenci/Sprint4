<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ingredients = \App\Models\Ingredient::all();

        return view('ingredients.index', compact('ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ingredients.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([ //merge es una funcion de Laravel que nos permite modificar el request(Osea, el Post, get, etc que haya enviado el usuario) antes de validarlo.
           'nombre' => strtolower(trim($request->nombre))
        ]);

        $validated = $request->validate([
           'nombre' => 'required|string|max:100'
        ]);

        $duplicated = Ingredient::where('nombre', $validated['nombre'])->exists();

        if ($duplicated) {
            return redirect()->route('ingredients.index')->with('error', 'El ingrediente ya existe');
        }

        $ingredient = New Ingredient();
        $ingredient->nombre = ucfirst($validated['nombre']); //con ucfirst, hacemos que todos los nombres se guarden con mayuscula al princio, que antes le sacamos para comparar los nombres y para que quede mas prolija la web y base de datos
        $ingredient->save();

        return redirect()->route('ingredients.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ingredient $ingredient)
    {
        $ingredients = [$ingredient];

        return view('ingredient.index', compact('ingredients'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ingredient $ingredient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ingredient $ingredient)
    {
        //
    }
}
