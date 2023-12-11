@extends('layout')
@section('content')
<h1>Transacción Completa Diferida fecha de expiracion extendida</h1>

<h2>Request</h2>
<pre> {{  print_r($req, true) }} </pre>

<h2> Response </h2>
<pre> {{  print_r($res, true) }} </pre>

<br><hr>
<div class="flex flex-col w-1/2 space-y-3 p-4">
    <div>
        <h3 class="text-lg mt-2 font-bold">Capturar monto</h3>
        <form method="post" action="/transaccion_completa/diferido/capture">
            @csrf
            <label>Token</label>
            <input type="text" class="w-full" name="token_ws" value={{ $req["token"] }}>
            <label>Orden de compra</label>
            <input type="text" class="w-full" name="buy_order" value={{ $req["buyOrder"] }} >
            <label>Código de autorización</label>
            <input type="text" class="w-full" name="authorization_code" value="{{ $res->authorizationCode }}" >
            <label >Monto</label>
            <input type="text" class="w-full" name="amount" value="{{ $res->totalAmount }}" >
            <button type="submit">Capturar</button>
        </form>
    </div>
    <hr>
    <div>
        <h3 class="text-lg mt-2 font-bold">Obtener status de la transacción</h3>
        <form method="post" action="/transaccion_completa/diferido/transaction_status">
            @csrf
            <label>Token</label>
            <input type="text" class="w-full" value="{{ $req["token"] }}" name="token">
            <button type="submit">Obtener status</button>
        </form>
    </div>
</div>

@endsection
