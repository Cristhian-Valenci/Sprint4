<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold mb-4">Listado de Ingredientes</h1>

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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ingredients as $ingredient)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $ingredient->id }}</td>
                            <td class="px-4 py-2 border">{{ $ingredient->nombre }}</td>
                            <td class="px-4 py-2 border flex gap-2">
                           
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
