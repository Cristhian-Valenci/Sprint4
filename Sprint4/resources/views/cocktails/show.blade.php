<x-app-layout>
    <x-subheader title="Ver cóctel">
        <x-button.cocktail-create />
        <x-button.ingredients />
    </x-subheader>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- NOMBRE --}}
                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Nombre</h2>
                    <p class="mt-1 text-gray-700 border p-2 rounded bg-gray-50">
                        {{ $cocktail->nombre }}
                    </p>
                </div>

                {{-- DESCRIPCIÓN --}}
                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Descripción</h2>
                    <p class="mt-1 text-gray-700 border p-2 rounded bg-gray-50 whitespace-pre-line break-words">
                       {{ $cocktail->descripcion }}
                    </p>

                </div>

                {{-- MÉTODO --}}
                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Método de elaboración</h2>
                    <p class="mt-1 text-gray-700 border p-2 rounded bg-gray-50 whitespace-pre-line break-words">
                        {{ $cocktail->metodo_elaboracion }}
                    </p>
                </div>

                {{-- INGREDIENTES --}}
                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Ingredientes</h2>

                    <div class="mt-2 space-y-2">
                        @foreach ($cocktail->ingredients as $ingredient)
                            <div class="flex items-center gap-4 border p-2 rounded bg-gray-50">

                                {{-- Nombre --}}
                                <span class="font-medium text-gray-800">
                                    {{ $ingredient->nombre }}
                                </span>

                                {{-- Cantidad --}}
                                @if ($ingredient->pivot->cantidad)
                                    <span class="text-gray-600">
                                        {{ $ingredient->pivot->cantidad }}
                                    </span>
                                @endif

                                {{-- Unidad --}}
                                @if ($ingredient->pivot->unidad)
                                    <span class="text-gray-500">
                                        {{ $ingredient->pivot->unidad }}
                                    </span>
                                @endif
                            </div>
                        @endforeach

                        @if ($cocktail->ingredients->isEmpty())
                            <p class="text-gray-500">No se han cargado ingredientes.</p>
                        @endif
                    </div>
                </div>

                 @can('update', $cocktail)
                    <div class="flex gap-3 mt-6 justify-start w-full">
                        
                        <a href="{{ route('cocktails.edit', $cocktail->id) }}"
                           class="text-white px-3 py-1 rounded hover:bg-green-700 inline-flex items-center">
                          <img src="{{ asset('images/edit-buttom.png') }}" alt="Editar" class="w-5 h-5 mr-1">
                           Editar
                        </a>


                        <form action="{{ route('cocktails.destroy', $cocktail->id) }}" method="POST">
                           @csrf
                           @method('DELETE')
                           <button type="submit"
                              class="text-white px-3 py-1 rounded hover:bg-red-700 flex items-center justify-center"
                              onclick="return confirm('¿Seguro que deseas eliminar este cóctel?')"
                              title="Eliminar">
                              <img src="{{ asset('images/delete-buttom.png') }}" 
                              alt="Eliminar"
                              class="w-5 h-5">
                              Eliminar
                            </button>
                        </form>
                    </div>
                @endcan

            </div>

        </div>
    </div>
</x-app-layout>
