@extends('layout')
@section('content')
    <h1>Webpay Plus diferido estado transacción</h1>

    <h2>Request</h2>
    <pre> {{  print_r($req, true) }} </pre>

    <h2> Response </h2>
    <pre> {{  print_r($resp, true) }} </pre>
    <br><hr>
    @if ($resp->status == "AUTHORIZED")

        <div class="flex flex-col w-1/2 space-y-3 p-4">
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
                    <input type="text" class="w-full" name="buy_order" id="buy_order" value="{{ $resp->buyOrder }}">
                    <label for="authorization_code">Código de autorización</label>
                    <input type="text" class="w-full" name="authorization_code" id="authorization_code" value="{{ $resp->authorizationCode }}">
                    <label for="token">Token</label>
                    <input type="text" class="w-full" name="token" id="token" value="{{ $req["token"] }}">
                    <button type="submit">Capturar monto</button>
                </form>
            </div>
        </div>
    @endif
@endsection
