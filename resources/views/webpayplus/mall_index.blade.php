{{--
    Vista intermedia compartida por los productos Webpay Plus Mall.
    Recibe la configuración de App\Support\WebpayPlusMallIndexViewConfig.
--}}
@extends('layout')
@section('content')
    <div class="operations-home">
        <h1 class="operations-home__title">{{ $title }}</h1>
        <p class="operations-home__intro">Inicia un pago o administra una transacción existente con su token.</p>

        <section class="operations-home__section">
            <h2 class="operations-home__section-title">Nuevo pago</h2>
            <p class="operations-home__description">Continúa al formulario para crear una transacción {{ $title }}.</p>
            <a class="tbk-btn-link operations-home__primary-action" href="{{ url($createUrl) }}">Iniciar nuevo flujo de pago</a>
        </section>

        <section class="operations-home__section">
            <h2 class="operations-home__section-title">Consultar estado</h2>
            <form class="operations-home__form" method="post" action="{{ url($statusUrl) }}">
                @csrf
                <label for="status-token">Token de la transacción</label>
                <input id="status-token" name="token" type="text" required autocomplete="off">
                <button type="submit">Consultar estado</button>
            </form>
        </section>

        <section class="operations-home__section">
            <h2 class="operations-home__section-title">Anular o reembolsar</h2>
            <p class="operations-home__description">En un mall se reembolsa por tienda: ingresa el token, el código del comercio hijo, su orden de compra y el monto.</p>
            <form class="operations-home__form" method="post" action="{{ url($refundUrl) }}">
                @csrf
                <label for="refund-token">Token de la transacción</label>
                <input id="refund-token" name="token" type="text" required autocomplete="off">

                <label for="refund-commerce-code">Código de comercio hijo</label>
                @if (count($childCommerceCodes) > 1)
                    <select id="refund-commerce-code" name="{{ $commerceCodeField }}" required>
                        @foreach ($childCommerceCodes as $code)
                            <option value="{{ $code }}">{{ $code }}</option>
                        @endforeach
                    </select>
                @else
                    <input
                        id="refund-commerce-code"
                        name="{{ $commerceCodeField }}"
                        type="text"
                        value="{{ $childCommerceCodes[0] ?? '' }}"
                        required
                        autocomplete="off"
                    >
                @endif

                <label for="refund-buy-order">Orden de compra hija</label>
                <input id="refund-buy-order" name="{{ $buyOrderField }}" type="text" required autocomplete="off">

                <label for="refund-amount">Monto a reembolsar</label>
                <input id="refund-amount" name="amount" type="number" min="1" step="1" required>
                <button type="submit">Solicitar reembolso</button>
            </form>
        </section>
    </div>
@endsection
