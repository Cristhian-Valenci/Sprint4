<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar cóctel
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- Mensajes de validación --}}
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-md">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('cocktails.update', $cocktail->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Nombre --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" name="nombre" value="{{ old('nombre', $cocktail->nombre) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    {{-- Descripción --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea name="descripcion" rows="4"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('descripcion', $cocktail->descripcion) }}</textarea>
                    </div>

                    {{-- Método de elaboración --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Método de elaboración</label>
                        <textarea name="metodo_elaboracion" rows="4"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('metodo_elaboracion', $cocktail->metodo_elaboracion) }}</textarea>
                    </div>

                    {{-- Ingredientes --}}
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Ingredientes</h3>

                        @php
                            $unidades = ['ml', 'oz', 'gr', 'cda', 'cdta'];
                        @endphp

                        @foreach ($cocktail->ingredients as $index => $ingredient)
                            <div class="mb-3 p-3 border rounded-md flex gap-2 items-center">
                                {{-- Select de ingrediente --}}
                                <select name="ingredients[{{ $index }}][id]"
                                        class="border-gray-300 rounded-md w-1/3">
                                    <option value="">Seleccione un ingrediente</option>
                                    @foreach ($allIngredients as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $ingredient->id == $item->id ? 'selected' : '' }}>
                                            {{ $item->nombre }}
                                        </option>
                                    @endforeach
                                </select>

                                {{-- Cantidad --}}
                                <input type="number" step="any"
                                       name="ingredients[{{ $index }}][cantidad]"
                                       value="{{ old("ingredients.$index.cantidad", $ingredient->pivot->cantidad) }}"
                                       placeholder="Cantidad"
                                       class="border-gray-300 rounded-md w-1/4">

                                {{-- Unidad --}}
                                <select name="ingredients[{{ $index }}][unidad]"
                                        class="border-gray-300 rounded-md w-1/4">
                                    <option value="">Unidad</option>
                                    @foreach ($unidades as $unidad)
                                        <option value="{{ $unidad }}"
                                            {{ $ingredient->pivot->unidad == $unidad ? 'selected' : '' }}>
                                            {{ $unidad }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                    </div>

                    {{-- Botones --}}
                    <div class="flex justify-end">
                        <a href="{{ route('cocktails.index') }}" class="text-gray-600 mr-4">Cancelar</a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">
                            Guardar cambios
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
