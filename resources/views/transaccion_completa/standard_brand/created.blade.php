@extends('layout')
@section('content')
    <h1>Transacción Completa Estándar Marca creada</h1>

    <h3>Parámetros recibidos:</h3>
    <pre>
    {{ print_r($req, true) }}
</pre>

    <h3>Respuesta:</h3>
    <pre>
    {{ print_r($res, true) }}
</pre>

    <form class="webpay_form sb-form" method="post" action="/transaccion_completa/standard_brand/installments">
        @csrf
        <label for="token">Token</label>
        <input name="token" value="{{ $res['token'] ?? '' }}" />

        <label for="buy_order">Orden de compra (hijo)</label>
        <input name="buy_order" value="{{ $req['details'][0]['buy_order'] ?? '' }}" />

        <label for="commerce_code">Código de comercio</label>
        <input name="commerce_code" value="{{ $req['details'][0]['commerce_code'] ?? '' }}" />

        <input type="hidden" name="amount" value="{{ $req['details'][0]['amount'] ?? '' }}" />

        <label for="installments_number">Número de cuotas</label>
        <input name="installments_number" value="10" />

        <button type="submit">Consultar cuotas</button>
    </form>

    <form class="webpay_form sb-form" action="/transaccion_completa/standard_brand/commit" method="post">
        @csrf
        <label for="token">Token</label>
        <input type="text" name="token" value="{{ $res['token'] ?? '' }}">

        <label for="commerce_code">Código de comercio</label>
        <input type="text" name="commerce_code" value="{{ $req['details'][0]['commerce_code'] ?? '' }}">

        <label for="buy_order">Orden de compra (hijo)</label>
        <input type="text" name="buy_order" value="{{ $req['details'][0]['buy_order'] ?? '' }}">

        <input type="hidden" name="amount" value="{{ $req['details'][0]['amount'] ?? '' }}" />

        <button type="submit">Confirmar transacción</button>
    </form>
@endsection
