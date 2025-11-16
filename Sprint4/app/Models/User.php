<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function sendPasswordResetNotification($token)
    {
       $this->notify(new \App\Notifications\ResetPasswordCustom($token));
    }


   
    protected static function booted()
    {
         static::deleting(function ($user) {
         // 1️⃣ Borrar todos los cócteles del usuario
           $user->cocktails()->delete();

         // 2️⃣ Borrar ingredientes solo si no los usan otros usuarios
            foreach ($user->ingredients as $ingredient) {
               // Revisamos si el ingrediente está en algún cóctel que NO sea del usuario
               $usedByOther = $ingredient->cocktails
                                       ->where('usuario_id', '!=', $user->id)
                                       ->count() > 0;

              if (!$usedByOther) {
                 $ingredient->delete();
                }
            }
        });
    }



    public function cocktails() {
      return $this->hasMany(Cocktail::class, 'usuario_id');
    }

}
