@extends('layout')
@section('content')
<div class="w-full max-w-none">
    <h1 class="mb-2">Transaccion Completa Diferida capturada</h1>
    <p class="text-gray-700 mb-6">
        La captura fue realizada correctamente. Puedes revisar estado o solicitar reembolso.
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
        <input id="deferred_captured_token" type="text" readonly value="{{ $req['token_ws'] }}" class="w-full bg-white" />
    </div>

    <h2 class="text-lg font-bold mb-3">Acciones</h2>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-white border border-gray-200 rounded-lg p-4 h-full flex flex-col">
            <h3 class="font-bold mb-3">Revisar status</h3>
            <p class="text-sm text-gray-600 mb-4">Consulta el estado mas reciente de la transaccion.</p>
            <form action="{{ route('completa.deferred.status') }}" method="post"
                style="display: flex; flex-direction:column; width:100%; font-size: 16px; gap: 10px; flex: 1;">
                @csrf
                <div>
                    <label for="captured_status_token">
                        Token
                    </label>
                    <input id="captured_status_token" class="w-full" type="text" name="token" value="{{ $req['token_ws'] }}">
                </div>
                <button type="submit" style="margin-top: auto;">Revisar status</button>
            </form>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4 h-full flex flex-col">
            <h3 class="font-bold mb-3">Reembolso</h3>
            <p class="text-sm text-gray-600 mb-4">Solicita el reembolso del monto capturado.</p>
            <form action="{{ route('completa.deferred.refund') }}" method="post"
                style="display: flex; flex-direction:column; width:100%; font-size: 16px; gap: 10px; flex: 1;">
                @csrf
                <div>
                    <label for="captured_refund_token">
                        Token
                    </label>
                    <input id="captured_refund_token" class="w-full" type="text" name="token_ws" value="{{ $req['token_ws'] }}">
                </div>
                <div>
                    <label for="captured_refund_amount">
                        Monto
                    </label>
                    <input id="captured_refund_amount" class="w-full" type="number" name="amount" value="{{ $res->getCapturedAmount() }}">
                </div>
                <button type="submit" style="margin-top: auto;">Solicitar reembolso</button>
            </form>
        </div>
    </div>
</div>
@endsection
