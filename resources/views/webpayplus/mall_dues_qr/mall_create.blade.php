@extends('layout')
@section('content')
    {{-- El controlador descarta los comercios sin detail[i][active], así que aquí se pueden desmarcar. --}}
    @include('webpayplus.partials.mall_create', [
        'title' => 'Webpay Plus Mall - Prueba Cuotas QR',
        'intro' => 'Crea una transacción mall para probar el pago en cuotas con QR. Elige qué comercios hijos participan y el monto de cada uno.',
        'action' => '/webpayplusduesqr/createMall',
        'buyOrder' => 'buyorder_' . Str::random(10),
        'sessionId' => Str::random(20),
        'returnUrl' => route('webpayplusduesqr.commit'),
        'children' => array_map(function ($code) {
            return ['code' => $code, 'buyOrder' => 'buyorder_' . Str::random(10), 'amount' => 1000];
        }, $childCommerceCodes),
        'selectable' => true,
        'emptyHint' => 'No hay comercios hijos configurados. Define <code>WEBPAY_PLUS_MALL_DUES_QR_CHILD_CC</code> (separados por coma) para usar este ejemplo.',
    ])
@endsection
