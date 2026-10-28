@extends('layout')
@section('content')

    <h1>Webpay Mall Monotienda - Bines Reembolso exitoso</h1>

    <pre> {{  print_r($resp, true) }} </pre>

    <a class="mt-10 block" href="/webpayplus/mall/monotienda-bines/create">Volver al inicio</a>
@endsection
