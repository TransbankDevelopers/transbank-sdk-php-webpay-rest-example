@extends('layout')
@section('content')
    <h1>Transacción confirmada</h1>

    <div>

        <div>
            <pre> {{  print_r($resp, true) }} </pre>
        </div>
        <div class="flex flex-col w-1/2 space-y-3 p-4">
            <div>
                <h3 class="text-lg mt-2 font-bold">Capturar monto</h3>
                <form method="post" action="/webpayplus/diferido/capture">
                    @csrf
                    <label for="token">Token</label>
                    <input type="text" name="token" class="w-full" id="token" value={{ $req["token_ws"] }}>
                    <label for="buy_order">Orden de compra</label>
                    <input type="text" name="buy_order" class="w-full" id="buy_order" value={{ $resp->getBuyOrder() }} >
                    <label for="authorization_code">Código de autorización</label>
                    <input type="text" name="authorization_code" class="w-full" id="authorization_code" value={{ $resp->getAuthorizationCode() }} >
                    <label for="capture_amount">Monto</label>
                    <input type="text" name="capture_amount" class="w-full" id="capture_amount" value={{ $resp->getAmount() }} >
                    <button type="submit">Capturar</button>
                </form>
            </div>
            <hr>
            <div>
                <h3 class="text-lg mt-2 font-bold">Obtener status de la transacción</h3>
                <form method="post" action="/webpayplus/diferido/status">
                    @csrf
                    <label for="token">Token</label>
                    <input type="text" class="w-full" id="token" value="{{ $req["token_ws"] }}" name="token">
                    <button type="submit">Obtener status</button>
                </form>
            </div>
        </div>

    </div>
@endsection
