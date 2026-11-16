@extends('layout')
@section('content')
    <div class="operations-home">
        <h1 class="operations-home__title">Capturar transacción</h1>
        <p class="operations-home__intro">Webpay Plus Captura Diferida: confirma el cobro de una transacción autorizada.</p>

        <section class="operations-home__section">
            <p class="operations-home__description">Usa los datos que devolvió la confirmación de la transacción. El monto puede ser igual o menor al autorizado.</p>
            <form class="operations-home__form" method="post" action="{{ url('/webpayplus/diferido/capture') }}">
                @csrf
                <label for="capture-token">Token de la transacción</label>
                <input id="capture-token" name="token" type="text" value="{{ request('token') }}" required autocomplete="off">
                <label for="capture-buy-order">Orden de compra</label>
                <input id="capture-buy-order" name="buy_order" type="text" value="{{ request('buy_order') }}" required autocomplete="off">
                <label for="capture-authorization-code">Código de autorización</label>
                <input id="capture-authorization-code" name="authorization_code" type="text" value="{{ request('authorization_code') }}" required autocomplete="off">
                <label for="capture-amount">Monto a capturar</label>
                <input id="capture-amount" name="capture_amount" type="number" min="1" step="1" value="{{ request('amount') }}" required>
                <button type="submit">Capturar</button>
            </form>
        </section>
    </div>
@endsection
