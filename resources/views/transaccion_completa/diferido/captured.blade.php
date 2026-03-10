@extends('layout')
@section('content')
<div class="w-full max-w-none">
    <h1 class="mb-2">{{ $productLabel }} capturada</h1>
    <p class="text-gray-700 mb-6">
        La captura fue realizada correctamente. Puedes revisar estado o solicitar reembolso.
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
        <input id="deferred_captured_token" type="text" readonly value="{{ $token }}" class="w-full bg-white" />
    </div>

    <h2 class="text-lg font-bold mb-3">Acciones</h2>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-white border border-gray-200 rounded-lg p-4 h-full flex flex-col">
            <h3 class="font-bold mb-3">Revisar status</h3>
            <p class="text-sm text-gray-600 mb-4">Consulta el estado más reciente de la transacción.</p>
            <form class="tbk-form-stack tbk-form-stack-flex" action="{{ route($routeNames['status']) }}" method="post">
                @csrf
                <div>
                    <label for="captured_status_token">
                        Token
                    </label>
                    <input id="captured_status_token" class="w-full" type="text" name="token" value="{{ $token }}">
                </div>
                <button type="submit" class="tbk-btn-bottom">Revisar status</button>
            </form>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4 h-full flex flex-col">
            <h3 class="font-bold mb-3">Reembolso</h3>
            <p class="text-sm text-gray-600 mb-4">Solicita el reembolso del monto capturado.</p>
            <form class="tbk-form-stack tbk-form-stack-flex" action="{{ route($routeNames['refund']) }}" method="post">
                @csrf
                <div>
                    <label for="captured_refund_token">
                        Token
                    </label>
                    <input id="captured_refund_token" class="w-full" type="text" name="token_ws" value="{{ $token }}">
                </div>
                <div>
                    <label for="captured_refund_amount">
                        Monto
                    </label>
                    <input id="captured_refund_amount" class="w-full" type="number" name="amount" value="{{ $capturedAmount ?? '' }}">
                </div>
                <button type="submit" class="tbk-btn-bottom">Solicitar reembolso</button>
            </form>
        </div>
    </div>
</div>
@endsection
