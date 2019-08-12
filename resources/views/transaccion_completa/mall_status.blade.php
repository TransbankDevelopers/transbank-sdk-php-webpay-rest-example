<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <style>
        .webpay_form input {
            font-size: 20px;

        }


    </style>

</head>

<body>
<h1> Ejemplo Transacción Completa</h1>

<h3>Parametros recibidos:</h3>
<pre>
    {{ print_r($req) }}
</pre>


<h3>Respuesta:</h3>
<pre>
    {{ print_r($res)  }}
</pre>

<br>
<a href="/"><h1>Volver</h1></a>

<form action="/transaccion_completa/mall_refund" method="post" class="webpay_form">
    @csrf
    <label for="token_ws">
        Token
    </label>
    <input type="text" name="token_ws" value={{ $req["token_ws"] }}>
    <label for="amount">
        Monto
    </label>
    <input type="number" name="amount" value="1000">
    <label for="commerce_code">Codigo de Comercio</label>
    <input type="text" name="commerce_code" value="597026008905">

    <label for="buy_order">Orden de Compra</label>
    <input type="text" name="buy_order" value="123456789" />
    <button type="submit"> Solicitar Reembolso</button>
</form>
</body>





