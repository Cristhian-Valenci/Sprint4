<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cocktail extends Model {
    
    public $timestamps = false;

    public function usuario() {
      
        return $this->belongsTo(User::class, 'usuario_id'); //belongTo significa que cada Cocktail pertenece a un usuario
    }

    public function ingredients() {
     
        return $this->belongsToMany(Ingredient::class, 'cocktail_ingredient') //belongsToMany es la relacion muchos a muchos
                    ->withPivot('cantidad', 'unidad'); // aqui pongo que ademas esta tabla tiene columnas extras ademas de las relaciones
    }


}
