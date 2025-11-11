<x-app-layout>
    <x-slot name="header">
        <h2>Crear Cóctel</h2>
    </x-slot>

    @if ($errors->any())
    <div class="mb-4 p-2 bg-red-200 text-red-800 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
     @endif
     @if(session('success'))
    <div class="mb-4 p-2 bg-green-200 text-green-800 rounded">
        {{ session('success') }}
    </div>
     @endif



    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <form action="{{ route('cocktails.store') }}" method="POST">
            @csrf

            <!-- Nombre del cóctel -->
            <div class="mb-4">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" class="border rounded w-full p-2" required>
            </div>

            <!-- Descripción -->
            <div class="mb-4">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" class="border rounded w-full p-2" ></textarea>
            </div>

            <!-- Método de elaboración -->
            <div class="mb-4">
                <label for="metodo_elaboracion">Método de elaboración:</label>
                <textarea id="metodo_elaboracion" name="metodo_elaboracion" class="border rounded w-full p-2" ></textarea>
            </div>

            <!-- Ingredientes -->
            <div class="mb-4">
                <label>Ingredientes:</label>
                <div id="ingredientes-container">

                    <div class="ingrediente-row mb-2 flex gap-2">
                        <select name="ingredients[0][id]" class="border rounded p-2" required>
                            <option value="">Selecciona un ingrediente</option>
                            @foreach($ingredients as $ingredient)
                                <option value="{{ $ingredient->id }}">{{ $ingredient->nombre }}</option>
                            @endforeach
                        </select>

                        <input type="number" name="ingredients[0][cantidad]" class="border rounded p-2 w-24" placeholder="Cantidad" min="0" step="any">

                        <select name="ingredients[0][unidad]" class="border rounded p-2 w-32">
                            <option value="">Unidad</option>
                            <option value="cl">cl</option>
                            <option value="ml">ml</option>
                            <option value="oz">oz</option>
                            <option value="dash">dash</option>
                            <option value="unidades">unidades</option>
                            <option value="cucharadas">cucharadas</option>
                        </select>

                        <button type="button" class="remove-ingrediente bg-red-500 text-white px-2 rounded">Eliminar</button>
                    </div>

                </div>

                <button type="button" id="add-ingrediente" class="bg-green-500 text-white px-4 py-2 rounded mt-2">
                    + Agregar ingrediente
                </button>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Guardar
            </button>
        </form>
    </div>

    <!-- JS para agregar/eliminar ingredientes -->
    <script>
        let ingredienteIndex = 1;

        document.getElementById('add-ingrediente').addEventListener('click', function() {
            const container = document.getElementById('ingredientes-container');
            const newRow = document.querySelector('.ingrediente-row').cloneNode(true);

            // actualizar los nombres de los inputs
            newRow.querySelectorAll('select, input').forEach(input => {
                const name = input.getAttribute('name');
                const newName = name.replace(/\d+/, ingredienteIndex);
                input.setAttribute('name', newName);
                if(input.tagName === 'SELECT') input.selectedIndex = 0;
                else input.value = '';
            });

            container.appendChild(newRow);
            ingredienteIndex++;
        });

        // eliminar fila
        document.getElementById('ingredientes-container').addEventListener('click', function(e) {
            if(e.target.classList.contains('remove-ingrediente')) {
                const rows = document.querySelectorAll('.ingrediente-row');
                if(rows.length > 1) e.target.closest('.ingrediente-row').remove();
            }
        });
    </script>
</x-app-layout>


