@extends('layout')
@section('content')
    <h1>Webpay Transacción diferida capturada</h1>

    <h2>Request</h2>
    <pre> {{  print_r($req, true) }} </pre>

    <h2> Response </h2>
    <pre> {{  print_r($resp, true) }} </pre>


    <br><hr>
    <h2>Reembolso</h2>
    <form method="post" action="/webpayplus/diferido/refund">
        @csrf
        <label for="token">Token</label> <br>
        <input name="token" type="text" id="token" value={{ $req["token"] }}> <br>
        <label for="amount">Monto</label> <br>
        <input name="amount" type="text" id="amount" value={{ $resp->getCapturedAmount() }}> <br>

        <button type="submit">Reembolsar transacción </button>

    </form>
    <br><hr>
    <h2>Estado de la transacción</h2>

    <form method="post" action="/webpayplus/diferido/status">
        @csrf
        <label for="amount">Monto</label> <br>
        <input name="amount" type="text" id="amount" value={{ $resp->getCapturedAmount() }}> <br>
        <label for="token">Token</label> <br>
        <input name="token" type="text" id="token" value={{ $req["token"] }}> <br>
        <button type="submit">Ver estado</button>

    </form>
@endsection
