@extends('layout')
@section('content')
<h1>Ejemplo Webpay Plus Transaccion Mall Prueba cuotas QR</h1>

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
                <input type="checkbox" id="cbox1" name="detail[0][active]" checked value="1">
            </td>
            <td>
                <input id="merchant_1_commerce_code" name="detail[0][commerce_code]" value="{{ $commerceCodeList[0]['commerce_code'] }}">
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
                <input type="checkbox" id="cbox2" name="detail[1][active]" checked value="1">
            </td>
            <td>
                <input id="merchant_2_commerce_code" name="detail[1][commerce_code]" value="{{ $commerceCodeList[1]['commerce_code'] }}">
            </td>
            <td>
                <input id="merchant_2_buy_order" name="detail[1][buy_order]" value="buyorder_{{Str::random(10)}}">
            </td>
            <td>
                <input id="merchant_2_amount" name="detail[1][amount]" value="1000">
            </td>
        </tr>
        </table>
    @else
        <table>
        <tr>
            <th>Activo</th>
            <th>Comercio</th>
            <th>Orden Compra</th>
            <th>Monto</th>
        </tr>
        <tr>
            <td>
                <input type="checkbox" id="cbox1" name="detail[0][active]" checked value="1">
            </td>
            <td>
                <input id="merchant_1_commerce_code" name="detail[0][commerce_code]" value="597055555536">
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
                <input type="checkbox" id="cbox2" name="detail[1][active]" checked value="1">
            </td>
            <td>
                <input id="merchant_2_commerce_code" name="detail[1][commerce_code]" value="597055555537">
            </td>
            <td>
                <input id="merchant_2_buy_order" name="detail[1][buy_order]" value="buyorder_{{Str::random(10)}}">
            </td>
            <td>
                <input id="merchant_2_amount" name="detail[1][amount]" value="1000">
            </td>
        </tr>

        </table>
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
    <input id="return_url" name="return_url" value="{{ route('webpayplusduesqr.commit') }}"/>

    <button type="submit">Aceptar</button>
</form>
@endsection
