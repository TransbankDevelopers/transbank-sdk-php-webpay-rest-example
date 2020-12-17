@extends('layout')
@section('content')
    <h1>Oneclick Mall Autorización realizada</h1>

<h1>Request</h1>
<pre> {{  print_r($req, true) }} </pre>

<h1>Response</h1>
<pre> {{  print_r($resp, true) }} </pre>

<h2>Capturar transacción</h2>
<form action="/oneclick/mall/diferido/capture" method="post">
    @csrf
    <label for="commerce_code">Código de Comercio (Tienda Hija)</label>
    <input type="text" name="commerce_code" value="{{ $resp->getDetails()[0]['commerce_code'] }}">
    <label for="buy_order">Orden de compra comercio hijo</label>
    <input type="text" name="buy_order" value="{{ $resp->getDetails()[0]['buy_order'] }}">
    <label for="authorization_code">Código de autorización</label>
    <input type="text" name="authorization_code" value="{{ $resp->getDetails()[0]['authorization_code'] }}">
    <label for="amount">Monto</label>
    <input type="text" name="amount" value="1000">

    <input type="text" name="parent_buy_order" value="{{ $resp->getBuyOrder() }}">

    <button type="submit">Enviar datos</button>
</form>
@endsection
