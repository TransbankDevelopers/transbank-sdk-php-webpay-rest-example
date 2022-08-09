@extends('layout')
@section('content')
<h1>Ejemplo Webpay Plus Transaccion Mall QR</h1>

<form class="webpay_form" action="createMall" method="post" style="display: flex; flex-direction:column; width:50%;font-size: 20px;">
    @csrf

    @if (app()->environment('production'))
        <table>
        <tr>
            <th>Activo</th>
            <th>Comercio</th>
            <th>Orden Compra</th>
            <th>Monto</th>
        </tr>
        <tr>
            <td>
                <input type="checkbox" id="cbox1" value="1">
            </td>
            <td>
                <input id="merchant_1_commerce_code" name="detail[0][commerce_code]" value="{{ config('services.transbank.webpay_plus_mall_child1_qr_cc') }}">
            </td>
            <td>
                <input id="merchant_1_buy_order" name="detail[0][buy_order]" value="buyorder_{{Str::random(10)}}">
            </td>
            <td>
                <input id="merchant_1_amount" name="detail[0][amount]" value="1000">
            </td>
        </tr>
        <tr>
            <td>
                <input type="checkbox" id="cbox2" value="1">
            </td>
            <td>
                <input id="merchant_2_commerce_code" name="detail[1][commerce_code]" value="{{ config('services.transbank.webpay_plus_mall_child2_qr_cc') }}">
            </td>
            <td>
                <input id="merchant_2_buy_order" name="detail[1][buy_order]" value="buyorder_{{Str::random(10)}}">
            </td>
            <td>
                <input id="merchant_2_amount" name="detail[1][amount]" value="1000">
            </td>
        </tr>
        <tr>
            <td>
                <input type="checkbox" id="cbox3" value="1">
            </td>
            <td>
                <input id="merchant_3_commerce_code" name="detail[2][commerce_code]" value="{{ config('services.transbank.webpay_plus_mall_child3_qr_cc') }}">
            </td>
            <td>
                <input id="merchant_3_buy_order" name="detail[2][buy_order]" value="buyorder_{{Str::random(10)}}">
            </td>
            <td>
                <input id="merchant_3_amount" name="detail[2][amount]" value="1000">
            </td>
        </tr>
        </table> 
    @else
        <label for="merchant_1_amount">Monto comercio 1</label>
        <input id="merchant_1_amount" name="detail[0][amount]" value="1000">

        <label for="merchant_1_commerce_code">Código comercio del comercio #1</label>
        <input id="merchant_1_commerce_code" name="detail[0][commerce_code]" value="597055555536">

        <label for="merchant_1_buy_order">Orden de compra comercio #1</label>
        <input id="merchant_1_buy_order" name="detail[0][buy_order]" value="buyorder_{{Str::random(10)}}">

        <label for="merchant_2_amount">Monto comercio #2</label>
        <input id="merchant_2_amount" name="detail[1][amount]" value="2000">

        <label for="merchant_2_commerce_code">Código comercio del comercio #2</label>
        <input id="merchant_2_commerce_code" name="detail[1][commerce_code]" value="597055555537">

        <label for="merchant_2_buy_order">Orden de compra comercio #2</label>
        <input id="merchant_2_buy_order" name="detail[1][buy_order]" value="buyorder_{{Str::random(10)}}">
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
    <input id="return_url" name="return_url" value="{{ url('/') }}/webpayplus/mallReturnUrl"/>

    <button type="submit">Aceptar</button>
</form>
@endsection
