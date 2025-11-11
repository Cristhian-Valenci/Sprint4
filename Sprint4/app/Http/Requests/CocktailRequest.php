<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CocktailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
       $this->merge([
          'nombre' => strtolower(trim($this->nombre)),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
   
    public function rules(): array
    {
        $cocktailId = $this->route('cocktail')?->id; // null si es store

        return [
            'nombre' => [
                'required',
                'string',
                'max:100',
                Rule::unique('cocktails', 'nombre')->ignore($cocktailId),
            ],
            'descripcion' => 'required|string',
            'metodo_elaboracion' => 'required|string',
            'ingredients' => 'required|array|min:1', // validar que venga un array y al menos un ingrediente
            'ingredients.*.id'=> 'required|integer|exists:ingredients,id', // cada valor del array debe ser un ID válido de la tabla ingredients
            'ingredients.*.cantidad' => 'required|numeric|min:0',  // cantidad opcional, numérica y >=0
            'ingredients.*.unidad' => 'required|in:cl,ml,oz,dash,unidades,cucharadas',
        ];
    }

    public function messages(): array
{
    return [
        'nombre.required' => 'El nombre del cóctel es obligatorio.',
        'nombre.string' => 'El nombre del cóctel debe ser un texto.',
        'nombre.max' => 'El nombre del cóctel no puede superar los 100 caracteres.',
        'nombre.unique' => 'Ya existe un cóctel con este nombre.',

        'descripcion.string' => 'La descripción debe ser un texto.',
        'metodo_elaboracion.string' => 'El método de elaboración debe ser un texto.',

        'ingredients.required' => 'Debes seleccionar al menos un ingrediente.',
        'ingredients.array' => 'Los ingredientes deben enviarse en forma de lista.',
        'ingredients.min' => 'Debes seleccionar al menos un ingrediente.',

        'ingredients.*.integer' => 'Cada ingrediente debe ser un ID válido.',
        'ingredients.*.exists' => 'El ingrediente seleccionado no existe en la base de datos.',

        'ingredients.*.cantidad.required' => 'Debes indicar la cantidad del ingrediente.',
        'ingredients.*.cantidad.numeric' => 'La cantidad debe ser un número.',
        'ingredients.*.cantidad.min' => 'La cantidad no puede ser negativa.',

        'ingredients.*.unidad.required' => 'Debes indicar la unidad de medida del ingrediente.',
        'ingredients.*.unidad.in' => 'La unidad debe ser una de: cl, ml, oz, dash, unidades o cucharadas.',
    ];
}


}
