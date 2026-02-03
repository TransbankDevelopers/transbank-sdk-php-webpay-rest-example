@extends('layout')
@section('content')
    <h1>Reembolso - Transacción Completa Estándar Marca</h1>

    <h3>Parámetros recibidos:</h3>
    <pre>
    {{ print_r($req) }}
</pre>

    <h3>Respuesta:</h3>
    <pre>
    {{ print_r($res) }}
</pre>


    <h3>Consultar estado</h3>
    <form class="webpay_form sb-form" action="/transaccion_completa/standard_brand/status" method="post">
        @csrf
        <label for="token">Token</label>
        <input type="text" name="token" value="{{ $req['token'] }}">
        <button type="submit">Consultar estado</button>
    </form>
@endsection
