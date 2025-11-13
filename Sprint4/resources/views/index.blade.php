<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold mb-4">Listado de Cócteles</h1>

            @if(session('success'))
                <div class="mb-4 p-2 bg-green-200 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Grid de tarjetas -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($cocktails as $cocktail)
                    <div class="bg-white shadow rounded-lg p-4 flex flex-col">
                        <h2 class="text-xl font-semibold mb-2">{{ $cocktail->nombre }}</h2>
                        <p class="text-gray-700 mb-2">{{ $cocktail->descripcion }}</p>
                        <p class="text-gray-600 mb-2"><strong>Método:</strong> {{ $cocktail->metodo_elaboracion }}</p>

                        <!-- Ingredientes -->
                        <div class="mb-4">
                            <h3 class="font-medium">Ingredientes:</h3>
                            <ul class="list-disc list-inside">
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
                            <div class="flex gap-2 mt-auto">
                                <a href="{{ route('cocktails.edit', $cocktail->id) }}" 
                                   class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
                                    🖉 Editar
                                </a>

                                <form action="{{ route('cocktails.destroy', $cocktail->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700"
                                        onclick="return confirm('¿Estás seguro de eliminar este cóctel?')">
                                        🗑 Eliminar
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

