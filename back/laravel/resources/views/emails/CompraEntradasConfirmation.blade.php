<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de compra de entradas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            text-align: center;
            margin-top: 0;
        }
        p {
            color: #666;
            margin-bottom: 20px;
            line-height: 1.6;
        }
        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        li {
            margin-bottom: 15px;
            padding: 15px;
            background-color: cadetblue;
            border-radius: 4px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }
        li:last-child {
            margin-bottom: 0;
        }
        .movie-title {
            font-weight: bold;
            color: #333;
        }
        .ticket-info {
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>¡Gracias por comprar entradas!</h1>
        <p>Aquí está la información de las entradas compradas:</p>
        <ul>
            @foreach($entradas as $entrada)
                <li>
                    <span class="movie-title">Entrada para la película "{{ $pelicula['titulo'] }}"</span><br>
                    <span class="ticket-info">Fecha: {{ $sesion['dia'] }}, Hora: {{ $sesion['hora'] }}<br>
                    Fila: {{ $entrada->fila }}, Columna: {{ $entrada->columna }}, Precio: {{ $entrada->precio }}, Correo: {{ $entrada->correo }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
