@extends('layout')
@section('content')

@if(!$challenge)

    <h1>Request</h1>
    <pre>{{ print_r($req, true) }}</pre>

    <h1>Response</h1>
    <pre>{{ print_r($resp, true) }}</pre>

    <h2>Estado de la transacción</h2>
    <form method="post" action="/oneclick/standard_brand/mall/transactionStatus">
        @csrf
        <label>Buy order:</label>
        <input type="text" name="buy_order" value="{{ $resp->getBuyOrder() }}">

        <button type="submit">Enviar datos</button>
    </form>

    <h2>Reembolso de la transacción</h2>
    <form method="post" action="/oneclick/standard_brand/mall/refund">
        @csrf
        <label>Buy order padre</label>
        <input name="parent_buy_order" value="{{ $resp->getBuyOrder() }}">

        <label>Commerce code hijo</label>
        <input name="commerce_code" value="{{ $resp->getDetails()->getCommerceCode() }}">

        <label>Buy order hijo</label>
        <input name="child_buy_order" value="{{ $resp->getDetails()->getBuyOrder() }}">

        <label>Monto</label>
        <input name="amount" value="{{ $resp->getDetails()->getAmount() }}"/>

        <button type="submit">Enviar</button>
    </form>

@else

    <div id="challengeModal" class="modal" style="display: block;">
        <div class="modal-content" style="width: 600px; margin: auto; background: white; padding: 20px;">
            <h1>Modal del desafio</h1>
            <iframe 
                src="{{ url('/oneclick/standard_brand/mall/challenge-start') }}?token={{ $resp->getChallengeData()->getParameters()->getBrowserChallengeToken() }}&url={{ urlencode($resp->getChallengeData()->getBaseUrl()) }}"
                style="width:100%; height:500px; border:none;">
            </iframe>
            <a class="text-gray-800 no-underline" href="{{ url('/home') }}"><i class="fa fa-home"></i> Inicio</a>
        </div>
    </div>
@endif

@endsection
