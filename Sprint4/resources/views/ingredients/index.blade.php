<x-app-layout>
   <x-subheader title="Ingredientes">
        <x-slot:center>
           <x-sort-select :orden="$orden" :options="[
            'alfabetico' => 'Alfabético (A - Z)',
            'usuario_primero' => 'Mis ingredientes primero',
            'usuario_ultimo' => 'Mis ingredientes al final'
            ]" />
        </x-slot:center>
        
        <x-button.back />
    </x-subheader>


    <div class="py-6">
        <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow sm:px-6 lg:px-8">

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

            <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 border">Nombre</th>
                        <th class="px-4 py-2 border w-32 text-center">Editar/Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ingredients as $ingredient)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">

                                @can('update', $ingredient)
                                    <!-- FORM REAL QUE EDITA -->
                                    <form id="edit-form-{{ $ingredient->id }}"
                                          action="{{ route('ingredients.update', $ingredient->id) }}"
                                          method="POST">
                                        @csrf
                                        @method('PUT')

                                        <!-- Mantener orden -->
                                        <input type="hidden" name="orden" value="{{ $orden }}">

                                        <input type="text" name="nombre"
                                            value="{{ $ingredient->nombre }}"
                                            required
                                            class="border px-2 py-1 rounded w-full" />
                                    </form>
                                @else
                                    {{ $ingredient->nombre }}
                                @endcan

                            </td>

                            <td class="px-4 py-2 border text-center">
                                <div class="flex justify-center gap-2">

                                    @can('update', $ingredient)
                                        <!-- Botón que envía el form del input -->
                                        <button type="submit"
                                            form="edit-form-{{ $ingredient->id }}"
                                            class="text-white px-3 py-1 rounded hover:bg-green-700">

                                            <img src="{{ asset('images/edit-buttom.png') }}" 
                                                 alt="Editar"
                                                 class="w-5 h-5">
                                        </button>
                                    @endcan

                                    @can('delete', $ingredient)
                                        <form action="{{ route('ingredients.destroy', $ingredient->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <!-- Mantener orden -->
                                            <input type="hidden" name="orden" value="{{ $orden }}">

                                            <button type="submit"
                                               class="text-white px-3 py-1 rounded hover:bg-red-700 flex items-center justify-center"
                                               onclick="return confirm('¿Eliminar este ingrediente?')">

                                               <img src="{{ asset('images/delete-buttom.png') }}" 
                                               alt="Eliminar"
                                               class="w-5 h-5">   
                                            </button>

                                        </form>
                                    @endcan

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
             {{ $ingredients->links() }}
            </div>


            <!-- Formulario para agregar nuevo ingrediente -->
            <form action="{{ route('ingredients.store') }}" method="POST" class="flex gap-2 mt-4">
                @csrf
                <input type="text" name="nombre" placeholder="Nuevo ingrediente" required
                    class="flex-grow border px-3 py-2 rounded bg-gray-50" />
                <button type="submit"
                    class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800">
                    Agregar
                </button>
            </form>

        </div>
    </div>
</x-app-layout>
