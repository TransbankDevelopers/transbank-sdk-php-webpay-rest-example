@extends('layout')
@section('content')
    @php
        if (app()->environment('production')) {
            $children = [
                ['code' => config('services.transbank.webpay_plus_mall_deferred_child_cc'), 'buyOrder' => time() + rand(1, 1000), 'amount' => 1000],
            ];
        } else {
            $children = [
                ['code' => \Transbank\Webpay\WebpayPlus::DEFAULT_MALL_DEFERRED_CHILD_COMMERCE_CODE_1, 'buyOrder' => time() + rand(1, 1000), 'amount' => 1000],
                ['code' => \Transbank\Webpay\WebpayPlus::DEFAULT_MALL_DEFERRED_CHILD_COMMERCE_CODE_2, 'buyOrder' => time() + rand(1, 1000), 'amount' => 2000],
            ];
        }
    @endphp
    @include('webpayplus.partials.mall_create', [
        'title' => 'Webpay Plus Mall Captura Diferida',
        'intro' => 'Crea una transacción mall que solo se autoriza; cada tienda se captura después por separado.',
        'action' => '/webpayplus/mall/diferido/create',
        'buyOrder' => time() + rand(1, 1000),
        'sessionId' => '123session_parent',
        'returnUrl' => url('/') . '/webpayplus/mall/diferido/returnUrl',
        'children' => $children,
    ])
@endsection
