<?php

namespace App\Http\Controllers;

use App\Models\Cocktail;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Http\Requests\CocktailRequest;

class CocktailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $cocktails = \App\Models\Cocktail::all();

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

    /**
     * Store a newly created resource in storage.
     */
   /*public function store(Request $request)
   {
      // 1️⃣ Validamos los datos del formulario
       $validated = $request->validate([
           'nombre' => 'required|string|max:100',
           'descripcion' => 'required|string',
           'metodo_elaboracion' => 'required|string',
        ]);

      // 2️⃣ Creamos el cóctel asociado al usuario logueado
       $cocktail = new Cocktail();
       $cocktail->nombre = $validated['nombre'];
       $cocktail->descripcion = $validated['descripcion'];
       $cocktail->metodo_elaboracion = $validated['metodo_elaboracion'];
       $cocktail->usuario_id = auth()->id(); // relacionamos el usuario autenticado
       $cocktail->save();

       // 3️⃣ Redirigimos con un mensaje de éxito
       return redirect()->route('cocktails.index')->with('success', 'Cóctel creado correctamente.');
    }*/

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
        $cocktails = [$cocktail];

        return view('index', compact('cocktails'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cocktail $cocktail)
    {
        return view('cocktails.edit', compact('cocktail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cocktail $cocktail)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string',
            'metodo_elaboracion' => 'required|string'
        ]);

        $cocktail->update($validated); //actualizo el coctel ya validado

        return redirect()->route('cocktails.index');
                        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cocktail $cocktail)
    {
       $cocktail->delete(); 

      return redirect()->route('cocktails.index') 
                       ->with('success', 'Cóctel eliminado correctamente');
    }
}
