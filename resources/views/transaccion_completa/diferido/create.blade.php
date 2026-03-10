@extends('layout')
@section('content')
    @php
        $routeNames = $routeNames ?? [
            'index' => 'completa.diferido.index',
            'create' => 'completa.deferred.create',
            'installments' => 'completa.deferred.installments',
            'commit' => 'completa.deferred.commit',
            'capture' => 'completa.deferred.capture',
            'status' => 'completa.deferred.status',
            'refund' => 'completa.deferred.refund',
        ];
        $productLabel = $productLabel ?? 'Transacción Completa Diferida';
    @endphp
    <h1>{{ $productLabel }}</h1>
    <form class="webpay_form tbk-form-narrow" action="{{ route($routeNames['create']) }}" method="post">
        @csrf
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

        <label for="card_number">
            Numero de tarjeta
        </label>
        <input id="card_number" name="card_number" value="{{ app()->environment('production') ? '' : '4051885600446623' }}"/>

        <label for="card_expiration_date">
            Fecha expiración tarjeta
        </label>
        <input id="card_expiration_date" name="card_expiration_date" placeholder="MM/YY" maxlength="5" pattern="^(0[1-9]|1[0-2])\/\d{2}$" title="Usa formato MM/YY" inputmode="numeric" value="{{ app()->environment('production') ? '' : '10/22' }}"/>

        <label for="cvv">
            cvv
        </label>
        <input id="cvv" name="cvv" value="{{ app()->environment('production') ? '' : '123' }}"/>

        <button type="submit">Aceptar</button>
    </form>
    <script>
        (function() {
            var expirationInput = document.getElementById('card_expiration_date');
            if (!expirationInput) return;
            expirationInput.addEventListener('input', function(e) {
                var value = e.target.value.replace(/\D/g, '').slice(0, 4);
                if (value.length >= 3) {
                    value = value.slice(0, 2) + '/' + value.slice(2);
                }
                e.target.value = value;
            });
        })();
    </script>
@endsection
