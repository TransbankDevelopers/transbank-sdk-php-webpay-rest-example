@extends('layout')
@section('content')
<h1>Oneclick Mall Diferido monto incrementado</h1>

<h2>Request</h2>
<pre> {{  print_r($req, true) }} </pre>

<h2> Response </h2>
<pre> {{  print_r($res, true) }} </pre>

<br><hr>
<div class="flex flex-col w-1/2 space-y-3 p-4">
    <div>
        <h3 class="text-lg mt-2 font-bold">Capturar monto</h3>
        <form method="post" action="/oneclick/mall/diferido/capture">
            <label for="buy_order">Orden de compra</label>
            <input type=" text" class="w-full" name="buy_order" id="buy_order" value="{{ $req["buyOrder"] }}" >
            <label for="authorization_code">Código de autorización</label>
            <input type=" text" class="w-full" name="authorization_code" id="authorization_code" value="{{ $res->authorizationCode }}" >
            <label for="commerce_code">Código de comercio</label>
            <input type=" text" class="w-full" name="commerce_code" id="commerce_code" value="{{ $req["commerceCode"] }}" >
            <label for="amount">Monto</label>
            <input type=" text" class="w-full" name="amount" id="amount" value="{{ $res->totalAmount }}">
            <input type="hidden" name="parent_buy_order" value="{{ $req["parent_buy_order"] }}" >
            <button type="submit">Capturar</button>
        </form>
    </div>
    <hr>
    <div>
        <h3 class="text-lg mt-2 font-bold">Incrementar monto pre autorizado</h3>
        <form method="post" action="/oneclick/mall/diferido/increase_amount">
            <label for="amount">Monto</label>
            <input type=" text" class="w-full" value="1000" id="amount" name="amount">
            <label for="buyOrder">Orden de compra</label>
            <input type=" text" class="w-full" name="buyOrder" id="buyOrder" value="{{ $req["buyOrder"] }}">
            <label for="authCode">Código de autorización</label>
            <input type=" text" class="w-full" name="authCode" id="authCode" value="{{ $res->authorizationCode }}">
            <label for="commerceCode">Código de comercio</label>
            <input type=" text" class="w-full" name="commerceCode" id="commerceCode" value={{ $req["commerceCode"] }} >
            <input type="hidden" name="parent_buy_order" value="{{ $req["parent_buy_order"] }}" >
            <button type="submit">Incrementar monto</button>
        </form>
    </div>
    <hr>
    <div>
        <h3 class="text-lg mt-2 font-bold">Reversa monto pre autorizado</h3>
        <form method="post" action="/oneclick/mall/diferido/reverse_amount">
            <label for="amount">Monto</label>
            <input type=" text" class="w-full" value="1000" id="amount" name="amount">
            <label for="amount">Orden de compra</label>
            <input type=" text" class="w-full" name="buyOrder" id="buyOrder" value="{{ $req["buyOrder"] }}">
            <label for="amount">Código de autorización</label>
            <input type=" text" class="w-full" name="authCode" id="authCode" value="{{ $res->authorizationCode }}">
            <label for="amount">Código de comercio</label>
            <input type=" text" class="w-full" name="commerceCode" id="commerceCode" value={{ $req["commerceCode"] }} >
            <input type="hidden" name="parent_buy_order" value="{{ $req["parent_buy_order"] }}" >
            <button type="submit">Reversa monto</button>
        </form>
    </div>
    <hr>
    <div>
        <h3 class="text-lg mt-2 font-bold">Extender fecha expiración</h3>
        <form method="post" action="/oneclick/mall/diferido/increase_date">
            <label for="amount">Orden de compra</label>
            <input type=" text" class="w-full" name="buyOrder" id="buyOrder" value="{{ $req["buyOrder"] }}">
            <label for="amount">Código de autorización</label>
            <input type=" text" class="w-full" name="authCode" id="authCode" value="{{ $res->authorizationCode }}">
            <label for="amount">Código de comercio</label>
            <input type=" text" class="w-full" name="commerceCode" id="commerceCode" value={{ $req["commerceCode"] }} >
            <input type="hidden" name="parent_buy_order" value="{{ $req["parent_buy_order"] }}" >
            <button type="submit">Extender fecha</button>
        </form>
    </div>
    <hr>
    <div>
        <h3 class="text-lg mt-2 font-bold">Historial de transacción</h3>
        <form method="post" action="/oneclick/mall/diferido/history">
            <label for="buyOrder">Orden de compra</label>
            <input type=" text" class="w-full" name="buyOrder" id="buyOrder" value="{{ $req["buyOrder"] }}">
            <label for="authCode">Código de autorización</label>
            <input type=" text" class="w-full" name="authCode" id="authCode" value="{{ $res->authorizationCode }}">
            <label for="commerceCode">Código de comercio</label>
            <input type=" text" class="w-full" name="commerceCode" id="commerceCode" value="{{ $req["commerceCode"] }}">
            <input type="hidden" name="parent_buy_order" value="{{ $req["parent_buy_order"] }}" >
            <button type="submit">Historial</button>
        </form>
    </div>
    <hr>
    <div>
        <h3 class="text-lg mt-2 font-bold">Obtener status de la transacción</h3>
        <form method="post" action="/oneclick/mall/diferido/transaction_status">
            <label for="buyOrder">Orden de compra</label>
            <input type=" text" class="w-full" name="buy_order" id="buy_order" value="{{ $req["parent_buy_order"] }}">
            <button type="submit">Obtener status</button>
        </form>
    </div>
</div>

@endsection
