@extends('layout')
@section('content')
    <h1>Transaccion Completa</h1>
    <form class="webpay_form" action="create" method="post" style="display: flex; flex-direction:column; width:50%;font-size: 20px;">
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

        <label for="card_number">
            Numero de tarjeta
        </label>
        <input id="card_number" name="card_number" value="4051885600446623"/>

        <label for="card_expiration_date">
            Fecha expiracion tarjeta
        </label>
        <input id="card_expiration_date" name="card_expiration_date" value="22/10"/>

        <label for="cvv">
            cvv
        </label>
        <input id="cvv" name="cvv" value="123"/>

        <button type="submit">Aceptar</button>
    </form>
@endsection
