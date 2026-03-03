@extends('layout')
@section('content')
<div class="w-full max-w-none">
    <h1 class="mb-2">Transacción Completa Mall: cuotas consultadas</h1>
    <p class="text-gray-700 mb-6">
        La consulta de cuotas fue exitosa. Ahora puedes autorizar la transacción mall con esos resultados.
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
        <input type="text" readonly value="{{ $req['token_ws'] }}" class="w-full bg-white" />
    </div>

    <h2 class="text-lg font-bold mb-3">Acciones</h2>
    <div class="bg-white border border-gray-200 rounded-lg p-4 mb-8">
        <h3 class="font-bold mb-3">Autorizar transacción mall</h3>
        <p class="text-sm text-gray-600 mb-4">Confirma la transacción usando los datos de cuotas por comercio hijo.</p>
        <form action="/transaccion_completa/mall_commit" method="post"
            class="tbk-form-stack">
            @csrf
            <div>
                <label for="mall_token">Token</label>
                <input id="mall_token" class="w-full" name="token" value="{{ $req['token_ws'] }}">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($details as $index => $detail)
                    <div class="border border-gray-200 rounded p-3">
                        <h4 class="font-bold mb-2">Comercio {{ $index + 1 }}</h4>
                        @php $installmentResponse = $res[$index] ?? null; @endphp
                        <label for="details_{{ $index }}_commerce_code">Código comercio</label>
                        <input id="details_{{ $index }}_commerce_code" class="w-full" name="details[{{ $index }}][commerce_code]" value="{{ $detail['commerce_code'] }}">

                        <label for="details_{{ $index }}_buy_order">Orden compra</label>
                        <input id="details_{{ $index }}_buy_order" class="w-full" name="details[{{ $index }}][buy_order]" value="{{ $detail['buy_order'] }}">

                        <label for="details_{{ $index }}_id_query_installments">Id query installments</label>
                        <input id="details_{{ $index }}_id_query_installments" class="w-full" name="details[{{ $index }}][id_query_installments]" value="{{ $installmentResponse ? $installmentResponse->getIdQueryInstallments() : '' }}">

                        <label for="details_{{ $index }}_deferred_period_index">Deferred period index</label>
                        <select id="details_{{ $index }}_deferred_period_index" class="w-full" name="details[{{ $index }}][deferred_period_index]">
                            @php $deferredPeriods = $installmentResponse ? ($installmentResponse->getDeferredPeriods() ?? []) : []; @endphp
                            @forelse ($deferredPeriods as $period)
                                <option value="{{ $period }}" {{ $loop->first ? 'selected' : '' }}>{{ $period }}</option>
                            @empty
                                <option value="" selected>No disponible para esta consulta</option>
                            @endforelse
                        </select>

                        @if (!$installmentResponse)
                            <p class="text-red-700 text-sm mt-2">Sin datos de cuotas para este comercio.</p>
                        @endif

                        <label for="details_{{ $index }}_grace_period">Periodo de gracia</label>
                        <select id="details_{{ $index }}_grace_period" class="w-full" name="details[{{ $index }}][grace_period]">
                            <option value="true">true</option>
                            <option value="false" selected>false</option>
                        </select>
                    </div>
                @endforeach
            </div>

            <button type="submit">Autorizar</button>
        </form>
    </div>
</div>
@endsection
