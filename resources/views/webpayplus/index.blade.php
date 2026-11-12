@extends('layout')
@section('content')
    <div class="operations-home">
        <h1 class="operations-home__title">Webpay Plus</h1>
        <p class="operations-home__intro">Inicia un pago o administra una transacción existente con su token.</p>

        <section class="operations-home__section">
            <h2 class="operations-home__section-title">Nuevo pago</h2>
            <p class="operations-home__description">Continúa al formulario para crear una transacción Webpay Plus.</p>
            <a class="tbk-btn-link operations-home__primary-action" href="{{ url('/webpayplus/create') }}">Iniciar nuevo flujo de pago</a>
        </section>

        <section class="operations-home__section">
            <h2 class="operations-home__section-title">Consultar estado</h2>
            <form class="operations-home__form" method="post" action="{{ url('/webpayplus/transactionStatus') }}">
                @csrf
                <label for="status-token">Token de la transacción</label>
                <input id="status-token" name="token" type="text" required autocomplete="off">
                <button type="submit">Consultar estado</button>
            </form>
        </section>

        <section class="operations-home__section">
            <h2 class="operations-home__section-title">Anular o reembolsar</h2>
            <p class="operations-home__description">Envía una solicitud de reembolso para una transacción confirmada. Ingresa el monto a reembolsar.</p>
            <form class="operations-home__form" method="post" action="{{ url('/webpayplus/refund') }}">
                @csrf
                <label for="refund-token">Token de la transacción</label>
                <input id="refund-token" name="token" type="text" required autocomplete="off">
                <label for="refund-amount">Monto a reembolsar</label>
                <input id="refund-amount" name="amount" type="number" min="1" step="1" required>
                <button type="submit">Solicitar reembolso</button>
            </form>
        </section>
    </div>
@endsection
