@extends('layout')
@section('content')

    <h1>Webpay Plus Mall Reembolso exitoso</h1>

    <pre> {{  print_r($resp, true) }} </pre>

    <a class="mt-10 block" href="./status/{{ $req['token'] }}">&lt;&lt; Volver al estado de la transacción</a>
@endsection
