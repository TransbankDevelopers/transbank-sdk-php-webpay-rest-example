@extends('layout')
@section('content')

        <div class="main_content">
            <h1 class="header">
                Ejemplos Webpay
            </h1>

            <div class="examples_container">
                <span class="operation_title">
                    Transacción Simple
                </span>
                <span class="operation_link">
                    <a href="webpayplus/create">Webpay plus normal <i class="fa fa-arrow-right"></i></a>
                </span>
            </div>


            <div class="examples_container">
                <span class="operation_title">
                    Transaction Plus Diferido
                </span>
                <span class="operation_link">
                    <a href="/webpayplus/diferido/create">Webpay plus diferido <i class="fa fa-arrow-right"></i></a>
                </span>
            </div>


            <div class="examples_container">
                <span class="operation_title">
                    Transaction Mall
                </span>
                <span class="operation_link">
                    <a href="webpayplus/createMall">Webpay plus mall <i class="fa fa-arrow-right"></i></a>
                </span>
            </div>

            <div class="examples_container">
                <span class="operation_title">
                    Transaction Mall Diferido
                </span>
                <span class="operation_link">
                    <a href="webpayplus/mall/diferido/create">Webpay Plus Mall diferido <i class="fa fa-arrow-right"></i></a>
                </span>

            </div>


            <div class="examples_container">
                <span class="operation_title">
                    Oneclick mall
                </span>
                <span class="operation_link">
                    <a href="oneclick/startInscription">Inscribir <i class="fa fa-arrow-right"></i></a>
                </span>

            </div>

            <div class="examples_container">
                <span class="operation_title">
                    Oneclick mall diferido
                </span>
                <span class="operation_link">
                    <a href="oneclick/diferido/startInscription">Inscribir <i class="fa fa-arrow-right"></i></a>
                </span>

            </div>

            <div class="examples_container">
                <span class="operation_title">
                    Transacción Completa
                </span>
                <span class="operation_link">
                    <a href="transaccion_completa/create">Crear Transacción <i class="fa fa-arrow-right"></i></a>
                </span>
            </div>

            <div class="examples_container">
                <span class="operation_title">
                    Transacción Completa Mall
                </span>
                <span class="operation_link">
                    <a href="transaccion_completa/mall_create">Crear Transacción <i class="fa fa-arrow-right"></i></a>
                </span>
            </div>

            <div class="examples_container">
                <span class="operation_title">
                    Patpass by Webpay
                </span>
                <span class="operation_link">
                    <a href="patpass_by_webpay/create">Crear Transacción <i class="fa fa-arrow-right"></i></a>
                </span>

            </div>




            <div class="examples_container" style="padding: 10px">
                <span class="operation_title">Patpass Comercio</span>

                <span class="operation_link">
                    <a href="patpass_comercio/create-form">Request Form <i class="fa fa-arrow-right"></i></a>
                </span>

            </div>

        </div>


@endsection
