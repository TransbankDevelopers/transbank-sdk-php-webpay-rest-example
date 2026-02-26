@extends('layout')
@section('content')
<div class="w-full max-w-none">
    <h1 class="mb-2">Transaccion Completa Mall creada</h1>
    <p class="text-gray-700 mb-6">
        La transaccion mall fue creada correctamente. Puedes autorizar directamente o consultar cuotas antes de autorizar.
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
        <input type="text" readonly value="{{ $res->getToken() }}" class="w-full bg-white" />
    </div>

    <h2 class="text-lg font-bold mb-3">Acciones</h2>
    <div class="mb-8">
        <div class="bg-white border border-gray-200 rounded-lg p-4 mb-6">
            <h3 class="font-bold mb-3">Autorizar</h3>
            <p class="text-sm text-gray-600 mb-4">Autoriza usando solo token y datos base de cada comercio hijo.</p>
            <form action="/transaccion_completa/mall_commit" method="post"
                style="display: flex; flex-direction:column; width:100%; font-size: 16px; gap: 10px; flex: 1;">
                @csrf
                <div>
                    <label for="mall_commit_token">Token</label>
                    <input id="mall_commit_token" class="w-full" name="token" value="{{ $res->getToken() }}">
                </div>

                @foreach ($details as $index => $detail)
                    <input type="hidden" name="details[{{ $index }}][commerce_code]" value="{{ $detail['commerce_code'] }}">
                    <input type="hidden" name="details[{{ $index }}][buy_order]" value="{{ $detail['buy_order'] }}">
                @endforeach

                <button type="submit" style="margin-top: auto;">Autorizar</button>
            </form>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4 w-full">
            <h3 class="font-bold mb-3">Consultar cuotas</h3>
            <p class="text-sm text-gray-600 mb-4">Consulta cuotas por cada comercio hijo antes de confirmar.</p>
            <form action="/transaccion_completa/mall_installments" method="post"
                style="display: flex; flex-direction:column; width:100%; font-size: 16px; gap: 10px; flex: 1;">
                @csrf
                <div>
                    <label for="mall_installments_token">Token</label>
                    <input id="mall_installments_token" class="w-full" type="text" name="token_ws" value="{{ $res->getToken() }}">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($details as $index => $detail)
                        <div class="border border-gray-200 rounded p-3">
                            <h4 class="font-bold mb-2">Comercio {{ $index + 1 }}</h4>
                            <label for="details_{{ $index }}_commerce_code">Codigo comercio</label>
                            <input id="details_{{ $index }}_commerce_code" class="w-full" name="details[{{ $index }}][commerce_code]" value="{{ $detail['commerce_code'] }}">

                            <label for="details_{{ $index }}_buy_order">Orden compra</label>
                            <input id="details_{{ $index }}_buy_order" class="w-full" name="details[{{ $index }}][buy_order]" value="{{ $detail['buy_order'] }}">

                            <label for="details_{{ $index }}_installments_number">Cuotas</label>
                            <input id="details_{{ $index }}_installments_number" class="w-full" type="number" name="details[{{ $index }}][installments_number]" value="3" min="2" max="12">
                        </div>
                    @endforeach
                </div>

                <button type="submit" style="margin-top: auto;">Consultar cuotas</button>
            </form>
        </div>
    </div>
</div>
@endsection
