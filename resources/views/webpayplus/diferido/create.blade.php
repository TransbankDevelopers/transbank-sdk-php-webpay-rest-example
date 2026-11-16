@extends('layout')
@section('content')
    @include('webpayplus.partials.simple_create', [
        'title' => 'Webpay Plus Captura Diferida',
        'intro' => 'Crea una transacción que solo se autoriza; el cobro se confirma después con una captura.',
        'action' => '/webpayplus/diferido/create',
        'buyOrder' => '123456' . rand(1, 1000),
        'sessionId' => 'session123456',
        'amount' => 1000,
        'returnUrl' => url('/') . '/webpayplus/diferido/returnUrl',
    ])
@endsection
