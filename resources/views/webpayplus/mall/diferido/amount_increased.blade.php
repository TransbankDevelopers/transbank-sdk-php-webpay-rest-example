@extends('layout')
@section('content')
    <h1>Webpay Mall Transacción diferida monto incrementado</h1>

    <h2>Request</h2>
    <pre> {{  print_r($req, true) }} </pre>

    <h2> Response </h2>
    <pre> {{  print_r($resp, true) }} </pre>

    <div class="flex flex-col w-1/2 space-y-3 space-x-5 p-4">
        <div>
            <h3 class="text-lg mt-2 font-bold">Incrementar monto pre autorizado</h3>
            <form method="post" action="/webpayplus/mall/diferido/increaseAmount">
                <label>Monto:</label>
                <input type="text" class="w-full" value="1000" name="amount">
                <label>Orden de compra:</label>
                <input type="text" class="w-full" name="buyOrder" value="{{ $req["buyOrder"] }}">
                <label>Código de autorización:</label>
                <input type="text" class="w-full" name="authCode" value="{{ $resp->authorizationCode }}">
                <label>Código de comercio:</label>
                <input type="text" class="w-full" name="commerceCode" value="{{ $req["commerceCode"] }}">
                <label>Token:</label>
                <input type="text" class="w-full" name="token" value="{{ $req["token"] }}">
                <button type="submit">Incrementar monto</button>
            </form>
        </div>
        <div>
            <h3 class="text-lg mt-2 font-bold">Reversa monto pre autorizado</h3>
            <form method="post" action="/webpayplus/mall/diferido/reverseAmount">
                <label>Monto:</label>
                <input type="text" class="w-full" value="1000" name="amount">
                <label>Orden de compra:</label>
                <input type="text" class="w-full" name="buyOrder" value="{{ $req["buyOrder"] }}">
                <label>Código de autorización:</label>
                <input type="text" class="w-full" name="authCode" value="{{ $resp->authorizationCode  }}">
                <label>Código de comercio:</label>
                <input type="text" class="w-full" name="commerceCode" value="{{ $req["commerceCode"] }}">
                <label>Token:</label>
                <input type="text" class="w-full" name="token" value="{{ $req["token"] }}">
                <button type="submit">Reversa monto</button>
            </form>
        </div>
        <div>
            <h3 class="text-lg mt-2 font-bold">Extender fecha expiración</h3>
            <form method="post" action="/webpayplus/mall/diferido/increaseDate">
                <label>Orden de compra:</label>
                <input type="text" class="w-full" name="buyOrder" value="{{ $req["buyOrder"] }}">
                <label>Código de autorización:</label>
                <input type="text" class="w-full" name="authCode" value="{{ $resp->authorizationCode }}">
                <label>Código de comercio:</label>
                <input type="text" class="w-full" name="commerceCode" value="{{ $req["commerceCode"] }}">
                <label>Token:</label>
                <input type="text" class="w-full" name="token" value="{{ $req["token"] }}">
                <button type="submit">Extender fecha</button>
            </form>
        </div>
        <div>
            <h3 class="text-lg mt-2 font-bold">Historial de transacción</h3>
            <form method="post" action="/webpayplus/mall/diferido/transactionHistory">
                <label>Orden de compra:</label>
                <input type="text" class="w-full" name="buyOrder" value="{{ $req["buyOrder"] }}">
                <label>Código de comercio:</label>
                <input type="text" class="w-full" name="commerceCode" value="{{ $req["commerceCode"] }}">
                <label>Token:</label>
                <input type="text" class="w-full" name="token" value="{{ $req["token"] }}">
                <button type="submit">Historial</button>
            </form>
        </div>
        <div>
            <h3 class="text-lg mt-2 font-bold">Status de transacción</h3>
            <form method="post" action="/webpayplus/mall/diferido/transactionStatus">
                <label>Token:</label>
                <input type="text" class="w-full" name="token" value="{{ $req["token"] }}">
                <button type="submit">Status</button>
            </form>
        </div>
        <div>
            <h3 class="text-lg mt-2 font-bold">Capturar monto</h3>
            <form method="post" action="/webpayplus/mall/diferido/capture">
                <label>Monto:</label>
                <input type="text" class="w-full" name="capture_amount" value="{{ $resp->totalAmount }}">
                <label>Orden de compra:</label>
                <input type="text" class="w-full" name="buy_order" value="{{ $req["buyOrder"] }}">
                <label>Código de autorización:</label>
                <input type="text" class="w-full" name="authorization_code" value="{{ $resp->authorizationCode }}">
                <label>Código de comercio:</label>
                <input type="text" class="w-full" name="commerce_code" value="{{ $req["commerceCode"] }}">
                <label>Token:</label>
                <input type="text" class="w-full" name="token" value="{{ $req["token"] }}">
                <button type="submit">Capturar</button>
            </form>
        </div>
    </div>

    <h3>Incrementar monto pre autorizado</h3>
    <form method="post" action="/webpayplus/mall/diferido/increaseAmount">
        <input type="text" value="1000" name="amount">
        <input type="hidden" name="buyOrder" value="{{ $req["buyOrder"] }}">
        <input type="hidden" name="authCode" value="{{ $resp->authorizationCode }}">
        <input type="hidden" name="commerceCode" value="{{ $req["commerceCode"] }}">
        <input type="hidden" name="token" value="{{ $req["token"] }}">
        <button type="submit">Incrementar monto</button>
    </form>

    <h3>Reversa monto pre autorizado</h3>
    <form method="post" action="/webpayplus/mall/diferido/reverseAmount">
        <input type="text" value="1000" name="amount">
        <input type="hidden" name="buyOrder" value="{{ $req["buyOrder"] }}">
        <input type="hidden" name="authCode" value="{{ $resp->authorizationCode  }}">
        <input type="hidden" name="commerceCode" value="{{ $req["commerceCode"] }}">
        <input type="hidden" name="token" value="{{ $req["token"] }}">
        <button type="submit">Reversa monto</button>
    </form>

    <h3>Extender fecha expiración</h3>
    <form method="post" action="/webpayplus/mall/diferido/increaseDate">
        <input type="hidden" name="buyOrder" value="{{ $req["buyOrder"] }}">
        <input type="hidden" name="authCode" value="{{ $resp->authorizationCode }}">
        <input type="hidden" name="commerceCode" value="{{ $req["commerceCode"] }}">
        <input type="hidden" name="token" value="{{ $req["token"] }}">
        <button type="submit">Extender fecha</button>
    </form>

    <h3>Historial de transacción</h3>
    <form method="post" action="/webpayplus/mall/diferido/transactionHistory">
        <input type="hidden" name="buyOrder" value="{{ $req["buyOrder"] }}">
        <input type="hidden" name="commerceCode" value="{{ $req["commerceCode"] }}">
        <input type="hidden" name="token" value="{{ $req["token"] }}">
        <button type="submit">Historial</button>
    </form>

    <h3>Status de transacción</h3>
    <form method="post" action="/webpayplus/mall/diferido/transactionStatus">
        <input type="hidden" name="token" value="{{ $req["token"] }}">
        <button type="submit">Status</button>
    </form>

    <h3>Capturar monto</h3>
    <form method="post" action="/webpayplus/mall/diferido/capture">
        <input type="text" name="capture_amount" value="{{ $resp->totalAmount }}">
        <input type="hidden" name="buy_order" value="{{ $req["buyOrder"] }}">
        <input type="hidden" name="authorization_code" value="{{ $resp->authorizationCode }}">
        <input type="hidden" name="commerce_code" value="{{ $req["commerceCode"] }}">
        <input type="hidden" name="token" value="{{ $req["token"] }}">
        <button type="submit">Capturar</button>
    </form>

@endsection
