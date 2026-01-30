@extends('layout')
@section('content')
    <h1>Ejemplo Transacción Completa Standard Brand</h1>

    <form action="/transaccion_completa/standard_brand/create" method="post" class="webpay_form sb-form">
        @csrf
        <label for="buy_order">Orden de compra</label>
        <input type="text" name="buy_order" value="{{ 'vic-c-t' }}" />

        <label for="session_id">Id de sesión</label>
        <input type="text" name="session_id" value="{{ '597026008018' }}" />

        <label for="card_number">Número de tarjeta</label>
        <input type="text" name="card_number" value="4051885600446623" />

        <label for="card_expiration_date">Fecha de expiración (MM/YY)</label>
        <input type="text" name="card_expiration_date" value="31/12" />

        <label for="cvv">CVV</label>
        <input type="text" name="cvv" value="123" />

        <h3>Detalles</h3>
        <label for="details_amount">Monto</label>
        <input type="text" name="details[0][amount]" value="20100" />

        <label for="details_commerce_code">Código de comercio</label>
        <input type="text" name="details[0][commerce_code]" value="{{ $childCommerceCodes[0] ?? '597038367138' }}" />

        <label for="details_buy_order">Orden de compra (hijo)</label>
        <input type="text" name="details[0][buy_order]" value="victor-c-t" />

        <label for="details_post_entry_mod">Post entry mode</label>
        <input type="text" name="details[0][post_entry_mod]" value="010" />

        <label for="details_eci">ECI</label>
        <input type="text" name="details[0][eci]" />

        <label for="details_authentication_value">Authentication value</label>
        <input type="text" name="details[0][authentication_value]" />

        <label for="details_message_version">Message version</label>
        <input type="text" name="details[0][message_version]" />

        <label for="details_trans_status">Transaction status</label>
        <input type="text" name="details[0][trans_status]" />

        <label for="details_ds_trans_id">DS Trans ID</label>
        <input type="text" name="details[0][ds_trans_id]" />

        <label for="details_authentication_type">Authentication type</label>
        <input type="text" name="details[0][authentication_type]" />

        <label for="details_identify_initiated_trx">Identify initiated trx</label>
        <input type="text" name="details[0][identify_initiated_trx]" value="0" />

        <label for="pmnt_ind">pmnt_ind</label>
        <input type="text" name="details[0][pmnt_ind]" />

        <label for="recur_pmnt">recur_pmnt</label>
        <input type="text" name="details[0][recur_pmnt]" />

        <button type="submit">Crear transacción</button>
    </form>

    <div class="sb-section">
        <a href="/transaccion_completa/standard_brand/account-verify">Verificación de cuenta</a>
    </div>
@endsection
