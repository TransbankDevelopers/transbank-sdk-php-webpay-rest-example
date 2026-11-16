@extends('layout')
@section('content')
    @include('webpayplus.partials.operations_index', [
        'title' => 'Webpay Plus - Bines',
        'productName' => 'Webpay Plus - Bines',
        'basePath' => '/webpayplus/bines',
        'statusPath' => '/webpayplus/bines/transactionStatus',
        'refundPath' => '/webpayplus/bines/refund',
    ])
@endsection
