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
<h1>Ejemplo Webpay Plus Transaccion diferido</h1>

<form class="webpay_form" action="/webpayplus/diferido/create" method="post" style="display: flex; flex-direction:column; width:50%;font-size: 20px;">
    @csrf
    <label for="buy_order">
        Orden de compra
    </label>
    <input id="buy_order" name="buy_order" value={{ "123456" . rand(1, 1000) }}/>

    <label for="session_id">
        Id de sesión
    </label>
    <input id="session_id" name="session_id" value="session123456" />

    <label for="amount">
        Monto
    </label>
    <input id="amount" name="amount" value="1000"/>


    <label for="return_url">
        URL de retorno
    </label>
    <input id="return_url" name="return_url" value="{{ url('/') }}/webpayplus/diferido/returnUrl"/>

    <button type="submit">Aceptar</button>
</form>

</body>

</html>
