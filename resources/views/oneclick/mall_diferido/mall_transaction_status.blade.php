@extends('layout')
@section('content')
    <h1>Oneclick Mall Transaction Status</h1>

<h1>Request</h1>
<pre> {{  print_r($req, true) }} </pre>

<h1>Response</h1>
<pre> {{  print_r($resp, true) }} </pre>

<br><hr>
<div class="flex flex-col w-1/2 space-y-3 p-4">
    <div>
        <h3 class="text-lg mt-2 font-bold">Capturar monto</h3>
        <form method="post" action="/oneclick/mall/diferido/capture">
            <label for="buy_order">Orden de compra</label>
            <input type="text" class="w-full" name="buy_order" id="buy_order" value="{{ $resp->details[0]->buyOrder }}" >
            <label for="authorization_code">Código de autorización</label>
            <input type="text" class="w-full" name="authorization_code" id="authorization_code" value="{{ $resp->details[0]->authorizationCode }}" >
            <label for="commerce_code">Código de comercio</label>
            <input type="text" class="w-full" name="commerce_code" id="commerce_code" value="{{ $resp->details[0]->commerceCode }}" >
            <label for="amount">Monto</label>
            <input type="text" class="w-full" name="amount" id="amount" value="{{ $resp->details[0]->amount }}">
            <input type="hidden" name="parent_buy_order" value="{{ $resp->buyOrder }}" >
            <button type="submit">Capturar</button>
        </form>
    </div>
    <hr>
    <div>
        <h3 class="text-lg mt-2 font-bold">Obtener status de la transacción</h3>
        <form method="post" action="/oneclick/mall/diferido/transaction_status">
            <label for="buyOrder">Orden de compra</label>
            <input type="text" class="w-full" name="buy_order" id="buy_order" value="{{ $resp->buyOrder }}">
            <button type="submit">Obtener status</button>
        </form>
    </div>
</div>


@endsection
