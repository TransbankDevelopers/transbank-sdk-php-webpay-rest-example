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
        <h3 class="text-lg mt-2 font-bold">Incrementar monto pre autorizado</h3>
        <form method="post" action="/transaccion_completa/diferido/increase_amount">
            <label >Monto</label>
            <input type="text" class="w-full" value="1000" name="amount">
            <label>Orden de compra</label>
            <input type="text" class="w-full" name="buyOrder" value="{{ $res->buyOrder }}">
            <label>Código de autorización</label>
            <input type="text" class="w-full" name="authCode" value="{{ $res->authorizationCode }}">
            <label>Token</label>
            <input type="text" class="w-full" name="token" value="{{ $req["token_ws"] }}">
            <button type="submit">Incrementar monto</button>
        </form>
    </div>
    <hr>
    <div>
        <h3 class="text-lg mt-2 font-bold">Reversa monto pre autorizado</h3>
        <form method="post" action="/transaccion_completa/diferido/reverse_amount">
            <label >Monto</label>
            <input type="text" class="w-full" value="1000" name="amount">
            <label>Orden de compra</label>
            <input type="text" class="w-full" name="buyOrder" value="{{ $res->buyOrder }}">
            <label>Código de autorización</label>
            <input type="text" class="w-full" name="authCode" value="{{ $res->authorizationCode }}">
            <label>Token</label>
            <input type="text" class="w-full" name="token" value="{{ $req["token_ws"] }}">
            <button type="submit">Revertir monto</button>
        </form>
    </div>
    <hr>
    <div>
        <h3 class="text-lg mt-2 font-bold">Extender fecha expiración</h3>
        <form method="post" action="/transaccion_completa/diferido/increase_date">
            <label>Orden de compra</label>
            <input type="text" class="w-full" name="buyOrder" value="{{ $res->buyOrder }}">
            <label>Código de autorización</label>
            <input type="text" class="w-full" name="authCode" value="{{ $res->authorizationCode }}">
            <label>Token</label>
            <input type="text" class="w-full" name="token" value="{{ $req["token_ws"] }}">
            <button type="submit">Extender fecha</button>
        </form>
    </div>
    <hr>
    <div>
        <h3 class="text-lg mt-2 font-bold">Historial de transacción</h3>
        <form method="post" action="/transaccion_completa/diferido/history">
            <label>Token</label>
            <input type="text" class="w-full" name="token" value="{{ $req["token_ws"] }}">
            <button type="submit">Historial</button>
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



