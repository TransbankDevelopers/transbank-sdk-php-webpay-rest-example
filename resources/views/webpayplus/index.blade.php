@extends('layout')
@section('content')
    @include('webpayplus.partials.operations_index', [
        'title' => 'Webpay Plus',
        'productName' => 'Webpay Plus',
        'basePath' => '/webpayplus',
        'statusPath' => '/webpayplus/transactionStatus',
        'refundPath' => '/webpayplus/refund',
    ])
@endsection
