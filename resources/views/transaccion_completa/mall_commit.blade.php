@extends('layout')
@section('content')
<div class="w-full max-w-none">
    <h1 class="mb-2">Transaccion Completa Mall confirmada</h1>
    <p class="text-gray-700 mb-6">
        La autorizacion mall fue confirmada. Desde aqui puedes consultar estado o solicitar reembolso por comercio hijo.
    </p>

    <div class="grid grid-cols-1 gap-6 mb-6">
        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <h3 class="font-bold mb-2">Request</h3>
            <pre class="text-sm" style="white-space: pre-wrap; word-break: break-word; overflow-wrap: anywhere; max-width: 100%; overflow-x: auto;">{{ print_r($req, true) }}</pre>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <h3 class="font-bold mb-2">Response</h3>
            <pre class="text-sm" style="white-space: pre-wrap; word-break: break-word; overflow-wrap: anywhere; max-width: 100%; overflow-x: auto;">{{ print_r($res, true) }}</pre>
        </div>
    </div>

    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-8">
        <h2 class="text-base font-bold text-blue-900 mb-2">Token</h2>
        <input type="text" readonly value="{{ $req['token'] }}" class="w-full bg-white" />
    </div>

    <h2 class="text-lg font-bold mb-3">Acciones</h2>
    <div class="mb-8">
        <h3 class="font-bold mb-3">Consultar estado</h3>
        <form action="/transaccion_completa/mall_status/{{ $req['token'] }}" method="get">
            <button type="submit">Consultar estado</button>
        </form>
    </div>

    <div class="w-full bg-white border border-gray-200 rounded-lg p-4 mb-8">
        <h3 class="font-bold mb-3">Reembolso</h3>
        <p class="text-sm text-gray-600 mb-4">Selecciona el comercio hijo que quieres reembolsar.</p>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            @foreach ($res->getDetails() as $index => $detail)
                <div class="border border-gray-200 rounded p-3">
                    <h4 class="font-bold mb-3">Comercio {{ $index + 1 }}</h4>
                    <form action="/transaccion_completa/mall_refund" method="post"
                        style="display: flex; flex-direction:column; width:100%; font-size: 16px; gap: 10px;">
                        @csrf
                        <div>
                            <label for="refund_token_{{ $index }}">Token</label>
                            <input id="refund_token_{{ $index }}" class="w-full" name="token" value="{{ $req['token'] }}">
                        </div>
                        <div>
                            <label for="refund_child_commerce_code_{{ $index }}">Codigo comercio hijo</label>
                            <input id="refund_child_commerce_code_{{ $index }}" class="w-full" name="child_commerce_code" value="{{ $detail->getCommerceCode() }}">
                        </div>
                        <div>
                            <label for="refund_child_buy_order_{{ $index }}">Orden compra hijo</label>
                            <input id="refund_child_buy_order_{{ $index }}" class="w-full" name="child_buy_order" value="{{ $detail->getBuyOrder() }}">
                        </div>
                        <div>
                            <label for="refund_amount_{{ $index }}">Monto</label>
                            <input id="refund_amount_{{ $index }}" class="w-full" name="amount" value="{{ $detail->getAmount() }}">
                        </div>
                        <button type="submit">Solicitar reembolso</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
