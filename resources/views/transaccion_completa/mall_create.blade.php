@extends('layout')
@section('content')
<h1>Ejemplo Transaccion Completa Mall</h1>
<form action="mall_create" method="post" class="webpay_form" style="display: flex; flex-direction:column; width:50%;font-size: 20px;">
    @csrf
    <label for="buy_order">
        Ordern de Compra
    </label>
    <input type="text" name="buy_order" value="{{ '123456' . rand(1,1000) }}" />

    <label for="session_id">
        Id de Session
    </label>
    <input type="text" name="session_id" value="{{ '123456' . rand(1,1000) }}"/>

    <label for="card_number">
        Numero de Tarjeta
    </label>
    <input type="text" name="card_number" value="4051885600446623" />

    <label for="card_expiration_date">
        Fecha de Expiracion de tarjeta
    </label>
    <input type="text" name="card_expiration_date" value="22/10" />

    <label for="cvv">
        CVV
    </label>
    <input type="text" name="cvv" value="123" />

    @if (app()->environment('production'))
        <label for="merchant_1_amount">Monto Merchant 1</label>
        <input type="text" id="merchant_1_amount" name="details[0][amount]" value="10000" />

        <label for="merchant_1_commerce_code">Codigo de comercio Hijo 1</label>
        <input type="text" name="details[0][commerce_code]" value="{{ config('services.transbank.transaccion_completa_mall_child_cc') }}">

        <label for="merchant_1_buy_order">Orden de compra comercio Hijo 1</label>
        <input type="text" name="details[0][buy_order]" value="{{ '123456' . rand(1,1000) }}" />
    @else
        <label for="merchant_1_amount">Monto Merchant 1</label>
        <input type="text" id="merchant_1_amount" name="details[0][amount]" value="10000" />

        <label for="merchant_1_commerce_code">Codigo de comercio Hijo 1</label>
        <input type="text" name="details[0][commerce_code]" value="{{ $childCommerceCodes[0] }}">

        <label for="merchant_1_buy_order">Orden de compra comercio Hijo 1</label>
        <input type="text" name="details[0][buy_order]" value="{{ '123456' . rand(1,1000) }}" />

        <label for="merchant_2_amount">Monto Merchant 2</label>
        <input type="text" id="merchant_2_amount" name="details[1][amount]" value="10000" />

        <label for="merchant_2_commerce_code">Codigo de comercio Hijo 2</label>
        <input type="text" name="details[1][commerce_code]" value="{{ $childCommerceCodes[1] }}">

        <label for="merchant_2_buy_order">Orden de compra comercio Hijo 1</label>
        <input type="text" name="details[1][buy_order]" value="{{ '123456' . rand(1,1000) }}" />
    @endif

    <button type="submit">Aceptar</button>
</form>
@endsection
