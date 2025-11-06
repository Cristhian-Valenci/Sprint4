<x-app-layout>
    <x-slot name="header">
        <h2>Crear Cóctel</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <form action="{{ route('cocktails.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" class="border rounded w-full p-2" required>
            </div>

            <div class="mb-4">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" class="border rounded w-full p-2" required></textarea>
            </div>

            <div class="mb-4">
                <label for="metodo_elaboracion">Método de elaboración:</label>
                <textarea id="metodo_elaboracion" name="metodo_elaboracion" class="border rounded w-full p-2" required></textarea>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Guardar
            </button>
        </form>
    </div>
</x-app-layout>


