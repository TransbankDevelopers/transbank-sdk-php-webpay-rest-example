@extends('layout')
@section('content')
    <h1>{{ $productLabel }}</h1>
    <form class="webpay_form tbk-form-narrow" action="{{ route($routeNames['create']) }}" method="post">
        @csrf
        <div class="tbk-card-slot">
            @include('partials.card_form', [
                'format' => 'MM/YY',
                'defaults' => app()->environment('production') ? [] : [
                    'number' => '4051885600446623',
                    'expiration' => '10/22',
                    'cvv' => '123',
                ],
            ])
        </div>

        <label for="buy_order">
            Orden de compra
        </label>
        <input id="buy_order" name="buy_order" value="{{ "TxCompletaDiferido".rand(1000, 50000) }}"/>

        <label for="session_id">
            Id de sesión
        </label>
        <input id="session_id" name="session_id" value="session123456" />

        <label for="amount">
            Monto
        </label>
        <input id="amount" name="amount" value="1000"/>

        <button type="submit">Aceptar</button>
    </form>
@endsection
