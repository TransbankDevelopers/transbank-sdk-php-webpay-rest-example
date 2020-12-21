@extends('layout')
@section('content')

    <div class="main_content">
        <h1 class="header">
            Ejemplos Webpay
        </h1>

        @if (!$data['production'] || ($data['production'] && $data['webpay_plus_credentials_present']))
            <div class="examples_container">
                <span class="operation_title">
                    Webpay Plus
                </span>
                <span class="operation_link">
                    <a href="webpayplus/create">Iniciar <i class="fa fa-arrow-right"></i></a>
                </span>
            </div>
        @endif

        @if (!$data['production'] || ($data['production'] && $data['webpay_plus_deferred_credentials_present']))
            <div class="examples_container">
                <span class="operation_title">
                    Webpay Plus Captura Diferida
                </span>
                <span class="operation_link">
                    <a href="/webpayplus/diferido/create">Iniciar <i class="fa fa-arrow-right"></i></a>
                </span>
            </div>
        @endif

        @if (!$data['production'] || ($data['production'] && $data['webpay_plus_mall_credentials_present']))
            <div class="examples_container">
                <span class="operation_title">
                    Webpay Plus Mall
                </span>
                <span class="operation_link">
                    <a href="webpayplus/createMall">Iniciar <i class="fa fa-arrow-right"></i></a>
                </span>
            </div>
        @endif


        @if (!$data['production'] || ($data['production'] && $data['webpay_plus_mall_deferred_credentials_present']))
            <div class="examples_container">
                <span class="operation_title">
                    Webpay Plus Mall Captura Diferida
                </span>
                <span class="operation_link">
                    <a href="webpayplus/mall/diferido/create">Iniciar <i class="fa fa-arrow-right"></i></a>
                </span>

            </div>
        @endif


        <h1 class="header">
            Webpay OneClick
        </h1>

        @if (!$data['production'] || ($data['production'] && $data['oneclick_mall_credentials_present']))
            <div class="examples_container">
                <span class="operation_title">
                    Oneclick mall
                </span>
                <span class="operation_link">
                    <a href="oneclick/startInscription">Iniciar <i class="fa fa-arrow-right"></i></a>
                </span>

            </div>
        @endif

        @if (!$data['production'] || ($data['production'] && $data['oneclick_mall_deferred_credentials_present']))
            <div class="examples_container">
                <span class="operation_title">
                    Oneclick mall diferido
                </span>
                <span class="operation_link">
                    <a href="oneclick/diferido/startInscription">Iniciar <i class="fa fa-arrow-right"></i></a>
                </span>

            </div>
        @endif

        <h1 class="header">
            Transacción Completa
        </h1>

        @if (!$data['production'] || ($data['production'] && $data['transaccion_completa_credentials_present']))
            <div class="examples_container">
                <span class="operation_title">
                    Transacción Completa Captura Simultánea
                </span>
                <span class="operation_link">
                    <a href="transaccion_completa/create">Iniciar <i class="fa fa-arrow-right"></i></a>
                </span>
            </div>
        @endif

        @if (!$data['production'] || ($data['production'] && $data['transaccion_completa_mall_credentials_present']))
            <div class="examples_container">
                <span class="operation_title">
                    Transacción Completa Mall
                </span>
                <span class="operation_link">
                    <a href="transaccion_completa/mall_create">Iniciar <i class="fa fa-arrow-right"></i></a>
                </span>
            </div>
        @endif

        @if (!$data['production'] || ($data['production'] && $data['patpass_comercio_credentials_present']))
            <div class="examples_container">
                <span class="operation_title">Patpass Comercio</span>

                <span class="operation_link">
                    <a href="patpass_comercio/create-form">Iniciar <i class="fa fa-arrow-right"></i></a>
                </span>
            </div>
    </div>

@endsection
