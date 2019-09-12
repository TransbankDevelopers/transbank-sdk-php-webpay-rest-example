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
            display: flex;
            flex-direction:column;
            width:50%;
        }


    </style>

</head>
<body>

<h3>Parametros recibidos:</h3>
<pre>
    {{ print_r($req) }}
</pre>


<h3>Respuesta:</h3>
<pre>
    {{ print_r($res)  }}
</pre>


<form action="/transaccion_completa/mall_installments" method="post" class="webpay_form">
    @csrf
    <label for="installments_number">Cuotas</label>
    <input type="number" name="installments_number" value="10" />

    <label for="commerce_code">Codigo de Comercio</label>
    <input type="text" name="commerce_code" value="597026008905">

    <label for="buy_order">Orden de Compra</label>
    <input type="text" name="buy_order" value="123456789" />

    <label for="token_ws">Token</label>
    <input type="text" name="token_ws" value={{ $res->getToken() }} />
    <button type="submit">Enviar datos</button>
</form>
</body>
