<!DOCTYPE html>
<html>
<head>
    <title>Confirmación de compra de entradas</title>
</head>
<body>
    <h1>¡Gracias por comprar entradas!</h1>
    <p>Aquí está la información de las entradas compradas:</p>
    <ul>
        @foreach($entradas as $entrada)
            <li>Entrada para la sesión ID: {{ $entrada['id_sesion'] }}, Fila: {{ $entrada['fila'] }}, Columna: {{ $entrada['columna'] }}, Precio: {{ $entrada['precio'] }}</li>
        @endforeach
    </ul>
</body>
</html>
