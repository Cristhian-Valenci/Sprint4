<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar cóctel
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- ✅ Mensajes de validación --}}
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
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" name="nombre" id="nombre"
                               value="{{ old('nombre', $cocktail->nombre) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('nombre')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Descripción --}}
                    <div class="mb-4">
                        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea name="descripcion" id="descripcion" rows="4"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('descripcion', $cocktail->descripcion) }}</textarea>
                        @error('descripcion')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Método de elaboración --}}
                    <div class="mb-4">
                        <label for="metodo_elaboracion" class="block text-sm font-medium text-gray-700">Método de elaboración</label>
                        <textarea name="metodo_elaboracion" id="metodo_elaboracion" rows="4"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('metodo_elaboracion', $cocktail->metodo_elaboracion) }}</textarea>
                        @error('metodo_elaboracion')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Ingredientes --}}
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Ingredientes</h3>

                        <div class="space-y-3">
                            @foreach ($allIngredients as $ingredient)
                                @php
                                    $pivot = $cocktail->ingredients->firstWhere('id', $ingredient->id)?->pivot;
                                @endphp
                                <div class="border p-3 rounded-md">
                                    <label class="flex items-center space-x-2">
                                        <input type="checkbox" name="ingredients[{{ $ingredient->id }}][id]"
                                               value="{{ $ingredient->id }}"
                                               {{ $pivot ? 'checked' : '' }}>
                                        <span>{{ $ingredient->nombre }}</span>
                                    </label>

                                    @if ($pivot)
                                        <div class="ml-6 mt-2 grid grid-cols-2 gap-2">
                                            <input type="number" step="any"
                                                   name="ingredients[{{ $ingredient->id }}][cantidad]"
                                                   value="{{ old("ingredients.{$ingredient->id}.cantidad", $pivot->cantidad) }}"
                                                   placeholder="Cantidad"
                                                   class="border-gray-300 rounded-md shadow-sm w-full">
                                            <input type="text"
                                                   name="ingredients[{{ $ingredient->id }}][unidad]"
                                                   value="{{ old("ingredients.{$ingredient->id}.unidad", $pivot->unidad) }}"
                                                   placeholder="Unidad (ml, oz, etc.)"
                                                   class="border-gray-300 rounded-md shadow-sm w-full">
                                        </div>
                                    @else
                                        <div class="ml-6 mt-2 grid grid-cols-2 gap-2">
                                            <input type="number" step="any"
                                                   name="ingredients[{{ $ingredient->id }}][cantidad]"
                                                   placeholder="Cantidad"
                                                   class="border-gray-300 rounded-md shadow-sm w-full">
                                            <input type="text"
                                                   name="ingredients[{{ $ingredient->id }}][unidad]"
                                                   placeholder="Unidad (ml, oz, etc.)"
                                                   class="border-gray-300 rounded-md shadow-sm w-full">
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
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
