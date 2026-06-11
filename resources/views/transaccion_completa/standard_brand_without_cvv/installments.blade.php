@extends('layout')
@section('content')
<div class="w-full max-w-none">
    <h1 class="mb-2">Cuotas consultadas Transacción Completa Estándar Marca sin CVV</h1>
    <p class="text-gray-700 mb-6">
        Revisa la respuesta de cuotas y confirma la transacción usando el identificador recibido.
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
    <div class="bg-white border border-gray-200 rounded-lg p-4 mb-8">
        <h3 class="font-bold mb-3">Confirmar transacción</h3>
        <p class="text-sm text-gray-600 mb-4">Confirma la transacción usando el identificador de cuotas recibido.</p>
        <form class="tbk-form-stack" action="/transaccion_completa/standard_brand_without_cvv/commit" method="post">
            @csrf
            <div>
                <label for="commit_token">Token</label>
                <input id="commit_token" class="w-full" type="text" name="token" value="{{ $req['token'] }}">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="commit_commerce_code">Código de comercio</label>
                    <input id="commit_commerce_code" class="w-full" type="text" name="commerce_code" value="{{ $req['commerce_code'] }}">
                </div>

                <div>
                    <label for="commit_buy_order">Orden de compra (hijo)</label>
                    <input id="commit_buy_order" class="w-full" type="text" name="buy_order" value="{{ $req['buy_order'] }}">
                </div>

                <div>
                    <label for="commit_id_query_installments">Id de cuotas</label>
                    <input id="commit_id_query_installments" class="w-full" type="text" name="id_query_installments" value="{{ $res['id_query_installments'] ?? '' }}" />
                </div>
            </div>

            <input type="hidden" name="amount" value="{{ $req['amount'] ?? '' }}" />

            <button type="submit">Confirmar transacción</button>
        </form>
    </div>
</div>
@endsection
