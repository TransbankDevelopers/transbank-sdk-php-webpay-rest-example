@extends('layout')
@section('content')
    @include('webpayplus.partials.simple_create', [
        'title' => 'Webpay Plus - Bines',
        'intro' => 'Crea una transacción y redirige al cliente al formulario de pago de Webpay.',
        'action' => '/webpayplus/bines/create',
        'buyOrder' => '123456',
        'sessionId' => 'session123456',
        'amount' => 1000,
        'returnUrl' => url('/') . '/webpayplus/bines/returnUrl',
    ])
@endsection
