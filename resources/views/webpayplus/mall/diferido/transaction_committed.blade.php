@extends('layout')
@section('content')
        <h1>Webpay plus mall diferido transaccion confirmada</h1>

    <div>

        <div>
            <h2>Parametros</h2>
            <pre> {{  print_r($req, true) }} </pre>
            @if ($resp->isApproved())
                <span class="text-green-700 text-xl my-2 inline-block font-bold">Transacción aprobada</span>
            @else
                <span class="text-red-700 text-xl my-2 inline-block font-bold">Transacción rechazada</span>
            @endif
            <h2>Respuesta</h2>
            <pre> {{  print_r($resp, true) }} </pre>
        </div>

    </div>
        <div class="flex flex-row space-x-5">
            <div class="flex flex-col w-1/2 space-y-3">
                <div>
                    <h2 class="text-lg mt-2 font-bold">Transacción #1</h2>
                </div>
                <hr>
                <div>
                    <h3 class="text-lg mt-2 font-bold">Capturar monto</h3>
                    <form method="post" action="/webpayplus/mall/diferido/capture">
                        <label>Monto:</label>
                        <input type="text" class="w-full" name="capture_amount" value="{{ $resp->details[0]->amount }}">
                        <label>Orden de compra:</label>
                        <input type="text" class="w-full" name="buy_order" value="{{ $resp->details[0]->buyOrder }}">
                        <label>Código de autorización:</label>
                        <input type="text" class="w-full" name="authorization_code" value="{{ $resp->details[0]->authorizationCode }}">
                        <label>Código de comercio:</label>
                        <input type="text" class="w-full" name="commerce_code" value="{{ $resp->details[0]->commerceCode }}">
                        <label>Token:</label>
                        <input type="text" class="w-full" name="token" value="{{ $req["token_ws"] }}">
                        <button type="submit">Capturar</button>
                    </form>
                </div>
                <hr>
                <div>
                    <h3 class="text-lg mt-2 font-bold">Status de transacción</h3>
                    <form method="post" action="/webpayplus/mall/diferido/transactionStatus">
                        <label>Token:</label>
                        <input type="text" class="w-full" name="token" value="{{ $req["token_ws"] }}">
                        <button type="submit">Status</button>
                    </form>
                </div>
            </div>

            @if(count($resp->details) >1)
            <div class="flex flex-col w-1/2 space-y-3">
                <div>
                    <h2 class="text-lg mt-2 font-bold">Transacción #2</h2>
                </div>
                <hr>
                <div>
                    <h3 class="text-lg mt-2 font-bold">Capturar monto</h3>
                    <form method="post" action="/webpayplus/mall/diferido/capture">
                        <label>Monto:</label>
                        <input type="text" class="w-full" name="capture_amount" value="{{ $resp->details[1]->amount }}">
                        <label>Orden de compra:</label>
                        <input type="text" class="w-full" name="buy_order" value="{{ $resp->details[1]->buyOrder }}">
                        <label>Código de autorización:</label>
                        <input type="text" class="w-full" name="authorization_code" value="{{ $resp->details[1]->authorizationCode }}">
                        <label>Código de comercio:</label>
                        <input type="text" class="w-full" name="commerce_code" value="{{ $resp->details[1]->commerceCode }}">
                        <label>Token:</label>
                        <input type="text" class="w-full" name="token" value="{{ $req["token_ws"] }}">
                        <button type="submit">Capturar</button>
                    </form>
                </div>
                <hr>
                <div>
                    <h3 class="text-lg mt-2 font-bold">Status de transacción</h3>
                    <form method="post" action="/webpayplus/mall/diferido/transactionStatus">
                        <label>Token:</label>
                        <input type="text" class="w-full" name="token" value="{{ $req["token_ws"] }}">
                        <button type="submit">Status</button>
                    </form>
                </div>
            </div>
            @endif


            
        </div>
@endsection
