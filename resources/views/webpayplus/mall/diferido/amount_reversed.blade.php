@extends('layout')
@section('content')

    <h1>Webpay Mall Transacción diferida monto reversado</h1>

    <h2>Request</h2>
    <pre> {{  print_r($req, true) }} </pre>

    <h2> Response </h2>
    <pre> {{  print_r($resp, true) }} </pre>

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
