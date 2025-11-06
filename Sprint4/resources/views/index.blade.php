
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Cócteles</title>
</head>
<body>
    <h1>Listado de Cócteles</h1>

    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Método de elaboración</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cocktails as $cocktail)
                <tr>
                    <td>{{ $cocktail->id }}</td>
                    <td>{{ $cocktail->nombre }}</td>
                    <td>{{ $cocktail->descripcion }}</td>
                    <td>{{ $cocktail->metodo_elaboracion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
