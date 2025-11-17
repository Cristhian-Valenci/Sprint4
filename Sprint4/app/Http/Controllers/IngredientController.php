<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Http\Requests\IngredientRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class IngredientController extends Controller
{
    use AuthorizesRequests; 
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       $orden = $request->get('orden', 'usuario_primero'); // valor por defecto
       $userId = auth()->id();

       
       $ingredientsQuery = \App\Models\Ingredient::query();

       // Orden según la opción seleccionada
       if ($orden === 'alfabetico') {
          $ingredientsQuery->orderBy('nombre', 'asc');
        } elseif ($orden === 'usuario_ultimo') {
           $ingredientsQuery->orderByRaw("CASE WHEN user_id = ? THEN 1 ELSE 0 END ASC", [$userId])
                         ->orderBy('nombre');
        } else { 
          $ingredientsQuery->orderByRaw("CASE WHEN user_id = ? THEN 1 ELSE 0 END DESC", [$userId])
                         ->orderBy('nombre');
        }

    
        $ingredients = $ingredientsQuery->paginate(10)->withQueryString();

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
        $ingredient->user_id = auth()->id();
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

        return redirect()->route('ingredients.index', ['orden' => $request->orden])
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
