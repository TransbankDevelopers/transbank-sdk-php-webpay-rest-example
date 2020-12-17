@extends('layout')
@section('content')

<div class="main_content">
    <h1 class="header">
        Ejemplos Webpay
    </h1>

    @if (!$data['production'] || $data['production'] && $data['webpay_plus_credentials_present'])
        <div class="examples_container">
            <span class="operation_title">
                Webpay Plus
            </span>
            <span class="operation_link">
                <a href="webpayplus/create">Crear Transacción<i class="fa fa-arrow-right"></i></a>
            </span>
        </div>
    @endif

    @if (!$data['production'] || $data['production'] && $data['webpay_plus_deferred_credentials_present'])
        <div class="examples_container">
            <span class="operation_title">
                Webpay Plus Diferido
            </span>
            <span class="operation_link">
                <a href="/webpayplus/diferido/create">Crear Transacción<i class="fa fa-arrow-right"></i></a>
            </span>
        </div>
    @endif

    @if (!$data['production'] || $data['production'] && $data['webpay_plus_mall_credentials_present'])
        <div class="examples_container">
            <span class="operation_title">
                Webpay Plus Mall
            </span>
            <span class="operation_link">
                <a href="webpayplus/createMall">Crear Transacción<i class="fa fa-arrow-right"></i></a>
            </span>
        </div>
    @endif

    @if (!$data['production'] || $data['production'] && $data['webpay_plus_mall_deferred_credentials_present'])
        <div class="examples_container">
            <span class="operation_title">
                Webpay Plus Mall Diferido
            </span>
            <span class="operation_link">
                <a href="webpayplus/mall/diferido/create">Crear Transacción<i class="fa fa-arrow-right"></i></a>
            </span>
        </div>
    @endif

    @if (!$data['production'] || $data['production'] && $data['oneclick_mall_credentials_present'])
        <div class="examples_container">
            <span class="operation_title">
                Oneclick mall
            </span>
            <span class="operation_link">
                <a href="oneclick/startInscription">Inscribir <i class="fa fa-arrow-right"></i></a>
            </span>
        </div>
    @endif

    @if (!$data['production'] || $data['production'] && $data['oneclick_mall_deferred_credentials_present'])
        <div class="examples_container">
            <span class="operation_title">
                Oneclick mall diferido
            </span>
            <span class="operation_link">
                <a href="oneclick/diferido/startInscription">Inscribir <i class="fa fa-arrow-right"></i></a>
            </span>
        </div>
    @endif

    @if (!$data['production'] || $data['production'] && $data['transaccion_completa_credentials_present'])
        <div class="examples_container">
            <span class="operation_title">
                Transacción Completa
            </span>
            <span class="operation_link">
                <a href="transaccion_completa/create">Crear Transacción <i class="fa fa-arrow-right"></i></a>
            </span>
        </div>
    @endif

    @if (!$data['production'] || $data['production'] && $data['transaccion_completa_mall_credentials_present'])
        <div class="examples_container">
            <span class="operation_title">
                Transacción Completa Mall
            </span>
            <span class="operation_link">
                <a href="transaccion_completa/mall_create">Crear Transacción <i class="fa fa-arrow-right"></i></a>
            </span>
        </div>
    @endif

    @if (!$data['production'] || $data['production'] && $data['patpass_comercio_credentials_present'])
    <div class="examples_container" style="padding: 10px">
        <span class="operation_title">Patpass Comercio</span>
        <span class="operation_link">
            <a href="patpass_comercio/create-form">Request Form <i class="fa fa-arrow-right"></i></a>
        </span>
    </div>
    @endif

</div>


@endsection