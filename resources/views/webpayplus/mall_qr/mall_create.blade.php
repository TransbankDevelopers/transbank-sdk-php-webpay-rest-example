@extends('layout')
@section('content')
    @php
        $codes = app()->environment('production')
            ? [
                config('services.transbank.webpay_plus_mall_child1_qr_cc'),
                config('services.transbank.webpay_plus_mall_child2_qr_cc'),
                config('services.transbank.webpay_plus_mall_child3_qr_cc'),
            ]
            : ['597055555536', '597055555537'];
        $children = array_map(function ($code) {
            return ['code' => $code, 'buyOrder' => 'buyorder_' . Str::random(10), 'amount' => 1000];
        }, $codes);
    @endphp
    {{-- El controlador descarta los comercios sin detail[i][active], así que aquí se pueden desmarcar. --}}
    @include('webpayplus.partials.mall_create', [
        'title' => 'Webpay Mall - Test QR',
        'intro' => 'Crea una transacción mall para probar el pago con QR. Elige qué comercios hijos participan y el monto de cada uno.',
        'action' => '/webpayplusqr/createMall',
        'buyOrder' => 'buyorder_' . Str::random(10),
        'sessionId' => Str::random(20),
        'returnUrl' => url('/') . '/webpayplusqr/mallReturnUrl',
        'children' => $children,
        'selectable' => true,
    ])
@endsection
