<?php

namespace App\Http\Controllers;

use App\Models\Cocktail;
use Illuminate\Http\Request;

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
        return view('cocktails.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
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
