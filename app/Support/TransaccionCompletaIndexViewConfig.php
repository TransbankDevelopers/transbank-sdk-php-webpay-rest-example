<?php

namespace App\Support;

use Transbank\TransaccionCompleta\TransaccionCompleta;

/**
 * Configuración de la pantalla intermedia (transaccion_completa/operations_index) de cada producto
 * Transacción Completa. Cada controlador recibe el token y los datos del reembolso con nombres distintos,
 * por eso se configuran aquí.
 *
 * Si 'childCommerceCodes' es null el producto no es mall y el reembolso solo pide token y monto.
 */
class TransaccionCompletaIndexViewConfig
{
    public static function simultaneous(): array
    {
        return [
            'title' => 'Transacción Completa Captura Simultánea',
            'intro' => 'Inicia un pago o administra una transacción existente con su token.',
            'createUrl' => '/transaccion_completa/create',
            'statusUrl' => '/transaccion_completa/transaction_status',
            'statusTokenField' => 'token_ws',
            'refundUrl' => '/transaccion_completa/refund',
            'refundTokenField' => 'token_ws',
            'childCommerceCodes' => null,
        ];
    }

    public static function deferred(): array
    {
        return [
            'title' => 'Transacción Completa Captura Diferida',
            'intro' => 'Inicia un pago o administra una transacción existente con su token.',
            'createUrl' => '/transaccion_completa/diferido/create',
            'statusUrl' => '/transaccion_completa/diferido/transaction_status',
            'statusTokenField' => 'token',
            'refundUrl' => '/transaccion_completa/diferido/refund',
            'refundTokenField' => 'token_ws',
            'childCommerceCodes' => null,
        ];
    }

    public static function deferred13(): array
    {
        return [
            'title' => 'Transacción Completa Captura Diferida 1.3',
            'intro' => 'Inicia un pago o administra una transacción existente con su token.',
            'createUrl' => '/transaccion_completa/diferido/1_3/create',
            'statusUrl' => '/transaccion_completa/diferido/1_3/transaction_status',
            'statusTokenField' => 'token',
            'refundUrl' => '/transaccion_completa/diferido/1_3/refund',
            'refundTokenField' => 'token_ws',
            'childCommerceCodes' => null,
        ];
    }

    public static function mall(): array
    {
        return [
            'title' => 'Transacción Completa Mall',
            'intro' => 'Inicia un pago o administra una transacción existente con su token.',
            'createUrl' => '/transaccion_completa/mall_create',
            // El estado del mall se consulta por GET /mall_status/{token}; este POST redirige ahí.
            'statusUrl' => '/transaccion_completa/mall_status',
            'statusTokenField' => 'token',
            'refundUrl' => '/transaccion_completa/mall_refund',
            'refundTokenField' => 'token',
            'commerceCodeField' => 'child_commerce_code',
            'buyOrderField' => 'child_buy_order',
            'childCommerceCodes' => app()->environment('production')
                ? self::codes([config('services.transbank.transaccion_completa_mall_child_cc')])
                : [TransaccionCompleta::DEFAULT_MALL_CHILD_COMMERCE_CODE_1, TransaccionCompleta::DEFAULT_MALL_CHILD_COMMERCE_CODE_2],
        ];
    }

    public static function standardBrand(array $childCommerceCodes): array
    {
        return [
            'title' => 'Transacción Completa Mall Estándar Marca',
            'intro' => 'Inicia un pago con CVV o administra una transacción existente.',
            'createUrl' => '/transaccion_completa/standard_brand/create',
            'statusUrl' => '/transaccion_completa/standard_brand/status',
            'statusTokenField' => 'token',
            'refundUrl' => '/transaccion_completa/standard_brand/refund',
            'refundTokenField' => 'token',
            'commerceCodeField' => 'commerce_code',
            'buyOrderField' => 'buy_order',
            'childCommerceCodes' => $childCommerceCodes,
        ];
    }

    public static function standardBrandWithoutCvv(array $childCommerceCodes): array
    {
        return array_merge(self::standardBrand($childCommerceCodes), [
            'title' => 'Transacción Completa Mall Estándar Marca sin CVV',
            'intro' => 'Inicia un pago sin CVV o administra una transacción existente.',
            'createUrl' => '/transaccion_completa/standard_brand_without_cvv/create',
            'statusUrl' => '/transaccion_completa/standard_brand_without_cvv/status',
            'refundUrl' => '/transaccion_completa/standard_brand_without_cvv/refund',
        ]);
    }

    private static function codes(array $codes): array
    {
        return array_values(array_unique(array_filter(array_map('trim', array_map('strval', $codes)))));
    }
}
