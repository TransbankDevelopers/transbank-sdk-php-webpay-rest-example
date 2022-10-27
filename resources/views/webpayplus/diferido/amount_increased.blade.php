@extends('layout')
@section('content')
    <h1>Webpay Transacción diferida monto incrementado</h1>

    <h2>Request</h2>
    <pre> {{  print_r($req, true) }} </pre>

    <h2> Response </h2>
    <pre> {{  print_r($resp, true) }} </pre>
    <br><hr>
    <div class="flex flex-col w-1/2 space-y-3 p-4">
        <div>
            <h3 class="text-lg mt-2 font-bold">Incrementar monto pre autorizado</h3>
            <form method="post" action="/webpayplus/diferido/increaseAmount">
                <label for="amount">Monto</label>
                <input type="text" class="w-full" value="1000" id="amount" name="amount">
                <label for="buyOrder">Orden de compra</label>
                <input type="text" class="w-full" name="buyOrder" id="buyOrder" value="{{ $req["buyOrder"] }}">
                <label for="authCode">Código de autorización</label>
                <input type="text" class="w-full" name="authCode" id="authCode" value="{{ $resp->authorizationCode }}">
                <label for="token">Token</label>
                <input type="text" class="w-full" name="token" id="token" value="{{ $req["token"] }}">
                <button type="submit">Incrementar monto</button>
            </form>
        </div>
        <hr>
        <div>
            <h3 class="text-lg mt-2 font-bold">Reversa monto pre autorizado</h3>
            <form method="post" action="/webpayplus/diferido/reverseAmount">
                <label for="amount">Monto</label>
                <input type="text" class="w-full" value="1000" id="amount" name="amount">
                <label for="buyOrder">Orden de compra</label>
                <input type="text" class="w-full" name="buyOrder" id="buyOrder" value="{{ $req["buyOrder"] }}">
                <label for="authCode">Código de autorización</label>
                <input type="text" class="w-full" name="authCode" id="authCode" value="{{ $resp->authorizationCode }}">
                <label for="token">Token</label>
                <input type="text" class="w-full" name="token" id="token" value="{{ $req["token"] }}">
                <button type="submit">Revertir monto</button>
            </form>
        </div>
        <hr>
        <div>
            <h3 class="text-lg mt-2 font-bold">Extender fecha expiración</h3>
            <form method="post" action="/webpayplus/diferido/increaseDate">
                <label for="buyOrder">Orden de compra</label>
                <input type="text" class="w-full" name="buyOrder" id="buyOrder" value="{{ $req["buyOrder"] }}">
                <label for="authCode">Código de autorización</label>
                <input type="text" class="w-full" name="authCode" id="authCode" value="{{ $resp->authorizationCode }}">
                <label for="token">Token</label>
                <input type="text" class="w-full" name="token" id="token" value="{{ $req["token"] }}">
                <button type="submit">Extender fecha</button>
            </form>
        </div>
        <hr>
        <div>
            <h3 class="text-lg mt-2 font-bold">Historial de transacción</h3>
            <form method="post" action="/webpayplus/diferido/transactionHistory">
                <label for="token">Token</label>
                <input type="text" class="w-full" name="token" id="token" value="{{ $req["token"] }}">
                <button type="submit">Historial</button>
            </form>
        </div>
        <hr>
        <div>
            <h3 class="text-lg mt-2 font-bold">Status de transacción</h3>
            <form method="post" action="/webpayplus/diferido/status">
                <label for="token">Token</label>
                <input type="text" class="w-full" name="token" id="token" value="{{ $req["token"] }}">
                <button type="submit">Status</button>
            </form>
        </div>
        <hr>
        <div>
            <h3 class="text-lg mt-2 font-bold">Capturar monto</h3>
            <form method="post" action="/webpayplus/diferido/capture">
                <label for="capture_amount">Monto</label>
                <input type="text" class="w-full" value="1000" id="capture_amount" name="capture_amount">
                <label for="buy_order">Orden de compra</label>
                <input type="text" class="w-full" name="buy_order" id="buy_order" value="{{ $req["buyOrder"] }}">
                <label for="authorization_code">Código de autorización</label>
                <input type="text" class="w-full" name="authorization_code" id="authorization_code" value="{{ $resp->authorizationCode }}">
                <label for="token">Token</label>
                <input type="text" class="w-full" name="token" id="token" value="{{ $req["token"] }}">
                <button type="submit">Capturar monto</button>
            </form>
        </div>
    </div>
   @endsection
