@extends('layout')
@section('content')
<div class="w-full max-w-none">
    <h1 class="mb-2">Transaccion Completa creada</h1>
    <p class="text-gray-700 mb-6">
        La transaccion fue creada correctamente. Desde aqui puedes autorizar el pago o consultar cuotas usando el token generado.
    </p>

    <div class="grid grid-cols-1 gap-6 mb-6">
        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <h3 class="font-bold mb-2">Parametros recibidos</h3>
            <pre class="text-sm" style="white-space: pre-wrap; word-break: break-word; overflow-wrap: anywhere; max-width: 100%; overflow-x: auto;">{{ print_r($req, true) }}</pre>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <h3 class="font-bold mb-2">Respuesta</h3>
            <pre class="text-sm" style="white-space: pre-wrap; word-break: break-word; overflow-wrap: anywhere; max-width: 100%; overflow-x: auto;">{{ print_r($res, true) }}</pre>
        </div>
    </div>

    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-8">
        <h2 class="text-base font-bold text-blue-900 mb-2">Token</h2>
        <input id="tc_token" type="text" readonly value="{{ $res->getToken() }}" class="w-full bg-white" />
    </div>

    <h2 class="text-lg font-bold mb-3">Acciones</h2>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-white border border-gray-200 rounded-lg p-4 h-full flex flex-col">
            <h3 class="font-bold mb-3">Autorizar</h3>
            <p class="text-sm text-gray-600 mb-4">Confirma la transaccion usando el token generado.</p>
            <form class="webpay_form" action="/transaccion_completa/transaction_commit" method="post"
                style="display: flex; flex-direction:column; width:100%; font-size: 16px; gap: 10px; flex: 1;">
                @csrf
                <div>
                    <label for="token_ws">
                        Token
                    </label>
                    <input id="token_ws" class="w-full" type="text" name="token_ws" value="{{ $res->getToken() }}" />
                </div>

                <button type="submit" style="margin-top: auto;">Autorizar transaccion</button>
            </form>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4 h-full flex flex-col">
            <h3 class="font-bold mb-3">Consultar cuotas</h3>
            <p class="text-sm text-gray-600 mb-4">Consulta cuotas disponibles para la misma transaccion.</p>
            <form class="webpay_form" method="post" action="/transaccion_completa/installments"
                style="display: flex; flex-direction:column; width:100%; font-size: 16px; gap: 10px; flex: 1;">
                @csrf
                <div>
                    <label for="token_ws_installments">
                        Token
                    </label>
                    <input id="token_ws_installments" class="w-full" name="token_ws" value="{{ $res->getToken() }}" />
                </div>

                <div>
                    <label for="installments_number">
                        Cuotas
                    </label>
                    <input class="w-full" type="number" id="installments_number" name="installments_number" value="3" min="2" max="12" />
                </div>

                <button type="submit" style="margin-top: auto;">Consultar cuotas</button>
            </form>
        </div>
    </div>
</div>

@endsection
