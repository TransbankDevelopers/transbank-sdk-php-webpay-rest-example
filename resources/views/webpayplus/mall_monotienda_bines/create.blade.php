@extends('layout')
@section('content')
    @include('webpayplus.partials.mall_create', [
        'title' => 'Webpay Mall Monotienda - Bines',
        'intro' => 'Crea una transacción mall con un único comercio hijo.',
        'action' => '/webpayplus/mall/monotienda-bines/create',
        'buyOrder' => 'buyorder_' . Str::random(10),
        'sessionId' => Str::random(20),
        'returnUrl' => url('/') . '/webpayplus/mall/monotienda-bines/returnUrl',
        'children' => [
            [
                'code' => app()->environment('production') ? $childCommerceCode : '597055555536',
                'label' => 'Comercio hijo',
                'buyOrder' => 'buyorder_' . Str::random(10),
                'amount' => 1000,
            ],
        ],
    ])
@endsection
