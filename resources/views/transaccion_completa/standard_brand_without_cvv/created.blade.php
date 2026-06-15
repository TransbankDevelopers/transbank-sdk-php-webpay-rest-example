@extends('layout')
@section('content')
<div class="w-full max-w-none">
    <h1 class="mb-2">Transacción Completa Estándar Marca sin CVV creada</h1>
    <p class="text-gray-700 mb-6">
        La transacción estándar marca sin CVV fue creada correctamente. Puedes confirmar directamente o consultar cuotas antes de confirmar.
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
        <input type="text" readonly value="{{ $res['token'] ?? '' }}" class="w-full bg-white" />
    </div>

    <h2 class="text-lg font-bold mb-3">Acciones</h2>
    <div class="mb-8">
        <div class="bg-white border border-gray-200 rounded-lg p-4 mb-6">
            <h3 class="font-bold mb-3">Confirmar transacción</h3>
            <p class="text-sm text-gray-600 mb-4">Confirma usando token y datos base del comercio.</p>
            <form class="tbk-form-stack tbk-form-stack-flex" action="/transaccion_completa/standard_brand_without_cvv/commit" method="post">
                @csrf
                <div>
                    <label for="commit_token">Token</label>
                    <input id="commit_token" class="w-full" type="text" name="token" value="{{ $res['token'] ?? '' }}">
                </div>

                <div>
                    <label for="commit_commerce_code">Código de comercio</label>
                    <input id="commit_commerce_code" class="w-full" type="text" name="commerce_code" value="{{ $req['details'][0]['commerce_code'] ?? '' }}">
                </div>

                <div>
                    <label for="commit_buy_order">Orden de compra (hijo)</label>
                    <input id="commit_buy_order" class="w-full" type="text" name="buy_order" value="{{ $req['details'][0]['buy_order'] ?? '' }}">
                </div>

                <input type="hidden" name="amount" value="{{ $req['details'][0]['amount'] ?? '' }}" />

                <button type="submit" class="tbk-btn-bottom">Confirmar transacción</button>
            </form>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4 w-full">
            <h3 class="font-bold mb-3">Consultar cuotas</h3>
            <p class="text-sm text-gray-600 mb-4">Consulta cuotas antes de confirmar la transacción.</p>
            <form class="tbk-form-stack tbk-form-stack-flex" method="post" action="/transaccion_completa/standard_brand_without_cvv/installments">
                @csrf
                <div>
                    <label for="installments_token">Token</label>
                    <input id="installments_token" class="w-full" name="token" value="{{ $res['token'] ?? '' }}" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="installments_buy_order">Orden de compra (hijo)</label>
                        <input id="installments_buy_order" class="w-full" name="buy_order" value="{{ $req['details'][0]['buy_order'] ?? '' }}" />
                    </div>

                    <div>
                        <label for="installments_commerce_code">Código de comercio</label>
                        <input id="installments_commerce_code" class="w-full" name="commerce_code" value="{{ $req['details'][0]['commerce_code'] ?? '' }}" />
                    </div>

                    <div>
                        <label for="installments_number">Número de cuotas</label>
                        <input id="installments_number" class="w-full" name="installments_number" value="10" />
                    </div>
                </div>

                <input type="hidden" name="amount" value="{{ $req['details'][0]['amount'] ?? '' }}" />

                <button type="submit" class="tbk-btn-bottom">Consultar cuotas</button>
            </form>
        </div>
    </div>
</div>
@endsection
