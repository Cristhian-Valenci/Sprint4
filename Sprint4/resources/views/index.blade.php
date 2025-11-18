<x-app-layout>
    <x-subheader title="Lista de cócteles">
        <x-slot:center>
            <x-sort-select :orden="$orden" :options="[
                'alfabetico' => 'Alfabético (A - Z)',
                'usuario_primero' => 'Mis cócteles primero',
                'usuario_ultimo' => 'Mis cócteles al final'
            ]" />
        </x-slot:center>

        <x-button.cocktail-create />
        <x-button.ingredients />
    </x-subheader>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-2 bg-green-200 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Grid de tarjetas -->
            <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($cocktails as $cocktail)
                    <div class="bg-white shadow rounded-lg p-4 flex flex-col relative h-70 w-64 overflow-hidden">

                        <!-- Botón expandir -->
                        <a href="{{ route('cocktails.show', $cocktail->id) }}"
                           class="absolute top-2 right-2 text-black px-3 py-1 rounded hover:bg-gray-100"
                           title="Expandir">
                            <img src="{{ asset('images/expandir.png') }}" alt="Expandir" class="w-5 h-5 mr-1">
                        </a>

                        <!-- Nombre -->
                        <h2 class="text-xl font-semibold mb-2 truncate" title="{{ $cocktail->nombre }}">
                            {{ $cocktail->nombre }}
                        </h2>

                        <!-- Descripción -->
                        <p class="text-gray-700 mb-2 line-clamp-3">
                            {{ $cocktail->descripcion }}
                        </p>

                        <!-- Método -->
                        <p class="text-gray-600 mb-2 line-clamp-2">
                            <strong>Método:</strong> {{ $cocktail->metodo_elaboracion }}
                        </p>

                        <!-- Ingredientes -->
                        <div class="mb-4">
                            <h3 class="font-medium">Ingredientes:</h3>
                            <ul class="list-disc list-inside line-clamp-3">
                                @foreach ($cocktail->ingredients as $ingredient)
                                    <li>{{ $ingredient->nombre }} 
                                        @if($ingredient->pivot->cantidad)
                                            - {{ $ingredient->pivot->cantidad }} {{ $ingredient->pivot->unidad }}
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Botones solo si es dueño -->
                        @can('update', $cocktail)
                            <div class="flex gap-3 mt-auto justify-start w-full">
                                <a href="{{ route('cocktails.edit', $cocktail->id) }}"
                                   class="text-white px-3 py-1 rounded hover:bg-green-700 inline-flex items-center">
                                    <img src="{{ asset('images/edit-buttom.png') }}" alt="Editar" class="w-5 h-5 mr-1">
                                    Editar
                                </a>

                                <form action="{{ route('cocktails.destroy', $cocktail->id) }}" method="POST" class="inline-flex">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-white px-3 py-1 rounded hover:bg-red-700 flex items-center justify-center"
                                            onclick="return confirm('¿Seguro que deseas eliminar este cóctel?')"
                                            title="Eliminar">
                                        <img src="{{ asset('images/delete-buttom.png') }}" 
                                             alt="Eliminar"
                                             class="w-5 h-5 mr-1">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        @endcan

                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
