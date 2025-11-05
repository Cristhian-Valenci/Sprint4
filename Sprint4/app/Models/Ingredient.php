<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model {
    
    public $timestamps = false;
    

    public function cocktails() {
      
        return $this->belongsToMany(Cocktail::class, 'cocktail_ingredient')
                  ->withPivot('cantidad', 'unidad');
    }

}
