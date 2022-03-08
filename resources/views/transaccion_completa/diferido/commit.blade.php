@extends('layout')
@section('content')
<h1> Ejemplo Transacción Completa Diferida transacción confirmada</h1>

<h3>Parámetros recibidos:</h3>
<pre>
    {{ print_r($req, true) }}
</pre>


<h3>Respuesta:</h3>
<pre>
    {{ print_r($res, true)  }}
</pre>

<h3 class="text-lg my-4">Capturar transacción</h3>
<form action="{{ route("completa.deferred.capture") }}" method="post" class="flex flex-col">
    @csrf
    <label for="token_ws">
        Token
    </label>
    <input type="text" name="token_ws" value={{ $req['token_ws'] }}>
    <label for="buy_order">
        Orden de compra
    </label>
    <input type="text" name="buy_order" value={{ $res->getBuyOrder() }}>
    <label for="authorization_code">
        Código de autorización
    </label>
    <input type="number" name="authorization_code" value={{ $res->getAuthorizationCode() }}>
    <label for="amount">
        Monto
    </label>
    <input type="number" name="amount" value={{ $res->getAmount() }}>
    <button type="submit" class="w-full">Capturar</button>
</form>
@endsection



