@props(['title'])

<div class="bg-white border-b py-4">
    <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <!-- Título -->
        <h2 class="text-xl font-semibold text-gray-800">
            {{ $title }}
        </h2>

        <!-- Contenido extra -->
        <div class="flex items-center gap-3">
            {{ $slot }}
        </div>

    </div>
</div>