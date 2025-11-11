<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold mb-4">Listado de Cócteles</h1>

            @if(session('success'))
                <div class="mb-4 p-2 bg-green-200 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <table class="min-w-full border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Nombre</th>
                        <th class="px-4 py-2 border">Descripción</th>
                        <th class="px-4 py-2 border">Método</th>
                        <th class="px-4 py-2 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cocktails as $cocktail)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $cocktail->id }}</td>
                            <td class="px-4 py-2 border">{{ $cocktail->nombre }}</td>
                            <td class="px-4 py-2 border">{{ $cocktail->descripcion }}</td>
                            <td class="px-4 py-2 border">{{ $cocktail->metodo_elaboracion }}</td>
                            <td class="px-4 py-2 border flex gap-2">
                                <!-- Botón de Editar -->
                                <a href="{{ route('cocktails.edit', $cocktail->id) }}" 
                                   class="px-2 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
                                    🖉 Editar
                                </a>

                                <!-- Botón de Eliminar -->
                                <form action="{{ route('cocktails.destroy', $cocktail->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700"
                                        onclick="return confirm('¿Estás seguro de eliminar este cóctel?')">
                                        🗑 Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

>>>>>>> Stashed changes
