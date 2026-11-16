{{--
    Vista intermedia compartida por todos los productos Transacción Completa.
    Recibe la configuración de App\Support\TransaccionCompletaIndexViewConfig.
--}}
@extends('layout')
@section('content')
    @php($isMall = is_array($childCommerceCodes))
    <div class="operations-home">
        <h1 class="operations-home__title">{{ $title }}</h1>
        <p class="operations-home__intro">{{ $intro }}</p>

        <section class="operations-home__section">
            <h2 class="operations-home__section-title">Nuevo pago</h2>
            <p class="operations-home__description">Continúa al formulario para crear una transacción con los datos de la tarjeta{{ $isMall ? ' y del comercio hijo' : '' }}.</p>
            <div class="operations-home__actions">
                <a class="tbk-btn-link operations-home__primary-action" href="{{ url($createUrl) }}">Iniciar nuevo flujo de pago</a>
            </div>
        </section>

        <section class="operations-home__section">
            <h2 class="operations-home__section-title">Consultar estado</h2>
            <p class="operations-home__description">Consulta una transacción usando su token.</p>
            <form class="operations-home__form" method="post" action="{{ url($statusUrl) }}">
                @csrf
                <label for="status-token">Token de la transacción</label>
                <input id="status-token" name="{{ $statusTokenField }}" type="text" maxlength="64" required autocomplete="off">
                <button type="submit">Consultar estado</button>
            </form>
        </section>

        <section class="operations-home__section">
            <h2 class="operations-home__section-title">Anular o reembolsar</h2>
            <p class="operations-home__description">{{ $isMall ? 'Requiere el token, el código del comercio hijo, la orden de compra hija y el monto.' : 'Requiere el token y el monto a reembolsar.' }}</p>
            <form class="operations-home__form" method="post" action="{{ url($refundUrl) }}">
                @csrf
                <label for="refund-token">Token de la transacción</label>
                <input id="refund-token" name="{{ $refundTokenField }}" type="text" maxlength="64" required autocomplete="off">
                @if ($isMall)
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
                            maxlength="12"
                            value="{{ $childCommerceCodes[0] ?? '' }}"
                            required
                            autocomplete="off"
                        >
                    @endif
                    <label for="refund-buy-order">Orden de compra hija</label>
                    <input id="refund-buy-order" name="{{ $buyOrderField }}" type="text" maxlength="26" required autocomplete="off">
                @endif
                <label for="refund-amount">Monto a reembolsar</label>
                <input id="refund-amount" name="amount" type="number" min="1" step="1" required>
                <button type="submit">Solicitar reembolso</button>
            </form>
        </section>
    </div>
@endsection
