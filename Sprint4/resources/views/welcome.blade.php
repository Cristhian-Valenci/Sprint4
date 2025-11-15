<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Cocteleando</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col bg-gray-100 text-gray-800">

  <!-- NAVBAR -->
  <header class="w-full bg-white shadow p-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-green-700"> Cocteleando</h1>
    <nav class="flex gap-4">
      @auth
        <form method="POST" action="{{ route('logout') }}">@csrf
          <button class="text-red-600 hover:underline">Cerrar sesión</button>
        </form>
      @endauth
    </nav>
  </header>

  
  <main class="flex-grow w-full">
    <section class="max-w-4xl mx-auto text-center py-20 px-4">
        <div class="flex justify-center mt-6">
           <img src="{{ asset('images/logo.png') }}" 
                alt="Logo Cocteleando"
                class="w-24 h-auto">
        </div>


      <h2 class="text-4xl font-extrabold text-green-800 mb-4">Bienvenido/a a Cocteleando</h2>

      <p class="text-xl text-gray-600 mb-8">
        Esta es una comunidad dirigida a Bartenders o Barmaids donde podrás:
      </p>

      <ul class="text-lg text-gray-600 space-y-3 mb-8 list-disc list-inside">
        <li>Aprender sobre los cócteles clásicos.</li>
        <li>Ver recetas, descripción y método de empleo de cócteles creados por tus colegas.</li>
        <li>Podrás también publicar tus recetas, como se elabora y una descripción de cocteles de tu autoría para compartilo con la comunidad.</li>
      </ul>

      @auth
        <a href="{{ url('/index') }}" class="px-6 py-3 bg-green-700 text-white rounded-lg shadow hover:bg-green-800">
          Ir a mis Cócteles
        </a>
      @else
        <a href="{{ route('login') }}" class="block mb-3 px-6 py-3 bg-green-700 text-white rounded-lg shadow hover:bg-green-800">
          Iniciar sesión
        </a>
        <a href="{{ route('register') }}" class="block px-6 py-3 bg-green-700 text-white rounded-lg shadow hover:bg-green-800">
          Únete a la comunidad
        </a>
      @endauth
    </section>
  </main>

 
  <footer class="text-center py-6 text-sm text-gray-500 bg-white">
    © {{ date('Y') }} Cocteleando — Todos los derechos reservados
  </footer>

</body>
</html>
