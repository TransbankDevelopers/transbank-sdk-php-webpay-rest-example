@extends('layout')
@section('content')
    @php
        // Cada producto se muestra en integración, o en producción solo si tiene sus credenciales configuradas.
        $groups = [
            [
                'title' => 'Webpay Plus',
                'description' => 'El cliente paga en el formulario de Webpay y vuelve al comercio.',
                'products' => [
                    ['Webpay Plus', 'webpayplus', 'webpay_plus_credentials_present'],
                    ['Webpay Plus - Bines', 'webpayplus/bines', 'webpay_plus_bines_credentials_present'],
                    ['Webpay Plus Captura Diferida', 'webpayplus/diferido', 'webpay_plus_deferred_credentials_present'],
                    ['Webpay Plus Mall', 'webpayplus/mall', 'webpay_plus_mall_credentials_present'],
                    ['Webpay Mall Monotienda - Bines', 'webpayplus/mall/monotienda-bines', 'webpay_plus_mall_monotienda_bines_credentials_present'],
                    ['Webpay Plus Mall - Prueba Cuotas QR', 'webpayplusduesqr', 'webpay_plus_mall_qr_dues_credentials_present'],
                    ['Webpay Mall - Test QR', 'webpayplusqr', 'webpay_plus_mall_qr_credentials_present'],
                    ['Webpay Plus Mall Captura Diferida', 'webpayplus/mall/diferido', 'webpay_plus_mall_deferred_credentials_present'],
                ],
            ],
            [
                'title' => 'Webpay Oneclick',
                'description' => 'El cliente inscribe su tarjeta una vez y luego paga sin volver a ingresarla.',
                'products' => [
                    ['Oneclick Mall', 'oneclick', 'oneclick_mall_credentials_present'],
                    ['Oneclick Mall Diferido', 'oneclick/diferido', 'oneclick_mall_deferred_credentials_present'],
                    ['Oneclick Mall Estándar Marca', 'oneclick/standard_brand', 'oneclick_mall_standard_brand_credentials_present'],
                ],
            ],
            [
                'title' => 'Transacción Completa',
                'description' => 'El comercio pide los datos de la tarjeta en su propio formulario.',
                'products' => [
                    ['Transacción Completa Captura Simultánea', 'transaccion_completa', 'transaccion_completa_credentials_present'],
                    ['Transacción Completa Captura Diferida', 'transaccion_completa/diferido', 'transaccion_completa_deferred_credentials_present'],
                    ['Transacción Completa Captura Diferida 1.3', 'transaccion_completa/diferido/1_3', 'transaccion_completa_deferred_1_3_credentials_present'],
                    ['Transacción Completa Mall', 'transaccion_completa/mall', 'transaccion_completa_mall_credentials_present'],
                    ['Transacción Completa Mall Estándar Marca', 'transaccion_completa/standard_brand', 'transaccion_completa_standard_brand_credentials_present'],
                    ['Transacción Completa Mall Estándar Marca sin CVV', 'transaccion_completa/standard_brand_without_cvv', 'transaccion_completa_standard_brand_without_cvv_credentials_present'],
                ],
            ],
            [
                'title' => 'Patpass',
                'description' => 'Inscripción de tarjetas para cargos recurrentes.',
                'products' => [
                    ['Patpass Comercio', 'patpass_comercio/create-form', 'patpass_comercio_credentials_present'],
                ],
            ],
        ];

        foreach ($groups as $i => $group) {
            $groups[$i]['products'] = array_values(array_filter($group['products'], function ($product) use ($data) {
                return !$data['production'] || !empty($data[$product[2]]);
            }));
        }
        $groups = array_values(array_filter($groups, function ($group) {
            return count($group['products']) > 0;
        }));
    @endphp

    <div class="home-catalog">
        <header class="home-catalog__header">
            <h1 class="home-catalog__title">Ejemplos Webpay REST</h1>
            <p class="home-catalog__intro">Elige un producto para recorrer su flujo completo con el SDK de PHP.</p>
        </header>

        @forelse ($groups as $group)
            <section class="home-catalog__group" aria-labelledby="group-{{ $loop->index }}">
                <h2 class="home-catalog__group-title" id="group-{{ $loop->index }}">{{ $group['title'] }}</h2>
                <p class="home-catalog__group-description">{{ $group['description'] }}</p>

                <ul class="home-catalog__list">
                    @foreach ($group['products'] as [$name, $path])
                        <li>
                            <a class="home-catalog__item" href="{{ url($path) }}">
                                <span class="home-catalog__name">{{ $name }}</span>
                                <span class="home-catalog__cta">Iniciar <i class="fa fa-arrow-right" aria-hidden="true"></i></span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </section>
        @empty
            <p class="home-catalog__empty">No hay productos con credenciales configuradas en este ambiente.</p>
        @endforelse
    </div>
@endsection
