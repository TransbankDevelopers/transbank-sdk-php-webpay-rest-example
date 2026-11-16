{{--
    Vista intermedia compartida por los productos Oneclick Mall.
    Recibe la configuración de App\Support\OneclickIndexViewConfig.
--}}
<div class="operations-home">
    <h1 class="operations-home__title">{{ $title }}</h1>
    <p class="operations-home__intro">Inscribe una tarjeta para autorizar pagos o administra una transacción existente.</p>

    <section class="operations-home__section">
        <h2 class="operations-home__section-title">Nueva inscripción y pago</h2>
        <p class="operations-home__description">Inscribe al usuario y su tarjeta. Al finalizar, podrás autorizar una transacción Oneclick.</p>
        <div class="operations-home__actions">
            <a class="tbk-btn-link operations-home__primary-action" href="{{ url($inscriptionUrl) }}">Iniciar inscripción</a>
            @if ($authorizeUrl)
                <a class="tbk-btn-link operations-home__primary-action" href="{{ url($authorizeUrl) }}">Autorizar con una inscripción existente</a>
            @endif
        </div>
    </section>

    <section class="operations-home__section">
        <h2 class="operations-home__section-title">Consultar estado</h2>
        <p class="operations-home__description">Consulta una transacción usando la orden de compra del comercio padre.</p>
        <form class="operations-home__form" method="post" action="{{ url($statusUrl) }}">
            @csrf
            <label for="status-buy-order">Orden de compra padre</label>
            <input id="status-buy-order" name="buy_order" type="text" required autocomplete="off">
            <button type="submit">Consultar estado</button>
        </form>
    </section>

    <section class="operations-home__section">
        <h2 class="operations-home__section-title">Reembolsar transacción</h2>
        <p class="operations-home__description">{{ $title }} requiere las órdenes de compra padre e hija, el código del comercio hijo y el monto.</p>
        <form class="operations-home__form" method="post" action="{{ url($refundUrl) }}">
            @csrf
            <label for="refund-parent-buy-order">Orden de compra padre</label>
            <input id="refund-parent-buy-order" name="parent_buy_order" type="text" required autocomplete="off">
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
                    value="{{ $childCommerceCodes[0] ?? '' }}"
                    required
                    autocomplete="off"
                >
            @endif
            <label for="refund-child-buy-order">Orden de compra hija</label>
            <input id="refund-child-buy-order" name="child_buy_order" type="text" required autocomplete="off">
            <label for="refund-amount">Monto a reembolsar</label>
            <input id="refund-amount" name="amount" type="number" min="1" step="1" required>
            <button type="submit">Solicitar reembolso</button>
        </form>
    </section>

    <section class="operations-home__section">
        <h2 class="operations-home__section-title">Eliminar inscripción</h2>
        <p class="operations-home__description">Elimina la tarjeta inscrita usando el identificador Oneclick (TBK_USER) y el nombre de usuario.</p>
        <form class="operations-home__form" method="post" action="{{ url($deleteUrl) }}">
            @csrf
            @if ($deleteMethod !== 'POST')
                @method($deleteMethod)
            @endif
            <label for="delete-user-name">Nombre de usuario</label>
            <input id="delete-user-name" name="user_name" type="text" required autocomplete="off">
            <label for="delete-tbk-user">Identificador TBK_USER</label>
            <input id="delete-tbk-user" name="tbk_user" type="text" required autocomplete="off">
            <button type="submit">Eliminar inscripción</button>
        </form>
    </section>
</div>
