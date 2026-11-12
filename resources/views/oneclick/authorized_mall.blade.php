@extends('layout')
@section('content')
<h1>Request</h1>
<pre> {{  print_r($req, true) }} </pre>


<h1>Response</h1>
<pre> {{  print_r($resp, true) }} </pre>


<h2>Estado de la transacción</h2>
<form method="post" action="/oneclick/mall/transactionStatus" >
    @csrf
    <label>Buy order: {{ $resp->getBuyOrder() }}</label>
    <input type="text" name="buy_order" value="{{  $resp->getBuyOrder() }}">

    <button type="submit">Enviar datos</button>
</form>



<h2>Reembolso de la transacción</h2>
@foreach ($resp->getDetails() as $detail)
    <form method="post" action="/oneclick/mall/refund" style="display: flex; flex-direction:column; width:50%;font-size: 16px; margin-bottom: 24px;">
        @csrf
        <label>Buy order padre</label>
        <input name="parent_buy_order" value="{{ $resp->getBuyOrder() }}" readonly>

        <label>Commerce code hijo</label>
        <input name="commerce_code" value="{{ $detail->getCommerceCode() }}" readonly>

        <label>Buy order hijo</label>
        <input name="child_buy_order" value="{{ $detail->getBuyOrder() }}" readonly>

        <label>Monto</label>
        <input name="amount" type="number" min="1" step="1" value="{{ $detail->getAmount() }}" required>

        <button type="submit">Reembolsar este comercio</button>
    </form>
@endforeach
@endsection
