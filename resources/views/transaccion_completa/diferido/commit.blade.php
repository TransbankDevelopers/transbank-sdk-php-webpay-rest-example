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

<br><hr>
<div class="flex flex-col w-1/2 space-y-3 p-4">
    <div>
        <h3 class="text-lg mt-2 font-bold">Capturar monto</h3>
        <form method="post" action="/transaccion_completa/diferido/capture">
            @csrf
            <label>Token</label>
            <input type="text" class="w-full" name="token_ws" value={{ $req["token_ws"] }}>
            <label>Orden de compra</label>
            <input type="text" class="w-full" name="buy_order" value={{ $res->buyOrder }} >
            <label>Código de autorización</label>
            <input type="text" class="w-full" name="authorization_code" value={{ $res->authorizationCode }} >
            <label >Monto</label>
            <input type="text" class="w-full" name="amount" value="{{ $res->amount }}" >
            <button type="submit">Capturar</button>
        </form>
    </div>
    <hr>
    <div>
        <h3 class="text-lg mt-2 font-bold">Obtener status de la transacción</h3>
        <form method="post" action="/transaccion_completa/diferido/transaction_status">
            @csrf
            <label>Token</label>
            <input type="text" class="w-full" value="{{ $req["token_ws"] }}" name="token">
            <button type="submit">Obtener status</button>
        </form>
    </div>
</div>


@endsection



