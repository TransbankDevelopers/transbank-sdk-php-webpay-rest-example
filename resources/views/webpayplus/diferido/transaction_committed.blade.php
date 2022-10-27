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
                <h3 class="text-lg mt-2 font-bold">Incrementar monto pre autorizado</h3>
                <form method="post" action="/webpayplus/diferido/increaseAmount">
                    <label for="amount">Monto</label>
                    <input type="text" class="w-full" value="1000" id="amount" name="amount">
                    <label for="buyOrder">Orden de compra</label>
                    <input type="text" class="w-full" name="buyOrder" id="buyOrder" value="{{ $resp->buyOrder }}">
                    <label for="authCode">Código de autorización</label>
                    <input type="text" class="w-full" name="authCode" id="authCode" value="{{ $resp->authorizationCode }}">
                    <label for="token">Token</label>
                    <input type="text" class="w-full" name="token" id="token" value="{{ $req["token_ws"] }}">
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
                    <input type="text" class="w-full" name="buyOrder" id="buyOrder" value="{{ $resp->buyOrder }}">
                    <label for="authCode">Código de autorización</label>
                    <input type="text" class="w-full" name="authCode" id="authCode" value="{{ $resp->authorizationCode }}">
                    <label for="token">Token</label>
                    <input type="text" class="w-full" name="token" id="token" value="{{ $req["token_ws"] }}">
                    <button type="submit">Revertir monto</button>
                </form>
            </div>
            <hr>
            <div>
                <h3 class="text-lg mt-2 font-bold">Extender fecha expiración</h3>
                <form method="post" action="/webpayplus/diferido/increaseDate">
                    <label for="buyOrder">Orden de compra</label>
                    <input type="text" class="w-full" name="buyOrder" id="buyOrder" value="{{ $resp->buyOrder }}">
                    <label for="authCode">Código de autorización</label>
                    <input type="text" class="w-full" name="authCode" id="authCode" value="{{ $resp->authorizationCode }}">
                    <label for="token">Token</label>
                    <input type="text" class="w-full" name="token" id="token" value="{{ $req["token_ws"] }}">
                    <button type="submit">Extender fecha</button>
                </form>
            </div>
            <hr>
            <div>
                <h3 class="text-lg mt-2 font-bold">Historial de transacción</h3>
                <form method="post" action="/webpayplus/diferido/transactionHistory">
                    <label for="token">Token</label>
                    <input type="text" class="w-full" name="token" id="token" value="{{ $req["token_ws"] }}">
                    <button type="submit">Historial</button>
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
