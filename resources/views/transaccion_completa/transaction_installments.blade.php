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

<h3>Parametros recibidos:</h3>
<pre>
    {{ print_r($req) }}
</pre>


<h3>Respuesta:</h3>
<pre>
    {{ print_r($res)  }}
</pre>

<form class="webpay_form" action="/transaccion_completa/transaction_commit" method="post" style="display: flex; flex-direction:column; width:50%;font-size: 20px;" >
    @csrf
    <label for="token_ws">
        Token
    </label>
    <input type="text" name="token_ws" value={{ $req["token_ws"] }}>
    <label for="id_query_installments">
        Id de cuotas
    </label>
    <input type="text" name="id_query_installments" value={{ $res->getIdQueryInstallments() }} />
    <label for="deferred_period_index">
        Cantidad de periodo diferido
    </label>
    <input type="number" name="deferred_period_index" value="1" />
    <label for="grace_period">
        Periodo de Gracia
    </label>
    <input type="text" name="grace_period" value="false">
    <button type="submit">Enviar datos</button>
</form>


</body>
