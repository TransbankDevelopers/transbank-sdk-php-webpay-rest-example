@extends('layout')
@section('content')
    <h1>Ejemplo transacción completa mall Reembolso de la transacción</h1>

    <h2>Request</h2>
    {{ print_r($req) }}
    <h2>Response</h2>
    {{ print_r($res) }}
@endsection
