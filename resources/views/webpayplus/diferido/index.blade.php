@extends('layout')
@section('content')
    @include('webpayplus.partials.operations_index', [
        'title' => 'Webpay Plus Captura Diferida',
        'productName' => 'Webpay Plus Captura Diferida',
        'basePath' => '/webpayplus/diferido',
        'statusPath' => '/webpayplus/diferido/status',
        'refundPath' => '/webpayplus/diferido/refund',
    ])
@endsection
