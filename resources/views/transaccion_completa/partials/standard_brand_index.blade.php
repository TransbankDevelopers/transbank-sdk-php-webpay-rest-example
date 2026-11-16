{{--
    Vista intermedia compartida por Transacción Completa Mall Estándar Marca (con y sin CVV).
    Parámetros: $title, $intro, $basePath, $childCommerceCodes
--}}
<div class="operations-home">
    <h1 class="operations-home__title">{{ $title }}</h1>
    <p class="operations-home__intro">{{ $intro }}</p>

    <section class="operations-home__section">
        <h2 class="operations-home__section-title">Nuevo pago</h2>
        <p class="operations-home__description">Continúa al formulario para crear una transacción con los datos de la tarjeta y del comercio hijo.</p>
        <div class="operations-home__actions">
            <a class="tbk-btn-link operations-home__primary-action" href="{{ url($basePath . '/create') }}">Iniciar nuevo flujo de pago</a>
        </div>
    </section>

    <section class="operations-home__section">
        <h2 class="operations-home__section-title">Consultar estado</h2>
        <p class="operations-home__description">Consulta una transacción usando su token.</p>
        <form class="operations-home__form" method="post" action="{{ url($basePath . '/status') }}">
            @csrf
            <label for="status-token">Token de la transacción</label>
            <input id="status-token" name="token" type="text" maxlength="64" required autocomplete="off">
            <button type="submit">Consultar estado</button>
        </form>
    </section>

    <section class="operations-home__section">
        <h2 class="operations-home__section-title">Anular o reembolsar</h2>
        <p class="operations-home__description">Requiere el token, el código del comercio hijo, la orden de compra hija y el monto.</p>
        <form class="operations-home__form" method="post" action="{{ url($basePath . '/refund') }}">
            @csrf
            <label for="refund-token">Token de la transacción</label>
            <input id="refund-token" name="token" type="text" maxlength="64" required autocomplete="off">
            <label for="refund-commerce-code">Código de comercio hijo</label>
            @if (count($childCommerceCodes) > 1)
                <select id="refund-commerce-code" name="commerce_code" required>
                    @foreach ($childCommerceCodes as $code)
                        <option value="{{ $code }}">{{ $code }}</option>
                    @endforeach
                </select>
            @else
                <input
                    id="refund-commerce-code"
                    name="commerce_code"
                    type="text"
                    maxlength="12"
                    value="{{ $childCommerceCodes[0] ?? '' }}"
                    required
                    autocomplete="off"
                >
            @endif
            <label for="refund-buy-order">Orden de compra hija</label>
            <input id="refund-buy-order" name="buy_order" type="text" maxlength="26" required autocomplete="off">
            <label for="refund-amount">Monto a reembolsar</label>
            <input id="refund-amount" name="amount" type="number" min="1" step="1" required>
            <button type="submit">Solicitar reembolso</button>
        </form>
    </section>
</div>
