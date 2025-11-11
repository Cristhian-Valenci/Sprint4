<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; 

class IngredientRequest extends FormRequest
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
         $ingredientId = $this->route('ingredient')?->id; //creo una variable para tener el mismo request para los 2 metodos, 
                                                          //para cuando edite me deje editar con el nombre que ya tenia y no me de error y me obligue a modificarlo.
        return [
             'nombre' => [
                  'required',
                   'string',
                  'max:100',
                  'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/',
                   Rule::unique('ingredients', 'nombre')->ignore($ingredientId),
                ],
            ];
    }

    public function messages() : array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.unique' => 'El ingrediente ya existe',
            'nombre.regex' => 'El nombre del ingrediente solo puede contener letras y espacios',
            'nombre.max' => 'El nombre no puede tener más de 100 caracteres',
        ];
    }
}
