@extends('layout')
@section('content')
<div class="w-full max-w-none">
    <h1 class="mb-2">Transacción Completa Mall</h1>
    <p class="text-gray-700 mb-6">
        Ingresa los datos de la tarjeta y de cada comercio hijo para crear la transacción mall.
    </p>

    <form action="/transaccion_completa/mall_create" method="post"
        class="tbk-form-stack-lg">
        @csrf

        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <h3 class="font-bold mb-3">Datos de tarjeta</h3>
            @include('partials.card_form', [
                'format' => 'MM/YY',
                'defaults' => app()->environment('production') ? [] : [
                    'number' => '4051885600446623',
                    'expiration' => '10/22',
                    'cvv' => '123',
                ],
            ])
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <h3 class="font-bold mb-3">Datos de transacción</h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="tbk-field">
                    <label for="buy_order">Orden de compra</label>
                    <input id="buy_order" class="w-full" type="text" name="buy_order" value="{{ '123456' . rand(1,1000) }}" />
                </div>

                <div class="tbk-field">
                    <label for="session_id">Id de sesión</label>
                    <input id="session_id" class="w-full" type="text" name="session_id" value="{{ '123456' . rand(1,1000) }}"/>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <h3 class="font-bold mb-3">Comercios hijos</h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                @if (app()->environment('production'))
                    <div class="border border-gray-200 rounded p-3">
                        <h4 class="font-bold mb-2">Comercio 1</h4>
                        <div class="tbk-field">
                            <label for="merchant_1_amount">Monto</label>
                            <input id="merchant_1_amount" class="w-full" type="text" name="details[0][amount]" value="10000" />
                        </div>

                        <div class="tbk-field">
                            <label for="merchant_1_commerce_code">Código comercio hijo</label>
                            <input id="merchant_1_commerce_code" class="w-full" type="text" name="details[0][commerce_code]" value="{{ config('services.transbank.transaccion_completa_mall_child_cc') }}">
                        </div>

                        <div class="tbk-field">
                            <label for="merchant_1_buy_order">Orden compra comercio hijo</label>
                            <input id="merchant_1_buy_order" class="w-full" type="text" name="details[0][buy_order]" value="{{ '123456' . rand(1,1000) }}" />
                        </div>
                    </div>
                @else
                    <div class="border border-gray-200 rounded p-3">
                        <h4 class="font-bold mb-2">Comercio 1</h4>
                        <div class="tbk-field">
                            <label for="merchant_1_amount">Monto</label>
                            <input id="merchant_1_amount" class="w-full" type="text" name="details[0][amount]" value="10000" />
                        </div>

                        <div class="tbk-field">
                            <label for="merchant_1_commerce_code">Código comercio hijo</label>
                            <input id="merchant_1_commerce_code" class="w-full" type="text" name="details[0][commerce_code]" value="{{ $childCommerceCodes[0] }}">
                        </div>

                        <div class="tbk-field">
                            <label for="merchant_1_buy_order">Orden compra comercio hijo</label>
                            <input id="merchant_1_buy_order" class="w-full" type="text" name="details[0][buy_order]" value="{{ '123456' . rand(1,1000) }}" />
                        </div>
                    </div>

                    <div class="border border-gray-200 rounded p-3">
                        <h4 class="font-bold mb-2">Comercio 2</h4>
                        <div class="tbk-field">
                            <label for="merchant_2_amount">Monto</label>
                            <input id="merchant_2_amount" class="w-full" type="text" name="details[1][amount]" value="10000" />
                        </div>

                        <div class="tbk-field">
                            <label for="merchant_2_commerce_code">Código comercio hijo</label>
                            <input id="merchant_2_commerce_code" class="w-full" type="text" name="details[1][commerce_code]" value="{{ $childCommerceCodes[1] }}">
                        </div>

                        <div class="tbk-field">
                            <label for="merchant_2_buy_order">Orden compra comercio hijo</label>
                            <input id="merchant_2_buy_order" class="w-full" type="text" name="details[1][buy_order]" value="{{ '123456' . rand(1,1000) }}" />
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <button type="submit">Crear transacción mall</button>
    </form>
</div>
@endsection
