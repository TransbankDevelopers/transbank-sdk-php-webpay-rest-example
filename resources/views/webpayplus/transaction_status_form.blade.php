@extends('layout')
@section('pageClass', 'result-page')
@section('content')
    <h1>Consultar estado de una transacción Webpay Plus</h1>
    <form class="sb-form" method="post" action="{{ url('/webpayplus/transactionStatus') }}">
        @csrf
        <label for="status-token">Token de la transacción</label>
        <input id="status-token" name="token" type="text" required autocomplete="off">
        <button type="submit">Consultar estado</button>
    </form>
@endsection
