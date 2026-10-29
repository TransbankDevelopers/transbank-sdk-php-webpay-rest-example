@extends('layout')
@section('content')

    <h1>Ejemplo Webpay Plus - Bines</h1>

    <form class="webpay_form tbk-form-stack tbk-form-narrow" action="/webpayplus/bines/create" method="post">
        @csrf
        <label for="buy_order">
            Orden de compra
        </label>
        <input id="buy_order" name="buy_order" value="123456"/>

        <label for="session_id">
            Id de sesión
        </label>
        <input id="session_id" name="session_id" value="session123456" />

        <label for="amount">
            Monto
        </label>
        <input id="amount" name="amount" value="1000"/>


        <label for="return_url">
            URL de retorno
        </label>
        <input id="return_url" name="return_url" value="{{ url('/') }}/webpayplus/bines/returnUrl"/>

        <button type="submit">Aceptar</button>
    </form>
@endsection
