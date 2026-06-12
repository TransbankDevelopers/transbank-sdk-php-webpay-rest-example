@extends('layout')
@section('content')
<div class="w-full max-w-none">
    <h1 class="mb-2">Verificación de Cuenta Transacción Completa Estándar Marca sin CVV</h1>
    <p class="text-gray-700 mb-6">
        Ingresa los datos de tarjeta, autenticación y comercio para verificar la cuenta.
    </p>

    <form action="/transaccion_completa/standard_brand_without_cvv/account-verify" method="post" class="tbk-form-stack-lg">
        @csrf

        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <h3 class="font-bold mb-3">Datos de tarjeta</h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="tbk-field">
                    <label for="card_number">Número de tarjeta</label>
                    <input id="card_number" class="w-full" type="text" name="card_number" required />
                </div>

                <div class="tbk-field">
                    <label for="card_expiration_date">Fecha de expiración (YY/MM)</label>
                    <input id="card_expiration_date" class="w-full" type="text" name="card_expiration_date" placeholder="YY/MM" maxlength="5" pattern="^\d{2}\/(0[1-9]|1[0-2])$" title="Usa formato YY/MM" required />
                </div>

                <div class="tbk-field">
                    <label for="cvv">CVV</label>
                    <input id="cvv" class="w-full" type="text" name="cvv" required />
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <h3 class="font-bold mb-3">Autenticación</h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="tbk-field">
                    <label for="eci">ECI</label>
                    <input id="eci" class="w-full" type="text" name="eci" />
                </div>

                <div class="tbk-field">
                    <label for="authentication_value">Authentication value</label>
                    <input id="authentication_value" class="w-full" type="text" name="authentication_value" />
                </div>

                <div class="tbk-field">
                    <label for="trans_status">Transaction status</label>
                    <input id="trans_status" class="w-full" type="text" name="trans_status" />
                </div>

                <div class="tbk-field">
                    <label for="message_version">Message version</label>
                    <input id="message_version" class="w-full" type="text" name="message_version" />
                </div>

                <div class="tbk-field">
                    <label for="ds_trans_id">DS Trans ID</label>
                    <input id="ds_trans_id" class="w-full" type="text" name="ds_trans_id" />
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <h3 class="font-bold mb-3">Comercio</h3>
            <div class="tbk-field">
                <label for="commerce_code">Código de comercio</label>
                <input id="commerce_code" class="w-full" type="text" name="commerce_code" value="{{ $childCommerceCodes[0] ?? '' }}" required />
            </div>
        </div>

        <button type="submit">Verificar cuenta</button>
    </form>
</div>
@endsection
