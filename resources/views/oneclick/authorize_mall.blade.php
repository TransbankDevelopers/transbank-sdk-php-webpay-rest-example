@extends('layout')
@section('content')
    <div class="operations-home">
        <h1 class="operations-home__title">Autorizar pago Oneclick Mall</h1>
        <p class="operations-home__intro">Completa los datos del usuario ya inscrito y de la nueva transacción.</p>

        <form class="operations-home__form" method="post" action="{{ url('/oneclick/mall/authorizeTransaction') }}">
            @csrf
            <section class="operations-home__section">
                <h2 class="operations-home__section-title">Inscripción existente</h2>
                <label for="username">Nombre de usuario</label>
                <input id="username" name="username" type="text" required autocomplete="username">

                <label for="tbk-user">Identificador TBK_USER</label>
                <input id="tbk-user" name="tbk_user" type="text" required autocomplete="off">
            </section>

            <section class="operations-home__section">
                <h2 class="operations-home__section-title">Datos de la transacción</h2>
                <label for="buy-order">Orden de compra padre</label>
                <input id="buy-order" name="buy_order" type="text" value="{{ rand(100000000, 999999999) }}" maxlength="26" required autocomplete="off">

                @include('oneclick.partials.commerce_details')
            </section>

            <button class="operations-home__submit" type="submit">Autorizar transacción</button>
        </form>
    </div>
@endsection
