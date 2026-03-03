@extends('layout')
@section('content')
<div class="w-full max-w-none">
    <h1 class="mb-2">Transacción Completa Diferida confirmada</h1>
    <p class="text-gray-700 mb-6">
        La autorización diferida fue confirmada. Desde aquí puedes capturar monto o consultar estado.
    </p>

    <div class="grid grid-cols-1 gap-6 mb-6">
        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <h3 class="font-bold mb-2">Parámetros recibidos</h3>
            <pre class="text-sm tbk-pre-wrap">{{ print_r($req, true) }}</pre>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <h3 class="font-bold mb-2">Respuesta</h3>
            <pre class="text-sm tbk-pre-wrap">{{ print_r($res, true) }}</pre>
        </div>
    </div>

    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-8">
        <h2 class="text-base font-bold text-blue-900 mb-2">Token</h2>
        <input id="deferred_commit_token" type="text" readonly value="{{ $req['token_ws'] }}" class="w-full bg-white" />
    </div>

    <h2 class="text-lg font-bold mb-3">Acciones</h2>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-white border border-gray-200 rounded-lg p-4 h-full flex flex-col">
            <h3 class="font-bold mb-3">Capturar monto</h3>
            <p class="text-sm text-gray-600 mb-4">Ingresa los datos de captura para concretar el cargo.</p>
            <form method="post" action="{{ route('completa.deferred.capture') }}"
                class="tbk-form-stack tbk-form-stack-flex">
                @csrf
                <div>
                    <label for="capture_token_ws">Token</label>
                    <input id="capture_token_ws" type="text" class="w-full" name="token_ws" value="{{ $req['token_ws'] }}">
                </div>
                <div>
                    <label for="capture_buy_order">Orden de compra</label>
                    <input id="capture_buy_order" type="text" class="w-full" name="buy_order" value="{{ $res->buyOrder }}">
                </div>
                <div>
                    <label for="capture_authorization_code">Código de autorización</label>
                    <input id="capture_authorization_code" type="text" class="w-full" name="authorization_code" value="{{ $res->authorizationCode }}">
                </div>
                <div>
                    <label for="capture_amount">Monto</label>
                    <input id="capture_amount" type="text" class="w-full" name="amount" value="{{ $res->amount }}">
                </div>
                <button type="submit" class="tbk-btn-bottom">Capturar</button>
            </form>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4 h-full flex flex-col">
            <h3 class="font-bold mb-3">Obtener status</h3>
            <p class="text-sm text-gray-600 mb-4">Consulta el estado actual de la transacción diferida.</p>
            <form method="post" action="{{ route('completa.deferred.status') }}"
                class="tbk-form-stack tbk-form-stack-flex">
                @csrf
                <div>
                    <label for="status_token">Token</label>
                    <input id="status_token" type="text" class="w-full" value="{{ $req['token_ws'] }}" name="token">
                </div>
                <button type="submit" class="tbk-btn-bottom">Obtener status</button>
            </form>
        </div>
    </div>
</div>

@endsection


