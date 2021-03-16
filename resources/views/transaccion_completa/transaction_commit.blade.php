@extends('layout')
@section('content')
<h1> Ejemplo Transacción Completa transacción confirmada</h1>

<h3>Parámetros recibidos:</h3>
<pre>
    {{ print_r($req, true) }}
</pre>


<h3>Respuesta:</h3>
<pre>
    {{ print_r($res, true)  }}
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
@endsection



