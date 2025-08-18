<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto de Ejemplo SDK PHP</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center">

    <div class="card shadow-lg mt-5" style="max-width: 600px; width: 100%;">
        <div class="card-body text-center">
            <h1 class="mb-4 text-primary">Proyecto de ejemplo PHP</h1>
            <p class="mb-3">
                Este sitio es un proyecto de ejemplo que muestra la integración de los distintos productos de Transbank en ambiente de producción, utilizando el SDK de PHP.
            </p>

            <div class="alert alert-warning text-start">
                ⚠ <strong>Importante:</strong> Ten en cuenta que las pruebas realizadas en este proyecto son con tarjetas y cobros reales.
            </div>

            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Ir al Login</a>
        </div>
    </div>

</body>
</html>