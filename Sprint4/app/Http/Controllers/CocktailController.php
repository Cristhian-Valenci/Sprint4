<?php

namespace App\Http\Controllers;

use App\Models\Cocktail;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Http\Requests\CocktailRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CocktailController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $cocktails = Cocktail::with('ingredients')->get();

       return view('index', compact('cocktails')); // con compact envio la variable a la vista

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ingredients = Ingredient::all(); // traemos todos los ingredientes

        return view('cocktails.create', compact('ingredients'));
    }

    public function store(CocktailRequest $request)
    {
   
       $cocktail = new Cocktail();
       $cocktail->nombre = ucfirst($request->nombre); // ponemos la primera letra en mayúscula
       $cocktail->descripcion = $request->descripcion;
       $cocktail->metodo_elaboracion = $request->metodo_elaboracion;
       $cocktail->usuario_id = auth()->id();
       $cocktail->save();

      //Guardamos los ingredientes en la tabla pivote
       $ingredientesData = [];
       foreach ($request->ingredients as $item) { // $request->ingredients es un array de ingredientes, por ejemplo: ['id' => 1, 'cantidad' => 50, 'unidad' => 'ml']
           $ingredientesData[$item['id']] = [
              'cantidad' => $item['cantidad'] ?? null,
              'unidad' => $item['unidad'] ?? null,
            ];
        }

        $cocktail->ingredients()->sync($ingredientesData); // sync guarda la relación muchos a muchos

    
        return redirect()->route('cocktails.index')
                     ->with('success', 'Cóctel creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cocktail $cocktail)
    {
        $cocktail->load('ingredients');
        $cocktails = [$cocktail];

        return view('index', compact('cocktails'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cocktail $cocktail)
    {
        $this->authorize('update', $cocktail);
        
        $cocktail->load('ingredients');
        $allIngredients = Ingredient::all();

        return view('cocktails.edit', compact('cocktail', 'allIngredients'));
    }

    /**
     * Update the specified resource in storage.
     */
   
    public function update(CocktailRequest $request, Cocktail $cocktail)
    {
        $cocktail->update([
              'nombre' => ucfirst($request->nombre),
              'descripcion' => $request->descripcion,
              'metodo_elaboracion' => $request->metodo_elaboracion,
        ]);

        // Actualizar ingredientes en la tabla pivote
        $ingredientesData = [];
        foreach ($request->ingredients as $item) {
            $ingredientesData[$item['id']] = [
                'cantidad' => $item['cantidad'] ?? null,
                'unidad' => $item['unidad'] ?? null,
            ];
        }

        $cocktail->ingredients()->sync($ingredientesData);

        return redirect()->route('cocktails.index')
                         ->with('success', 'Cóctel actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cocktail $cocktail)
    {
       $this->authorize('update', $cocktail);

       $cocktail->delete(); 

      return redirect()->route('cocktails.index') 
                       ->with('success', 'Cóctel eliminado correctamente');
    }
}
