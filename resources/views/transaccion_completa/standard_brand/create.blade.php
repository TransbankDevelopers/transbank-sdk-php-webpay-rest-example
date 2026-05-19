@extends('layout')
@section('content')
<div class="w-full max-w-none">
    <h1 class="mb-2">Ejemplo Transacción Completa Estándar Marca</h1>
    <p class="text-gray-700 mb-6">
        Ingresa los datos de la tarjeta, comercio y autenticación para crear la transacción estándar marca.
    </p>

    <form action="/transaccion_completa/standard_brand/create" method="post" class="tbk-form-stack-lg">
        @csrf

        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <h3 class="font-bold mb-3">Datos generales</h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <h4 class="font-bold mb-2">Datos de transacción</h4>
                    <div class="tbk-field">
                        <label for="buy_order">Orden de compra</label>
                        <input id="buy_order" class="w-full" type="text" name="buy_order" value="{{ '123456' . rand(1,1000) }}" />
                    </div>

                    <div class="tbk-field">
                        <label for="session_id">Id de sesión</label>
                        <input id="session_id" class="w-full" type="text" name="session_id" value="{{ $sessionId ?? '' }}" />
                    </div>
                </div>
                <div>
                    <h4 class="font-bold mb-2">Datos de tarjeta</h4>
                    <div class="tbk-field">
                        <label for="card_number">Número de tarjeta</label>
                        <input id="card_number" class="w-full" type="text" name="card_number" />
                    </div>

                    <div class="tbk-field">
                        <label for="card_expiration_date">Fecha expiración tarjeta</label>
                        <input id="card_expiration_date" class="w-full" type="text" name="card_expiration_date" placeholder="YY/MM" maxlength="5" pattern="^\d{2}\/(0[1-9]|1[0-2])$" title="Usa formato YY/MM" inputmode="numeric" />
                    </div>

                    <div class="tbk-field">
                        <label for="cvv">CVV</label>
                        <input id="cvv" class="w-full" type="text" name="cvv" />
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <h3 class="font-bold mb-3">Detalles</h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="tbk-field">
                    <label for="details_amount">Monto</label>
                    <input id="details_amount" class="w-full" type="text" name="details[0][amount]" />
                </div>

                <div class="tbk-field">
                    <label for="details_commerce_code">Código de comercio</label>
                    <input id="details_commerce_code" class="w-full" type="text" name="details[0][commerce_code]" value="{{ $childCommerceCodes[0] }}" />
                </div>

                <div class="tbk-field">
                    <label for="details_buy_order">Orden de compra (hijo)</label>
                    <input id="details_buy_order" class="w-full" type="text" name="details[0][buy_order]" value="{{ '123456' . rand(1,1000) }}" />
                </div>

                <div class="tbk-field">
                    <label for="details_post_entry_mod">Post entry mode</label>
                    <select id="details_post_entry_mod" class="w-full" name="details[0][post_entry_mod]">
                        <option value="010">010</option>
                        <option value="810">810</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <h3 class="font-bold mb-3">Autenticación</h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="tbk-field">
                    <label for="details_eci">ECI</label>
                    <select id="details_eci" class="w-full" name="details[0][eci]">
                        <option value="">null - Transacción no autenticada</option>
                        <option value="05">VISA 05</option>
                        <option value="06">VISA 06</option>
                        <option value="02">MASTERCARD 02</option>
                        <option value="01">MASTERCARD 01</option>
                        <option value="05">AMEX 05</option>
                        <option value="06">AMEX 06</option>
                    </select>
                </div>

                <div class="tbk-field">
                    <label for="details_authentication_value">Authentication value</label>
                    <input id="details_authentication_value" class="w-full" type="text" name="details[0][authentication_value]" />
                </div>

                <div class="tbk-field">
                    <label for="details_message_version">Message version</label>
                    <input id="details_message_version" class="w-full" type="text" name="details[0][message_version]" />
                </div>

                <div class="tbk-field">
                    <label for="details_trans_status">Transaction status</label>
                    <select id="details_trans_status" class="w-full" name="details[0][trans_status]">
                        <option value="">No autenticada (null)</option>
                        <option value="C">C - Desafio requerido</option>
                        <option value="Y">Y - Elegible/Exitosa</option>
                        <option value="A">A - Intento de autenticacion</option>
                        <option value="N">N - No autenticada/Denegada</option>
                        <option value="R">R - Autenticacion rechazada</option>
                        <option value="D">D - Desafio desacoplado</option>
                        <option value="U">U - No se pudo autenticar</option>
                        <option value="I">I - Informativo/Exencion</option>
                    </select>
                </div>

                <div class="tbk-field">
                    <label for="details_ds_trans_id">DS Trans ID</label>
                    <input id="details_ds_trans_id" class="w-full" type="text" name="details[0][ds_trans_id]" />
                </div>

                <div class="tbk-field">
                    <label for="details_authentication_type">Authentication type</label>
                    <select id="details_authentication_type" class="w-full" name="details[0][authentication_type]">
                        <option value="">No challenge (null)</option>
                        <option value="C">C - Challenge</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <h3 class="font-bold mb-3">Recurrencia</h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="tbk-field">
                    <label for="details_identify_initiated_trx">Identify initiated trx</label>
                    <select id="details_identify_initiated_trx" class="w-full" name="details[0][identify_initiated_trx]">
                        <option value="">Seleccionar</option>
                        <option value="0">0 - Venta Unica</option>
                        <option value="1">1 - Primera CIT</option>
                        <option value="2">2 - Primera CIT Recurrencia MIT</option>
                        <option value="3">3 - Subsecuente CIT</option>
                        <option value="4">4 - Recurrente MIT</option>
                    </select>
                </div>

                <div class="tbk-field">
                    <label for="pmnt_ind">pmnt_ind</label>
                    <select id="pmnt_ind" class="w-full" name="details[0][pmnt_ind]">
                        <option value="">Ventas únicas</option>
                        <option value="C">C - Transacciones COF</option>
                        <option value="R">R - Transacciones recurrentes</option>
                    </select>
                </div>

                <div class="tbk-field">
                    <label for="recur_pmnt">recur_pmnt</label>
                    <select id="recur_pmnt" class="w-full" name="details[0][recur_pmnt]">
                        <option value="">Seleccionar</option>
                        <option value="F">F - Fijo</option>
                        <option value="V">V - Variable</option>
                    </select>
                </div>
            </div>
        </div>

        <button type="submit">Crear transacción</button>
    </form>

    <div class="sb-section">
        <a class="tbk-btn-link" href="/transaccion_completa/standard_brand/account-verify">Verificación de cuenta</a>
    </div>
</div>

<script>
    (function() {
        var expirationInput = document.getElementById('card_expiration_date');
        if (!expirationInput) return;
        expirationInput.addEventListener('input', function(e) {
            var value = e.target.value.replace(/\D/g, '').slice(0, 4);
            if (value.length >= 3) {
                value = value.slice(0, 2) + '/' + value.slice(2);
            }
            e.target.value = value;
        });
    })();
</script>
@endsection
