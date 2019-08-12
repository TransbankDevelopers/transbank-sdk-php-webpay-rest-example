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
<h1>Transaccion Completa</h1>
<form action="mallCreate" method="post" class="webpay_form" style="">
    @csrf
    <label for="buy_order">
        Ordern de Compra
    </label>
    <input type="text" name="buy_order" value="ordenCompra12345678" />

    <label for="session_id">
        Id de Session
    </label>
    <input type="text" name="session_id" value="sesion1234564"/>

    <label for="card_number">
        Numero de Tarjeta
    </label>
    <input type="text" name="card_number" value="4051885600446623" />

    <label for="card_expiration_date">
        Fecha de Expiracion de tarjeta
    </label>
    <input type="text" name="card_expiration_date" value="22/10" />

    <label for="merchant_1_amount">Monto Merchant 1</label>
    <input type="text" id="merchant_1_amount" name="details[0][amount]" value="10000" />

    <label for="merchant_1_commerce_code">Codigo de comercio Hijo 1</label>
    <input type="text" name="detail[0][commerce_code]" value="597026008905">

    <label for="merchant_1_buy_order">Orden de compra comercio Hijo 1</label>
    <input type="text" name="detail[0][buy_order]" value="123456789" />

    <label for="merchant_1_amount">Monto Merchant 2</label>
    <input type="text" id="merchant_2_amount" name="details[1][amount]" value="10000" />

    <label for="merchant_2_commerce_code">Codigo de comercio Hijo 2</label>
    <input type="text" name="detail[1][commerce_code]" value="597026008913">

    <label for="merchant_2_buy_order">Orden de compra comercio Hijo 1</label>
    <input type="text" name="detail[1][buy_order]" value="123456789" />

    <button type="submit">Aceptar</button>
</form>
</body>
