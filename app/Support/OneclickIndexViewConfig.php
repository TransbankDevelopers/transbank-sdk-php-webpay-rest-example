<?php

namespace App\Support;

/**
 * Configuración de la pantalla intermedia (oneclick/partials/operations_index) de cada producto Oneclick Mall.
 */
class OneclickIndexViewConfig
{
    public static function mall(): array
    {
        return [
            'title' => 'Oneclick Mall',
            'inscriptionUrl' => '/oneclick/startInscription',
            'authorizeUrl' => '/oneclick/mall/authorizeTransaction',
            'statusUrl' => '/oneclick/mall/transactionStatus',
            'refundUrl' => '/oneclick/mall/refund',
            'deleteUrl' => '/oneclick/inscription',
            'deleteMethod' => 'POST',
            'childCommerceCodes' => self::isProduction()
                ? self::codes([config('services.transbank.oneclick_mall_child_cc')])
                : ['597055555542'],
        ];
    }

    public static function deferred(): array
    {
        return [
            'title' => 'Oneclick Mall Diferido',
            'inscriptionUrl' => '/oneclick/diferido/startInscription',
            // En este producto se autoriza al terminar la inscripción (no hay página para autorizar aparte).
            'authorizeUrl' => null,
            'statusUrl' => '/oneclick/mall/diferido/transaction_status',
            'refundUrl' => '/oneclick/mall/diferido/refund',
            'deleteUrl' => '/oneclick/diferido/inscription',
            'deleteMethod' => 'DELETE',
            'childCommerceCodes' => self::isProduction()
                ? self::codes([config('services.transbank.oneclick_mall_deferred_child_cc')])
                : ['597055555548', '597055555549'],
        ];
    }

    public static function standardBrand(): array
    {
        return [
            'title' => 'Oneclick Mall Estándar Marca',
            'inscriptionUrl' => '/oneclick/standard_brand/startInscription',
            'authorizeUrl' => '/oneclick/standard_brand/mall/direct-authorize',
            'statusUrl' => '/oneclick/standard_brand/mall/transactionStatus',
            'refundUrl' => '/oneclick/standard_brand/mall/refund',
            'deleteUrl' => '/oneclick/standard_brand/inscription',
            'deleteMethod' => 'DELETE',
            // El controlador usa este mismo código en integración y producción.
            'childCommerceCodes' => self::codes([config('services.transbank.oneclick_mall_standard_brand_child_cc')]),
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
