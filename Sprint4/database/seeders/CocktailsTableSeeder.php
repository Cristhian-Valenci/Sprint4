<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Cocktail;
use App\Models\Ingredient;

class CocktailsTableSeeder extends Seeder
{
    public function run(): void
    {
        $user = \App\Models\User::firstOrCreate(
           ['email' => 'ceo@ceo.com'],
           [
              'name' => 'CEO',
              'password' => bcrypt('password'),
           ]
        );

        // 2️⃣ Lista de cócteles base
        $cocktails = [
            [
                'nombre' => 'Mojito',
                'descripcion' => 'Cóctel cubano refrescante con menta, lima y ron.',
                'metodo' => 'Machacar la menta, mezclar con ron, hielo y soda.',
                'ingredientes' => [
                    ['nombre' => 'Ron blanco', 'cantidad' => 50, 'unidad' => 'ml'],
                    ['nombre' => 'Zumo de lima', 'cantidad' => 30, 'unidad' => 'ml'],
                    ['nombre' => 'Azúcar', 'cantidad' => 2, 'unidad' => 'cucharadas'],
                    ['nombre' => 'Menta', 'cantidad' => 10, 'unidad' => 'unidades'],
                    ['nombre' => 'Soda', 'cantidad' => 100, 'unidad' => 'ml'],
                ],
            ],
            [
                'nombre' => 'Aperol Spritz',
                'descripcion' => 'Clásico italiano refrescante y ligero.',
                'metodo' => 'Mezclar Aperol, prosecco y un chorrito de soda.',
                'ingredientes' => [
                    ['nombre' => 'Aperol', 'cantidad' => 60, 'unidad' => 'ml'],
                    ['nombre' => 'Prosseco', 'cantidad' => 90, 'unidad' => 'ml'],
                    ['nombre' => 'Soda', 'cantidad' => 30, 'unidad' => 'ml'],
                ],
            ],
            [
                'nombre' => 'Negroni',
                'descripcion' => 'Amargo e intenso, perfecto como aperitivo.',
                'metodo' => 'Mezclar partes iguales de gin, vermouth rosso y campari.',
                'ingredientes' => [
                    ['nombre' => 'Ginebra', 'cantidad' => 30, 'unidad' => 'ml'],
                    ['nombre' => 'Vermouth Rosso', 'cantidad' => 30, 'unidad' => 'ml'],
                    ['nombre' => 'Campari', 'cantidad' => 30, 'unidad' => 'ml'],
                ],
            ],       
            [
                'nombre' => 'Cosmopolitan',
                'descripcion' => 'Cóctel elegante y frutal.',
                'metodo' => 'Agitar vodka, triple sec, zumo de arándanos y lima.',
                'ingredientes' => [
                    ['nombre' => 'Vodka', 'cantidad' => 40, 'unidad' => 'ml'],
                    ['nombre' => 'Triple Sec', 'cantidad' => 15, 'unidad' => 'ml'],
                    ['nombre' => 'Zumo de arándanos', 'cantidad' => 30, 'unidad' => 'ml'],
                    ['nombre' => 'Zumo de lima', 'cantidad' => 10, 'unidad' => 'ml'],
                ],
            ],
            [
                'nombre' => 'Whiskey Sour',
                'descripcion' => 'Clásico con whiskey y limón.',
                'metodo' => 'Agitar whiskey, zumo de limón y azúcar con hielo.',
                'ingredientes' => [
                   ['nombre' => 'Whiskey', 'cantidad' => 50, 'unidad' => 'ml'], 
                   ['nombre' => 'Zumo de limón', 'cantidad' => 30, 'unidad' => 'ml'],
                   ['nombre' => 'Azúcar', 'cantidad' => 2, 'unidad' => 'cucharadas'],
                ],
            ],
            [
                'nombre' => 'Margarita',
                'descripcion' => 'Clásico mexicano con tequila y lima.',
                'metodo' => 'Agitar tequila, triple sec y zumo de lima con hielo.',
                'ingredientes' => [
                   ['nombre' => 'Tequila', 'cantidad' => 50, 'unidad' => 'ml'],
                   ['nombre' => 'Triple Sec', 'cantidad' => 20, 'unidad' => 'ml'],
                   ['nombre' => 'Zumo de lima', 'cantidad' => 30, 'unidad' => 'ml'],
                ],
            ],
            [
                'nombre' => 'Daiquiri',
                'descripcion' => 'Refrescante, simple y clásico.',
                'metodo' => 'Agitar ron, zumo de limón y azúcar con hielo.',
                'ingredientes' => [
                    ['nombre' => 'Ron blanco', 'cantidad' => 50, 'unidad' => 'ml'],
                    ['nombre' => 'Zumo de limón', 'cantidad' => 25, 'unidad' => 'ml'],
                    ['nombre' => 'Azúcar', 'cantidad' => 2, 'unidad' => 'cucharadas'],
                ],
            ],
            [
                'nombre' => 'Gin Tonic',
                'descripcion' => 'Clásico refrescante de ginebra y tónica.',
                'metodo' => 'Servir ginebra con hielo y completar con tónica.',
                'ingredientes' => [
                    ['nombre' => 'Ginebra', 'cantidad' => 50, 'unidad' => 'ml'],
                    ['nombre' => 'Tonica', 'cantidad' => 150, 'unidad' => 'ml'],
                ],
            ],
            [
                'nombre' => 'Cuba Libre',
                'descripcion' => 'Refrescante con ron y cola.',
                'metodo' => 'Servir ron con Coca Cola y hielo, añadir lima.',
                'ingredientes' => [
                    ['nombre' => 'Ron blanco', 'cantidad' => 50, 'unidad' => 'ml'],
                    ['nombre' => 'Coca Cola', 'cantidad' => 120, 'unidad' => 'ml'],
                    ['nombre' => 'Zumo de lima', 'cantidad' => 10, 'unidad' => 'ml'],
                ],
            ],
            [
                'nombre' => 'Bloody Mary',
                'descripcion' => 'Cóctel clásico de vodka y tomate.',
                'metodo' => 'Mezclar vodka, zumo de tomate, limón y especias.',
                'ingredientes' => [
                    ['nombre' => 'Vodka', 'cantidad' => 50, 'unidad' => 'ml'],
                    ['nombre' => 'Zumo de limón', 'cantidad' => 15, 'unidad' => 'ml'],
                    ['nombre' => 'Azúcar', 'cantidad' => 1, 'unidad' => 'cucharadas'], 
                    ['nombre' => 'Zumo de tomate', 'cantidad' => 120, 'unidad' => 'ml'], 
                    ['nombre' => 'Salsa Perrins', 'cantidad' => 1, 'unidad' => 'cucharadas'], 
                    ['nombre' => 'Sal', 'cantidad' => 1, 'unidad' => 'cucharadas'], 
                    ['nombre' => 'Pimienta', 'cantidad' => 1, 'unidad' => 'cucharadas'], 
                ],
            ],
            [
                'nombre' => 'Mai Tai',
                'descripcion' => 'Exótico, frutal y con ron.',
                'metodo' => 'Mezclar rones, triple sec, almendra y lima.',
                'ingredientes' => [
                   ['nombre' => 'Ron blanco', 'cantidad' => 30, 'unidad' => 'ml'],
                   ['nombre' => 'Ron oscuro', 'cantidad' => 30, 'unidad' => 'ml'],
                   ['nombre' => 'Triple Sec', 'cantidad' => 15, 'unidad' => 'ml'],
                   ['nombre' => 'Zumo de lima', 'cantidad' => 15, 'unidad' => 'ml'],
                   ['nombre' => 'Azúcar', 'cantidad' => 1, 'unidad' => 'cucharadas'],
                ],
            ],
            [
                'nombre' => 'Tequila Sunrise',
                'descripcion' => 'Cóctel colorido con tequila y naranja.',
                'metodo' => 'Servir tequila, zumo de naranja y granadina.',
                'ingredientes' => [
                    ['nombre' => 'Tequila', 'cantidad' => 50, 'unidad' => 'ml'],
                    ['nombre' => 'Zumo de naranja', 'cantidad' => 100, 'unidad' => 'ml'],
                    ['nombre' => 'Azúcar', 'cantidad' => 1, 'unidad' => 'cucharadas'], 
                ],
            ],
            [
                'nombre' => 'Pisco Sour',
                'descripcion' => 'Cóctel peruano con pisco y limón.',
                'metodo' => 'Agitar pisco, zumo de limón y azúcar con clara de huevo.',
                'ingredientes' => [
                   ['nombre' => 'Pisco', 'cantidad' => 50, 'unidad' => 'ml'], 
                   ['nombre' => 'Zumo de limón', 'cantidad' => 30, 'unidad' => 'ml'],
                   ['nombre' => 'Azúcar', 'cantidad' => 2, 'unidad' => 'cucharadas'],
                ],
            ],
            [
                'nombre' => 'Caipirinha',
                'descripcion' => 'Cóctel brasileño con cachaca y lima.',
                'metodo' => 'Machacar lima con azúcar, añadir cachaca y hielo.',
                'ingredientes' => [
                    ['nombre' => 'Cachaca', 'cantidad' => 50, 'unidad' => 'ml'],
                    ['nombre' => 'Zumo de lima', 'cantidad' => 30, 'unidad' => 'ml'],
                    ['nombre' => 'Azúcar', 'cantidad' => 2, 'unidad' => 'cucharadas'],
                ],
            ],
            [
                'nombre' => 'Moscow Mule',
                'descripcion' => 'Refrescante, con vodka y ginger beer.',
                'metodo' => 'Servir vodka con ginger beer y zumo de lima sobre hielo.',
                'ingredientes' => [
                    ['nombre' => 'Vodka', 'cantidad' => 50, 'unidad' => 'ml'],
                    ['nombre' => 'Ginger beer', 'cantidad' => 120, 'unidad' => 'ml'],
                    ['nombre' => 'Zumo de lima', 'cantidad' => 15, 'unidad' => 'ml'],
                ],
            ],
       ];


        // 3️⃣ Crear cócteles
        foreach ($cocktails as $data) {

            // Evitar duplicados
            $cocktail = Cocktail::firstOrCreate(
                [
                    'nombre' => $data['nombre'],
                    'usuario_id' => $user->id,
                ],
                [
                    'descripcion' => $data['descripcion'],
                    'metodo_elaboracion' => $data['metodo'],
                ]
            );

            // 4️⃣ Asociar ingredientes
               foreach ($data['ingredientes'] as $ing) {
                  $ingredient = Ingredient::where('nombre', $ing['nombre'])->first();

                    if ($ingredient) {
                      // Mapa de correcciones de unidades
                      $unidadCorrecciones = [
                           'cucharada' => 'cucharadas',
                            // puedes agregar más aquí si hace falta
                        ];

                           // Normalizar unidad
                       $unidad = $ing['unidad'];
                       if (isset($unidadCorrecciones[$unidad])) {
                          $unidad = $unidadCorrecciones[$unidad];
                        }

                        $cocktail->ingredients()->syncWithoutDetaching([
                        $ingredient->id => [
                           'cantidad' => $ing['cantidad'],
                           'unidad' => $unidad,
                        ],
                   ]);
                }
                }

        }

        $this->command->info('Cócteles creados correctamente.');
    }
}
