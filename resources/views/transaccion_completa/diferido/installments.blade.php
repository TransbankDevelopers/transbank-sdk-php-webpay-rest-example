@extends('layout')
@section('content')
<div class="w-full max-w-none">
    <h1 class="mb-2">Transaccion Completa Diferida: cuotas consultadas</h1>
    <p class="text-gray-700 mb-6">
        La consulta de cuotas fue exitosa. Ahora puedes autorizar la transaccion diferida con los datos retornados.
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
        <input id="deferred_installments_token" type="text" readonly value="{{ $req['token_ws'] }}" class="w-full bg-white" />
    </div>

    <h2 class="text-lg font-bold mb-3">Acciones</h2>
    <div class="bg-white border border-gray-200 rounded-lg p-4 mb-8">
        <h3 class="font-bold mb-3">Autorizar transaccion diferida</h3>
        <p class="text-sm text-gray-600 mb-4">Completa los datos de autorizacion y envia la transaccion.</p>
        <form class="webpay_form" action="{{ route('completa.deferred.commit') }}" method="post"
            class="tbk-form-stack">
            @csrf
            <div>
                <label for="token_ws">
                    Token
                </label>
                <input id="token_ws" class="w-full" type="text" name="token_ws" value="{{ $req['token_ws'] }}">
            </div>
            <div>
                <label for="id_query_installments">
                    Id de cuotas
                </label>
                <input id="id_query_installments" class="w-full" type="text" name="id_query_installments" value="{{ $res->getIdQueryInstallments() }}" />
            </div>
            <div>
                <label for="deferred_period_index">
                    Cantidad de periodo diferido
                </label>
                <input id="deferred_period_index" class="w-full" type="number" name="deferred_period_index" value="1" />
            </div>
            <div>
                <label for="grace_period">
                    Periodo de Gracia
                </label>
                <input id="grace_period" class="w-full" type="text" name="grace_period" value="false">
            </div>
            <button type="submit">Autorizar</button>
        </form>
    </div>
</div>

@endsection
