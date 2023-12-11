@extends('layout')
@section('content')
<h1>Oneclick Mall Captura realizada</h1>

<h1>Request</h1>
<pre> {{  print_r($req, true) }} </pre>


<h1>Response</h1>
<pre> {{  print_r($resp, true) }} </pre>

<br><hr>
<h2>Estado de la transacción</h2>
<form method="post" action="/oneclick/mall/diferido/transaction_status" >
    <input type="hidden" name="buy_order" value="{{  $req['parent_buy_order'] }}">
    <button type="submit">Consultar estado</button>
</form>
<br><hr>
<h2>Reembolso de la transacción</h2>
<form method="post" action="/oneclick/mall/diferido/refund">
    <input type="hidden" name="parent_buy_order" value="{{ $req['parent_buy_order'] }}">
    <input type="hidden" name="commerce_code" value="{{ $req['commerce_code'] }}">
    <input type="hidden" name="child_buy_order" value="{{ $req['buy_order'] }}">

    <label>Monto</label>
    <input name="amount" value="{{ $req['amount'] }}"/>

    <button type="submit">Reembolsar</button>
</form>

@endsection
