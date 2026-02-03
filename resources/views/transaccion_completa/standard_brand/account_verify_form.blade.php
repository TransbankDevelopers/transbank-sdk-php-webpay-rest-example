@extends('layout')
@section('content')
    <h1>Verificación de Cuenta - Transacción Completa Estándar Marca</h1>

    <form action="/transaccion_completa/standard_brand/account-verify" method="post" class="webpay_form sb-form">
        @csrf
        <label for="card_number">Número de tarjeta</label>
        <input type="text" name="card_number" value="4051885600446623" />

        <label for="card_expiration_date">Fecha de expiración (MM/YY)</label>
        <input type="text" name="card_expiration_date" value="31/12" />

        <label for="cvv">CVV</label>
        <input type="text" name="cvv" value="123" />

        <label for="eci">ECI</label>
        <input type="text" name="eci" />

        <label for="authentication_value">Authentication value</label>
        <input type="text" name="authentication_value" />

        <label for="trans_status">Transaction status</label>
        <input type="text" name="trans_status" />

        <label for="message_version">Message version</label>
        <input type="text" name="message_version" />

        <label for="ds_trans_id">DS Trans ID</label>
        <input type="text" name="ds_trans_id" />

        <label for="commerce_code">Código de comercio</label>
        <input type="text" name="commerce_code" value="{{ $childCommerceCodes[0] ?? '597038367138' }}" />

        <button type="submit">Verificar cuenta</button>
    </form>
@endsection
