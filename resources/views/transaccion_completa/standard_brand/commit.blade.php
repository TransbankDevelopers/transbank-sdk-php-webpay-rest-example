@extends('layout')
@section('content')
    <h1>Transacción confirmada - Transacción Completa Estándar Marca</h1>

    <h3>Parámetros recibidos:</h3>
    <pre>
    {{ print_r($req, true) }}
</pre>

    <h3>Respuesta:</h3>
    <pre>
    {{ print_r($res, true) }}
</pre>

    <h3>Consultar estado</h3>
    <form class="webpay_form sb-form" action="/transaccion_completa/standard_brand/status" method="post">
        @csrf
        <label for="token">Token</label>
        <input type="text" name="token" value="{{ $req['token'] }}">
        <button type="submit">Consultar estado</button>
    </form>

    <h3>Reembolso</h3>
    <form class="webpay_form sb-form" action="/transaccion_completa/standard_brand/refund" method="post">
        @csrf
        <label for="token">Token</label>
        <input type="text" name="token" value="{{ $req['token'] }}">

        <label for="commerce_code">Código de comercio</label>
        <input type="text" name="commerce_code" value="{{ $req['commerce_code'] }}">

        <label for="buy_order">Orden de compra (Tienda)</label>
        <input type="text" name="buy_order" value="{{ $req['buy_order'] }}">

        <label for="amount">Monto</label>
        <input type="text" name="amount" value="{{ $req['amount'] ?? 1000 }}" />

        <button type="submit">Reembolsar</button>
    </form>
@endsection
