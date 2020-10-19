@extends('layout')
@section('content')
<h1>Ejemplo Webpay Plus Transaccion Mall</h1>

<form class="webpay_form" action="createMall" method="post" style="display: flex; flex-direction:column; width:50%;font-size: 20px;">
    @csrf

    <label for="merchant_1_amount">Monto comercio 1</label>
    <input id="merchant_1_amount" name="detail[0][amount]" value="1000">

    <label for="merchant_1_commerce_code">Código comercio del comercio 1</label>
    <input id="merchant_1_commerce_code" name="detail[0][commerce_code]" value="597055555537">

    <label for="merchant_1_buy_order">Orden de compra comercio 1</label>
    <input id="merchant_1_buy_order" name="detail[0][buy_order]" value="123buyorder1">


    <label for="merchant_2_amount">Monto comercio 2</label>
    <input id="merchant_2_amount" name="detail[1][amount]" value="2000">

    <label for="merchant_2_commerce_code">Código comercio del comercio 2</label>
    <input id="merchant_2_commerce_code" name="detail[1][commerce_code]" value="597055555536">

    <label for="merchant_2_buy_order">Orden de compra comercio 2</label>
    <input id="merchant_2_buy_order" name="detail[1][buy_order]" value="123buyorder2">


    <label for="parent_merchant_buy_order">Orden de compra comercio Padre</label>
    <input id="parent_merchant_buy_order" name="buy_order" value="222333"/>

    <label for="session_id_parent">
        Session id comercio padre
    </label>
    <input id="session_id_parent" name="session_id" value="123session_parent">


    <label for="return_url">
        URL de retorno
    </label>
    <input id="return_url" name="return_url" value="http://{{ $_SERVER['HTTP_HOST'] }}/webpayplus/mallReturnUrl"/>

    <button type="submit">Aceptar</button>
</form>
@endsection
