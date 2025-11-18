<x-app-layout>
    <x-subheader title="Crear cóctel">
    </x-subheader>

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



    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow mt-8">
        <form action="{{ route('cocktails.store') }}" method="POST">
            @csrf

            <!-- Nombre del cóctel -->
            <div class="mb-4">
                <label for="nombre" class="font-bold">Nombre:</label>
                <input type="text" id="nombre" name="nombre" class="border rounded w-full p-2"
                 placeholder = "Escribe el nombre del cóctel" required>
            </div>

            <!-- Descripción -->
            <div class="mb-4">
                <label for="descripcion" class="font-bold">Descripción:</label>
                <textarea id="descripcion" name="descripcion" class="border rounded w-full p-2" 
                placeholder = "Has una breve descripcion del cóctel (donde se creó, quien lo creó, por qué se creó, etc.)"></textarea>
            </div>

            <!-- Método de elaboración -->
            <div class="mb-4">
                <label for="metodo_elaboracion" class="font-bold">Método de elaboración:</label>
                <textarea id="metodo_elaboracion" name="metodo_elaboracion" class="border rounded w-full p-2" 
                placeholder = "Aquí puedes poner con que método se elabora, en que vaso se sirve, que decoración lleva, etc."></textarea>
            </div>

            <!-- Ingredientes -->
            <div class="mb-4">
                <label class="font-bold">Ingredientes:</label>
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

                        <button type="button" 
                                class="remove-ingrediente text-white px-3 py-1 rounded hover:bg-red-700 flex items-center justify-center">
                                <img src="{{ asset('images/delete-buttom.png') }}" 
                                alt="Eliminar"
                                class="w-5 h-5">    
                            </button>

                    </div>

                </div>

                <button type="button" id="add-ingrediente" class="bg-green-500 text-white px-4 py-2 rounded mt-2">
                    + Agregar ingrediente
                </button>
            </div>

            <div class="mt-4 text-right">
               <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800">
                   Guardar
                </button>
            </div>
        </form>
    </div>

    @vite('resources/js/app.js')


</x-app-layout>