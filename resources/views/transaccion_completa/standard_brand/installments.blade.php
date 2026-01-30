@extends('layout')
@section('content')
    <h1>Cuotas consultadas - Transacción Completa Standard Brand</h1>

    <h3>Parámetros recibidos:</h3>
    <pre>
    {{ print_r($req) }}
</pre>

    <h3>Respuesta:</h3>
    <pre>
    {{ print_r($res) }}
</pre>

    <form class="webpay_form sb-form" action="/transaccion_completa/standard_brand/commit" method="post">
        @csrf
        <label for="token">Token</label>
        <input type="text" name="token" value="{{ $req['token'] }}">

        <label for="commerce_code">Código de comercio</label>
        <input type="text" name="commerce_code" value="{{ $req['commerce_code'] }}">

        <label for="buy_order">Orden de compra (hijo)</label>
        <input type="text" name="buy_order" value="{{ $req['buy_order'] }}">

        <label for="id_query_installments">Id de cuotas</label>
        <input type="text" name="id_query_installments" value="{{ $res['id_query_installments'] ?? '' }}" />

        <input type="hidden" name="amount" value="{{ $req['amount'] ?? '' }}" />

        <button type="submit">Confirmar transacción</button>
    </form>
@endsection
