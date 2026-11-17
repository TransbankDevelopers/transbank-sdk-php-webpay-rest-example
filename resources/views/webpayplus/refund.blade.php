@extends('layout')
@section('pageClass', 'result-page')
@section('content')
    <h1> Ejemplo Webpay Refund </h1>


    <form method="post" action="refund">
        @csrf
        <label for="amount">Monto de la reversa</label>
        <input id="amount" name="amount" type="number" min="1" step="1" required>

        <label for="token">Token</label>
        <input id="token" name="token" type="text" required autocomplete="off">

        <button type="submit">Enviar datos</button>


    </form>
@endsection
