<x-app-layout>
   <x-subheader title="Editar cóctel">
    </x-subheader>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{--  Mensajes de validación --}}
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

                    
                    <div class="mb-4">
                        <label for="nombre" class="text-lg font-semibold text-gray-800 mb-2">Nombre</label>
                        <input type="text" name="nombre" id="nombre"
                               value="{{ old('nombre', $cocktail->nombre) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('nombre')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    
                    <div class="mb-4">
                        <label for="descripcion" class="text-lg font-semibold text-gray-800 mb-2">Descripción</label>
                        <textarea name="descripcion" id="descripcion" rows="4"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('descripcion', $cocktail->descripcion) }}</textarea>
                        @error('descripcion')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    
                    <div class="mb-4">
                        <label for="metodo_elaboracion" class="text-lg font-semibold text-gray-800 mb-2">Método de elaboración</label>
                        <textarea name="metodo_elaboracion" id="metodo_elaboracion" rows="4"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('metodo_elaboracion', $cocktail->metodo_elaboracion) }}</textarea>
                        @error('metodo_elaboracion')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Ingredientes --}}
                    <!-- Ingredientes -->
                    <div class="mb-4">
                       <label class="text-lg font-semibold text-gray-800 mb-2">Ingredientes:</label>
                           <div id="ingredientes-container">
                                @php $index = 0; @endphp

                                {{-- Si el cóctel ya tiene ingredientes --}}
                                   @foreach($cocktail->ingredients as $pivot)
                                 <div class="ingrediente-row mb-2 flex gap-2 items-center">
                                       <select name="ingredients[{{ $index }}][id]" class="border rounded p-2" required>
                                           <option value="">Selecciona un ingrediente</option>
                                               @foreach($allIngredients as $ingredient)
                                           <option value="{{ $ingredient->id }}" 
                                               {{ $pivot->id == $ingredient->id ? 'selected' : '' }}>
                                               {{ $ingredient->nombre }}
                                            </option>
                                    @endforeach
                                        </select>

                                <input type="number" name="ingredients[{{ $index }}][cantidad]" 
                                       class="border rounded p-2 w-24 appearance-none" 
                                       placeholder="Cantidad" min="0" step="any" 
                                       value="{{ $pivot->pivot->cantidad }}">

                                    <select name="ingredients[{{ $index }}][unidad]" class="border rounded p-2 w-32">
                                       <option value="">Unidad</option>
                                       <option value="cl" {{ $pivot->pivot->unidad=='cl' ? 'selected' : '' }}>cl</option>
                                       <option value="ml" {{ $pivot->pivot->unidad=='ml' ? 'selected' : '' }}>ml</option>
                                       <option value="oz" {{ $pivot->pivot->unidad=='oz' ? 'selected' : '' }}>oz</option>
                                       <option value="dash" {{ $pivot->pivot->unidad=='dash' ? 'selected' : '' }}>dash</option>
                                       <option value="unidades" {{ $pivot->pivot->unidad=='unidades' ? 'selected' : '' }}>unidades</option>
                                       <option value="cucharadas" {{ $pivot->pivot->unidad=='cucharadas' ? 'selected' : '' }}>cucharadas</option>
                                    </select>

                           <button type="button" 
                                   class="remove-ingrediente text-white px-3 py-1 rounded hover:bg-red-700 flex items-center justify-center">
                               <img src="{{ asset('images/delete-buttom.png') }}" 
                                    alt="Eliminar"
                                    class="w-5 h-5">    
                            </button>
                    </div>
               @php $index++; @endphp
               @endforeach

                 {{-- Si no hay ingredientes, mostramos una fila vacía --}}
                 @if($cocktail->ingredients->isEmpty())
                 <div class="ingrediente-row mb-2 flex gap-2 items-center">
                     <select name="ingredients[0][id]" class="border rounded p-2" required>
                       <option value="">Selecciona un ingrediente</option>
                          @foreach($ingredients as $ingredient)
                       <option value="{{ $ingredient->id }}">{{ $ingredient->nombre }}</option>
                         @endforeach
                      </select>

                       <input type="number" name="ingredients[0][cantidad]" 
                              class="border rounded p-2 w-24 appearance-none" 
                              placeholder="Cantidad" min="0" step="any">

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
                   @endif
                </div>

                  <button type="button" id="add-ingrediente" class="bg-green-500 text-white px-4 py-2 rounded mt-2">
                     + Agregar ingrediente
                    </button>
                </div>

                    
                    <div class="flex justify-end gap-4">
                        <a href="{{ route('cocktails.index') }}" class="px-4 py-2 rounded border border-black text-black bg-white hover:bg-gray-100">Cancelar</a>
                        <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded hover:bg-green-800">
                            Guardar cambios
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
