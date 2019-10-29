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
<h1> Ejemplo Transacción Completa transacción confirmada</h1>

<h3>Parametros recibidos:</h3>
<pre>
    {{ print_r($req) }}
</pre>


<h3>Respuesta:</h3>
<pre>
    {{ print_r($res)  }}
</pre>

<h3>Revisar status de la transacción</h3>
<form action="/transaccion_completa/transaction_status" method="post" class="webpay_form">
    @csrf
    <label for="token_ws">
        Token
    </label>
    <input type="text" name="token_ws" value={{ $req['token_ws'] }}>
    <br>
    <button type="submit">Revisar Status</button>
</form>

<h3>Reembolso de la transaccion</h3>
<form action="/transaccion_completa/refund" method="post" class="webpay_form">
    @csrf
    <label for="token_ws">
        Token
    </label>
    <input type="text" name="token_ws" value={{ $req["token_ws"] }}>
    <label for="amount">
        Monto
    </label>
    <input type="number" name="amount" value="1000">
    <button type="submit"> Solicitar Reembolso</button>
</form>
</body>


</body>





