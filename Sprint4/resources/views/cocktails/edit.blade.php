<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar cóctel
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('cocktails.update', $cocktail->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" name="nombre" id="nombre"
                               value="{{ old('nombre', $cocktail->nombre) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea name="descripcion" id="descripcion" rows="4"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('descripcion', $cocktail->descripcion) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="metodo_elaboracion" class="block text-sm font-medium text-gray-700">Método de elaboración</label>
                        <textarea name="metodo_elaboracion" id="metodo_elaboracion" rows="4"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('metodo_elaboracion', $cocktail->metodo_elaboracion) }}</textarea>
                    </div>

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
