@extends('layout')
@section('content')
<div class="w-full max-w-none">
    <h1 class="mb-2">Transacción Completa Estándar Marca confirmada</h1>
    <p class="text-gray-700 mb-6">
        La autorización estándar marca fue confirmada. Desde aquí puedes consultar estado o solicitar reembolso.
    </p>

    <div class="grid grid-cols-1 gap-6 mb-6">
        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <h3 class="font-bold mb-2">Request</h3>
            <pre class="text-sm tbk-pre-wrap">{{ print_r($req, true) }}</pre>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <h3 class="font-bold mb-2">Response</h3>
            <pre class="text-sm tbk-pre-wrap">{{ print_r($res, true) }}</pre>
        </div>
    </div>

    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-8">
        <h2 class="text-base font-bold text-blue-900 mb-2">Token</h2>
        <input type="text" readonly value="{{ $req['token'] }}" class="w-full bg-white" />
    </div>

    <h2 class="text-lg font-bold mb-3">Acciones</h2>
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-8">
        <h3 class="font-bold mb-3">Consultar estado</h3>
        <form class="tbk-form-stack" action="/transaccion_completa/standard_brand/status" method="post">
            @csrf
            <div>
                <label for="status_token">Token</label>
                <input id="status_token" class="w-full" type="text" name="token" value="{{ $req['token'] }}">
            </div>
            <button type="submit">Consultar estado</button>
        </form>
    </div>

    <div class="w-full bg-white border border-gray-200 rounded-lg p-4 mb-8">
        <h3 class="font-bold mb-3">Reembolso</h3>
        <p class="text-sm text-gray-600 mb-4">Ingresa los datos de la transacción que quieres reembolsar.</p>
        <form class="tbk-form-stack" action="/transaccion_completa/standard_brand/refund" method="post">
            @csrf
            <div>
                <label for="refund_token">Token</label>
                <input id="refund_token" class="w-full" type="text" name="token" value="{{ $req['token'] }}">
            </div>

            <div>
                <label for="refund_commerce_code">Código de comercio</label>
                <input id="refund_commerce_code" class="w-full" type="text" name="commerce_code" value="{{ $req['commerce_code'] }}">
            </div>

            <div>
                <label for="refund_buy_order">Orden de compra (Tienda)</label>
                <input id="refund_buy_order" class="w-full" type="text" name="buy_order" value="{{ $req['buy_order'] }}">
            </div>

            <div>
                <label for="refund_amount">Monto</label>
                <input id="refund_amount" class="w-full" type="text" name="amount" value="{{ $req['amount'] ?? 1000 }}" />
            </div>

            <button type="submit">Solicitar reembolso</button>
        </form>
    </div>
</div>
@endsection
