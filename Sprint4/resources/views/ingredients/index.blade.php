<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold mb-4">Listado de Ingredientes</h1>

            @if(session('success'))
                <div class="mb-4 p-2 bg-green-200 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                 <div class="mb-4 p-2 bg-red-200 text-red-800 rounded">
                      <ul>
                          @foreach ($errors->all() as $error)
                               <li>{{ $error }}</li>
                            @endforeach
                         </ul>
                 </div>
            @endif

            <table class="min-w-full border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                      
                        <th class="px-4 py-2 border">Nombre</th>                        
                        <th class="px-4 py-2 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ingredients as $ingredient)
                        <tr class="hover:bg-gray-50">
                       
                            <td class="px-4 py-2 border">
                                <form action="{{ route('ingredients.update', $ingredient->id) }}" method="POST" class="flex gap-2">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="nombre" value="{{ $ingredient->nombre }}" required
                                        class="border px-2 py-1 rounded" />
                                    <button type="submit"
                                        class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">💾</button>
                                </form>
                            </td>
                            <td class="px-4 py-2 border">
                                <form action="{{ route('ingredients.destroy', $ingredient->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700"
                                        onclick="return confirm('¿Estás seguro de eliminar este ingrediente?')">
                                        🗑
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Formulario para agregar un nuevo ingrediente -->
            <form action="{{ route('ingredients.store') }}" method="POST" class="flex gap-2 mt-4">
                @csrf
                <input type="text" name="nombre" placeholder="Nuevo Ingrediente" required
                    class="flex-grow border px-3 py-2 rounded bg-gray-50" />
                <button type="submit"
                    class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">Agregar</button>
            </form>
        </div>
    </div>
</x-app-layout>
