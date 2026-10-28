@extends('layout')
@section('content')
<h1>Ejemplo Webpay Mall Monotienda - Bines</h1>

<form class="webpay_form tbk-form-stack tbk-form-narrow" action="/webpayplus/mall/monotienda-bines/create" method="post">
    @csrf

    @if (app()->environment('production'))
        <span>Comercio hijo {{$childCommerceCode}}</span>
        <label for="merchant_1_amount">Monto comercio</label>
        <input id="merchant_1_amount" name="detail[0][amount]" value="1000">
        <label for="merchant_1_commerce_code">Código comercio del comercio hijo</label>
        <input id="merchant_1_commerce_code" name="detail[0][commerce_code]" value="{{$childCommerceCode}}">
        <label for="merchant_1_buy_order">Orden de compra comercio</label>
        <input id="merchant_1_buy_order" name="detail[0][buy_order]" value="buyorder_{{Str::random(10)}}">
    @else
        <label for="merchant_1_amount">Monto comercio 1</label>
        <input id="merchant_1_amount" name="detail[0][amount]" value="1000">
        <label for="merchant_1_commerce_code">Código comercio del comercio #1</label>
        <input id="merchant_1_commerce_code" name="detail[0][commerce_code]" value="597055555536">
        <label for="merchant_1_buy_order">Orden de compra comercio #1</label>
        <input id="merchant_1_buy_order" name="detail[0][buy_order]" value="buyorder_{{Str::random(10)}}">
    @endif


    <label for="parent_merchant_buy_order">Orden de compra comercio Padre</label>
    <input id="parent_merchant_buy_order" name="buy_order" value="buyorder_{{Str::random(10)}}"/>

    <label for="session_id_parent">
        Session id comercio padre
    </label>
    <input id="session_id_parent" name="session_id" value="{{Str::random(20)}}">


    <label for="return_url">
        URL de retorno
    </label>
        <input id="return_url" name="return_url" value="{{ url('/') }}/webpayplus/mall/monotienda-bines/returnUrl"/>

    <button type="submit">Aceptar</button>
</form>
@endsection
