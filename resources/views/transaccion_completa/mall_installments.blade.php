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

<form action="/transaccion_completa/mall_commit" method="post" class="webpay_form">
    @csrf
    <label for="token_ws">
        Token
    </label>
    <input type="text" name="token_ws" value={{ $req["token_ws"] }}>
    <label for="merchant_1_commerce_code">Codigo de comercio hijo 1</label>
    <input type="text" name="details[0][commerce_code]" value="597026008913">

    <label for="merchant_1_buy_order"> Orden de compra hijo 1</label>
    <input type="text" name="details[0][buy_order]" value="ordenCompra1234" />

    <label for="merchant_1_id_query_installments">Id de cuotas</label>
    <input type="text" name="details[0][id_query_installments]" value={{ $res->getIdQueryInstallments() }} />

    <label for="merchant_1_deferred_period_index">Cantidad de periodo diferido</label>
    <input type="number" name="details[0][deferred_period_index]" value="1" />

    <label for="merchant_1_grace_period">Periodo de Gracia</label>
    <input type="text" name="details[0][grace_period]" value="false">

    <label for="merchant_2_commerce_code">Codigo de comercio hijo 2</label>
    <input type="text" name="details[1][commerce_code]" value="597026008913">

    <label for="merchant_2_buy_order"> Orden de compra hijo 2</label>
    <input type="text" name="details[1][buy_order]" value="ordenCompra1234" />

    <label for="merchant_2_id_query_installments">Id de cuotas</label>
    <input type="text" name="details[1][id_query_installments]" value={{ $res->getIdQueryInstallments() }} />

    <label for="merchant_2_deferred_period_index">Cantidad de periodo diferido</label>
    <input type="number" name="details[1][deferred_period_index]" value="1" />

    <label for="merchant_2_grace_period">Periodo de Gracia</label>
    <input type="text" name="details[1][grace_period]" value="false">

    <button type="submit">Enviar datos</button>

</form>

</body>
