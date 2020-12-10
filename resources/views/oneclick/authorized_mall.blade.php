@extends('layout')
@section('content')
<h1>Request</h1>
<pre> {{  var_dump($req) }} </pre>


<h1>Response</h1>
<pre> {{  var_dump($resp) }} </pre>


<h2>Estado de la transacción</h2>
<form method="post" action="/oneclick/mall/transactionStatus" >
    @csrf
    <label>Buy order: {{ $resp->getBuyOrder() }}</label>
    <input type="hidden" name="buy_order" value="{{  $resp->getBuyOrder() }}">

    <button type="submit">Enviar datos</button>
</form>



<h2>Reembolso de la transacción</h2>
<form method="post" action="/oneclick/mall/refund">
    @csrf
    <label>Buy order padre</label>
    <input name="parent_buy_order" value="{{ $resp->getBuyOrder() }}">

    <label>Commerce code hijo</label>
    <input name="commerce_code" value="{{ $resp->getDetails()[0]["commerce_code"] }}">

    <label>Buy order hijo</label>
    <input name="child_buy_order" value="{{ $resp->getDetails()[0]["buy_order"] }}">

    <label>Monto</label>
    <input name="amount" value="{{ $resp->getDetails()[0]["amount"] }}"/>

    <button type="submit">Enviar</button>
</form>
@endsection
