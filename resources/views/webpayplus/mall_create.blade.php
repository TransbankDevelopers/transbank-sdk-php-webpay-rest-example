@extends('layout')
@section('content')
    @php
        if (app()->environment('production')) {
            $children = array_map(function ($child) {
                return [
                    'code' => $child['commerce_code'],
                    'label' => $child['type_child'] == '3DS' ? 'Tienda Piloto 3DS' : 'Tienda Normal',
                    'buyOrder' => 'buyorder_' . Str::random(10),
                    'amount' => 1000,
                ];
            }, $commerceCodeList);
        } else {
            $children = [
                ['code' => '597055555536', 'buyOrder' => 'buyorder_' . Str::random(10), 'amount' => 1000],
                ['code' => '597055555537', 'buyOrder' => 'buyorder_' . Str::random(10), 'amount' => 2000],
            ];
        }
    @endphp
    @include('webpayplus.partials.mall_create', [
        'title' => 'Webpay Plus Mall',
        'intro' => 'Crea una transacción mall: un solo pago repartido entre varios comercios hijos.',
        'action' => '/webpayplus/createMall',
        'buyOrder' => 'buyorder_' . Str::random(10),
        'sessionId' => Str::random(20),
        'returnUrl' => url('/') . '/webpayplus/mallReturnUrl',
        'children' => $children,
        'emptyHint' => 'No hay comercios hijos configurados. Define <code>WEBPAY_PLUS_MALL_CHILD_CC</code> o <code>WEBPAY_PLUS_MALL_CHILD_3DS</code>.',
    ])
@endsection
