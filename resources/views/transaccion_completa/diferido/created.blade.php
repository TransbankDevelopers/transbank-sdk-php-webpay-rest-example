@extends('layout')
@section('content')
@php
    $routeNames = $routeNames ?? [
        'index' => 'completa.diferido.index',
        'create' => 'completa.deferred.create',
        'installments' => 'completa.deferred.installments',
        'commit' => 'completa.deferred.commit',
        'capture' => 'completa.deferred.capture',
        'status' => 'completa.deferred.status',
        'refund' => 'completa.deferred.refund',
    ];
    $productLabel = $productLabel ?? 'Transacción Completa Diferida';
    $token = $ui['token'] ?? null;
@endphp
<div class="w-full max-w-none">
    <h1 class="mb-2">{{ $productLabel }} creada</h1>
    <p class="text-gray-700 mb-6">
        La transacción diferida fue creada correctamente. El siguiente paso es consultar cuotas con el token generado.
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
        <input id="deferred_token" type="text" readonly value="{{ $token }}" class="w-full bg-white" />
    </div>

    <h2 class="text-lg font-bold mb-3">Acciones</h2>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-white border border-gray-200 rounded-lg p-4 h-full flex flex-col">
            <h3 class="font-bold mb-3">Autorizar</h3>
            <p class="text-sm text-gray-600 mb-4">Confirma la transacción usando el token generado.</p>
            <form class="webpay_form tbk-form-stack tbk-form-stack-flex" method="post" action="{{ route($routeNames['commit']) }}">
                @csrf
                <div>
                    <label for="commit_token_ws">
                        Token
                    </label>
                    <input id="commit_token_ws" class="w-full" name="token_ws" value="{{ $token }}" />
                </div>
                <button type="submit" class="tbk-btn-bottom">Autorizar</button>
            </form>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4 h-full flex flex-col">
            <h3 class="font-bold mb-3">Consultar cuotas</h3>
            <p class="text-sm text-gray-600 mb-4">Indica la cantidad de cuotas a consultar para esta transacción.</p>
            <form class="webpay_form tbk-form-stack tbk-form-stack-flex" method="post" action="{{ route($routeNames['installments']) }}">
                @csrf
                <div>
                    <label for="token_ws">
                        Token
                    </label>
                    <input id="token_ws" class="w-full" name="token_ws" value="{{ $token }}" />
                </div>
                <div>
                    <label for="installments_number">
                        Cuotas
                    </label>
                    <input id="installments_number" class="w-full" type="number" name="installments_number" value="3" min="2" max="12" />
                </div>

                <button type="submit" class="tbk-btn-bottom">Consultar cuotas</button>
            </form>
        </div>
    </div>
</div>

@endsection
