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

<h1> Ejemplo Transacción completa mall: Transacción creada exitosamente</h1>

<h3>Parametros recibidos:</h3>
<pre>
    {{ print_r($req) }}
</pre>


<h3>Respuesta:</h3>
<pre>
    {{ print_r($res)  }}
</pre>





<h1>Consultar installments</h1>
<form class="transaccion_completa_form" action="/transaccion_completa/mall_installments" method="post" style="display: flex; flex-direction:column; width:50%;font-size: 20px;">
    @csrf
    <span>Token: {{ $res->getToken() }} </span>
  <input type="hidden" name="token_ws" value="{{ $res->getToken() }}">

  <h3>Detalles</h3>
  <hr>

  <label for="details_commerce_code">Detalles de transacción 1</label>
  <input id="details_commerce_code" name="details[0][commerce_code]"  value="{{ $details[0]["commerce_code"] }}">

  <label for="details_buy_order">Orden de compra (comercio hijo)</label>
  <input id="details_buy_order" name="details[0][buy_order]" value="{{ $details[0]["buy_order"] }}"/>

  <label for="details_amount">Monto</label>
  <input id="details_amount" name="details[0][amount]" value="{{ $details[0]["amount"] }}"/>

  <label for="details_installments_number">Número de cuotas</label>
  <select id="details_installments_number" name="details[0][installments_number]">
    <option>2</option>
    <option selected="selected">3</option>
    <option>4</option>
    <option>5</option>
    <option>6</option>
    <option>7</option>
    <option>8</option>
    <option>9</option>
    <option>10</option>
    <option>11</option>
    <option>12</option>
  </select>
  <hr>

  <label for="details_commerce_code">Detalles de transacción 2</label>
  <input id="details_commerce_code" name="details[1][commerce_code]" value="{{ $details[1]["commerce_code"] }}">

  <label for="details_buy_order">Orden de compra (comercio hijo)</label>
  <input id="details_buy_order" name="details[1][buy_order]" value="{{ $details[1]["buy_order"] }}"/>

  <label for="details_amount">Monto</label>
  <input id="details_amount" name="details[1][amount]" value="{{ $details[1]["amount"] }}"/>

  <select id="details_installments_number" name="details[1][installments_number]">
    <option>2</option>
    <option selected="selected">3</option>
    <option>4</option>
    <option>5</option>
    <option>6</option>
    <option>7</option>
    <option>8</option>
    <option>9</option>
    <option>10</option>
    <option>11</option>
    <option>12</option>
  </select>

  <button type="submit">Enviar</button>
</form>
</body>
