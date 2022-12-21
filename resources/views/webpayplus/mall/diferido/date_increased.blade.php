@extends('layout')
@section('content')

    <h1>Webpay Mall Transacción diferida fecha de expiración extendida</h1>

    <h2>Request</h2>
    <pre> {{  print_r($req, true) }} </pre>

    <h2> Response </h2>
    <pre> {{  print_r($resp, true) }} </pre>
    <br><hr>
    <h3>Incrementar monto pre autorizado</h3>
    <form method="post" action="/webpayplus/mall/diferido/increaseAmount">
        <input type="text" value="1000" name="amount">
        <input type="hidden" name="buyOrder" value="{{ $req["buyOrder"] }}">
        <input type="hidden" name="authCode" value="{{ $resp->authorizationCode }}">
        <input type="hidden" name="commerceCode" value="{{ $req["commerceCode"] }}">
        <input type="hidden" name="token" value="{{ $req["token"] }}">
        <button type="submit">Incrementar monto</button>
    </form>
    <br><hr>
    <h3>Reversa monto pre autorizado</h3>
    <form method="post" action="/webpayplus/mall/diferido/reverseAmount">
        <input type="text" value="1000" name="amount">
        <input type="hidden" name="buyOrder" value="{{ $req["buyOrder"] }}">
        <input type="hidden" name="authCode" value="{{ $resp->authorizationCode  }}">
        <input type="hidden" name="commerceCode" value="{{ $req["commerceCode"] }}">
        <input type="hidden" name="token" value="{{ $req["token"] }}">
        <button type="submit">Reversa monto</button>
    </form>
    <br><hr>
    <h3>Extender fecha expiración</h3>
    <form method="post" action="/webpayplus/mall/diferido/increaseDate">
        <input type="hidden" name="buyOrder" value="{{ $req["buyOrder"] }}">
        <input type="hidden" name="authCode" value="{{ $resp->authorizationCode }}">
        <input type="hidden" name="commerceCode" value="{{ $req["commerceCode"] }}">
        <input type="hidden" name="token" value="{{ $req["token"] }}">
        <button type="submit">Extender fecha</button>
    </form>
    <br><hr>
    <h3>Historial de transacción</h3>
    <form method="post" action="/webpayplus/mall/diferido/transactionHistory">
        <input type="hidden" name="buyOrder" value="{{ $req["buyOrder"] }}">
        <input type="hidden" name="commerceCode" value="{{ $req["commerceCode"] }}">
        <input type="hidden" name="token" value="{{ $req["token"] }}">
        <button type="submit">Historial</button>
    </form>
    <br><hr>
    <h3>Status de transacción</h3>
    <form method="post" action="/webpayplus/mall/diferido/transactionStatus">
        <input type="hidden" name="token" value="{{ $req["token"] }}">
        <button type="submit">Status</button>
    </form>
    <br><hr>
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
