<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Http\Requests\IngredientRequest;


class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $orden = $request->get('orden', 'usuario_primero'); 
    $userId = auth()->id();

    // Base query con columna "es_del_usuario"
    $ingredients = Ingredient::select('ingredients.*')
        ->selectRaw("
            EXISTS (
                SELECT 1 
                FROM cocktail_ingredient ci
                JOIN cocktails c ON c.id = ci.cocktail_id
                WHERE ci.ingredient_id = ingredients.id
                AND c.usuario_id = ?
            ) AS es_del_usuario
        ", [$userId]);

    // Tipos de orden
    if ($orden === 'alfabetico') {
        $ingredients = $ingredients->orderBy('nombre', 'asc');
    }
    elseif ($orden === 'usuario_ultimo') {
        // primero los que NO son del usuario
        $ingredients = $ingredients->orderBy('es_del_usuario', 'asc')
                                   ->orderBy('nombre', 'asc');
    }
    else { // usuario_primero
        // primero los que son del usuario
        $ingredients = $ingredients->orderBy('es_del_usuario', 'desc')
                                   ->orderBy('nombre', 'asc');
    }

    $ingredients = $ingredients->get();

    return view('ingredients.index', compact('ingredients', 'orden'));
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
    public function store(IngredientRequest $request)
    {
          
        $ingredient = New Ingredient();
        $ingredient->nombre = ucfirst($request->nombre); //con ucfirst, hacemos que todos los nombres se guarden con mayuscula al princio, que antes le sacamos para comparar los nombres y para que quede mas prolija la web y base de datos
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
        $this->authorize('update', $ingredient); //para que solo el usuario pueda editar sus ingredientes siempre que no se esten usando en otros cocteles

        return view('ingredients.index', compact('ingredient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IngredientRequest $request, Ingredient $ingredient)
    {
        $nombre = ucfirst($request->nombre);

        $ingredient->update([
            'nombre' => $nombre
        ]);

        return redirect()->route('ingredients.index')
                         ->with('success', 'Ingrediente editado correctamente');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ingredient $ingredient)
    {
        $this->authorize('delete', $ingredient);

        $ingredient->delete();

        return redirect()->route('ingredients.index')
                         ->with('success', 'Ingrediente eliminado correctamente');

    }
}
