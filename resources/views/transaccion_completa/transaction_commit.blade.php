@extends('layout')
@section('content')
<div class="w-full max-w-none">
    <h1 class="mb-2">Transaccion Completa confirmada</h1>
    <p class="text-gray-700 mb-6">
        La autorizacion fue confirmada. Desde aqui puedes consultar estado o solicitar reembolso.
    </p>

    <div class="grid grid-cols-1 gap-6 mb-6">
        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <h3 class="font-bold mb-2">Parametros recibidos</h3>
            <pre class="text-sm tbk-pre-wrap">{{ print_r($req, true) }}</pre>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <h3 class="font-bold mb-2">Respuesta</h3>
            <pre class="text-sm tbk-pre-wrap">{{ print_r($res, true) }}</pre>
        </div>
    </div>

    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-8">
        <h2 class="text-base font-bold text-blue-900 mb-2">Token</h2>
        <input id="tc_commit_token" type="text" readonly value="{{ $req['token_ws'] }}" class="w-full bg-white" />
    </div>

    <h2 class="text-lg font-bold mb-3">Acciones</h2>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-white border border-gray-200 rounded-lg p-4 h-full flex flex-col">
            <h3 class="font-bold mb-3">Revisar status</h3>
            <p class="text-sm text-gray-600 mb-4">Consulta el estado actual de la transaccion.</p>
            <form action="/transaccion_completa/transaction_status" method="post"
                class="tbk-form-stack tbk-form-stack-flex">
                @csrf
                <div>
                    <label for="status_token_ws">Token</label>
                    <input id="status_token_ws" class="w-full" type="text" name="token_ws" value="{{ $req['token_ws'] }}">
                </div>
                <button type="submit" class="tbk-btn-bottom">Revisar status</button>
            </form>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4 h-full flex flex-col">
            <h3 class="font-bold mb-3">Reembolso</h3>
            <p class="text-sm text-gray-600 mb-4">Solicita un reembolso para la transaccion confirmada.</p>
            <form action="/transaccion_completa/refund" method="post"
                class="tbk-form-stack tbk-form-stack-flex">
                @csrf
                <div>
                    <label for="refund_token_ws">Token</label>
                    <input id="refund_token_ws" class="w-full" type="text" name="token_ws" value="{{ $req['token_ws'] }}">
                </div>
                <div>
                    <label for="refund_amount">Monto</label>
                    <input id="refund_amount" class="w-full" type="number" name="amount" value="1000">
                </div>
                <button type="submit" class="tbk-btn-bottom">Solicitar reembolso</button>
            </form>
        </div>
    </div>
</div>
@endsection


