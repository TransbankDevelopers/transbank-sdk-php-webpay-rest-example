<?php

namespace App\Support;

use Transbank\Webpay\WebpayPlus;

/**
 * Configuración de la pantalla intermedia (webpayplus/mall_index) de cada producto Webpay Plus Mall.
 */
class WebpayPlusMallIndexViewConfig
{
    public static function mall(): array
    {
        return [
            'title' => 'Webpay Plus Mall',
            'createUrl' => '/webpayplus/createMall',
            'statusUrl' => '/webpayplus/mallTransactionStatus',
            'refundUrl' => '/webpayplus/mallRefund',
            'buyOrderField' => 'buy_order',
            'commerceCodeField' => 'commerce_code',
            'childCommerceCodes' => self::isProduction()
                ? self::codes(array_merge(
                    (array) config('services.transbank.webpay_plus_mall_child_cc'),
                    (array) config('services.transbank.webpay_plus_mall_child_3ds')
                ))
                : [WebpayPlus::DEFAULT_MALL_CHILD_COMMERCE_CODE_1, WebpayPlus::DEFAULT_MALL_CHILD_COMMERCE_CODE_2],
        ];
    }

    public static function monotiendaBines(): array
    {
        return [
            'title' => 'Webpay Mall Monotienda - Bines',
            'createUrl' => '/webpayplus/mall/monotienda-bines/create',
            'statusUrl' => '/webpayplus/mall/monotienda-bines/transactionStatus',
            'refundUrl' => '/webpayplus/mall/monotienda-bines/refund',
            'buyOrderField' => 'buy_order',
            'commerceCodeField' => 'commerce_code',
            'childCommerceCodes' => self::isProduction()
                ? self::codes([config('services.transbank.webpay_plus_mall_monotienda_bines_child_cc')])
                : [WebpayPlus::DEFAULT_MALL_CHILD_COMMERCE_CODE_1],
        ];
    }

    public static function qr(): array
    {
        return [
            'title' => 'Webpay Mall - Test QR',
            'createUrl' => '/webpayplusqr/createMall',
            'statusUrl' => '/webpayplusqr/mallTransactionStatus',
            'refundUrl' => '/webpayplusqr/mallRefund',
            'buyOrderField' => 'buy_order',
            'commerceCodeField' => 'commerce_code',
            'childCommerceCodes' => self::isProduction()
                ? self::codes([
                    config('services.transbank.webpay_plus_mall_child1_qr_cc'),
                    config('services.transbank.webpay_plus_mall_child2_qr_cc'),
                    config('services.transbank.webpay_plus_mall_child3_qr_cc'),
                ])
                : [WebpayPlus::DEFAULT_MALL_CHILD_COMMERCE_CODE_1, WebpayPlus::DEFAULT_MALL_CHILD_COMMERCE_CODE_2],
        ];
    }

    public static function duesQr(): array
    {
        return [
            'title' => 'Webpay Plus Mall - Prueba Cuotas QR',
            'createUrl' => '/webpayplusduesqr/createMall',
            'statusUrl' => '/webpayplusduesqr/mallTransactionStatus',
            'refundUrl' => '/webpayplusduesqr/mallRefund',
            'buyOrderField' => 'buy_order',
            'commerceCodeField' => 'commerce_code',
            'childCommerceCodes' => self::isProduction()
                ? self::codes((array) config('services.transbank.webpay_plus_mall_dues_qr_child_cc'))
                : [WebpayPlus::DEFAULT_MALL_CHILD_COMMERCE_CODE_1, WebpayPlus::DEFAULT_MALL_CHILD_COMMERCE_CODE_2],
        ];
    }

    public static function deferred(): array
    {
        return [
            'title' => 'Webpay Plus Mall Captura Diferida',
            'createUrl' => '/webpayplus/mall/diferido/create',
            'statusUrl' => '/webpayplus/mall/diferido/transactionStatus',
            'refundUrl' => '/webpayplus/mall/diferido/refund',
            // Este controlador recibe los campos del reembolso con prefijo child_.
            'buyOrderField' => 'child_buy_order',
            'commerceCodeField' => 'child_commerce_code',
            'childCommerceCodes' => self::isProduction()
                ? self::codes([config('services.transbank.webpay_plus_mall_deferred_child_cc')])
                : [WebpayPlus::DEFAULT_MALL_DEFERRED_CHILD_COMMERCE_CODE_1, WebpayPlus::DEFAULT_MALL_DEFERRED_CHILD_COMMERCE_CODE_2],
        ];
    }

    private static function isProduction(): bool
    {
        return app()->environment('production');
    }

    private static function codes(array $codes): array
    {
        return array_values(array_unique(array_filter(array_map('trim', array_map('strval', $codes)))));
    }
}
