@extends('layout')
@section('content')
<h1>Ejemplo Webpay Plus Transaccion Mall</h1>

<form class="webpay_form" action="createMall" method="post" style="display: flex; flex-direction:column; width:50%;font-size: 20px;">
    @csrf

    @if (app()->environment('production'))
        @foreach($commerceCodeList as $i => $child)
            @if($child['type_child'] == '3DS')
                <span> Tienda Piloto 3DS {{$child['commerce_code']}} </span>
            @else
                <span> Tienda Normal {{$child['commerce_code']}} </span>
            @endif

            <label for="merchant_{{$i}}_amount">Monto comercio</label>
            <input id="merchant_{{$i}}_amount" name="detail[{{$i}}][amount]" value="1000">

            <label for="merchant_{{$i}}_commerce_code">Código comercio del comercio</label>
            <input id="merchant_{{$i}}_commerce_code" name="detail[{{$i}}][commerce_code]" value="{{$child['commerce_code']}}">

            <label for="merchant_{{$i}}_buy_order">Orden de compra comercio</label>
            <input id="merchant_{{$i}}_buy_order" name="detail[{{$i}}][buy_order]" value="buyorder_{{Str::random(10)}}">
        @endforeach

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
