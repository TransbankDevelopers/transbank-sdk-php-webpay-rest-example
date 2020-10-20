@extends('layout')
@section('content')
    <h1> Ejemplo Webpay Refund </h1>


    <form method="post" action="refund">
        @csrf
        <label for="amount">Monto de la reversa</label>
        <input id="amount" name="amount" value="1000">

        <label for="token">Token</label>
        <input id="token" name="token" value="e229435b68a3f1c048121d68cc4ccb0b8765abd82d61d01e6cd2334db1473375">

        <button type="submit">Enviar datos</button>


    </form>
@endsection
