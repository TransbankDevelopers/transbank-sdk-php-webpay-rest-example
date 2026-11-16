@extends('layout')
@section('content')
    <div class="operations-home">
        <h1 class="operations-home__title">Capturar transacción</h1>
        <p class="operations-home__intro">Webpay Plus Mall Captura Diferida: confirma el cobro de una tienda de una transacción autorizada.</p>

        <section class="operations-home__section">
            <p class="operations-home__description">En un mall se captura por tienda. Usa los datos del comercio hijo que devolvió la confirmación; el monto puede ser igual o menor al autorizado.</p>
            <form class="operations-home__form" method="post" action="{{ url('/webpayplus/mall/diferido/capture') }}">
                @csrf
                <label for="capture-token">Token de la transacción</label>
                <input id="capture-token" name="token" type="text" value="{{ request('token') }}" required autocomplete="off">

                <label for="capture-commerce-code">Código de comercio hijo</label>
                @if (count($childCommerceCodes) > 1)
                    <select id="capture-commerce-code" name="commerce_code" required>
                        @foreach ($childCommerceCodes as $code)
                            <option value="{{ $code }}" @if (request('commerce_code') === $code) selected @endif>{{ $code }}</option>
                        @endforeach
                    </select>
                @else
                    <input id="capture-commerce-code" name="commerce_code" type="text" value="{{ request('commerce_code', $childCommerceCodes[0] ?? '') }}" required autocomplete="off">
                @endif

                <label for="capture-buy-order">Orden de compra hija</label>
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
