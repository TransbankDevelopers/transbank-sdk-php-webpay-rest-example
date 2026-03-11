<?php

namespace App\Support;

class TransaccionCompletaDeferredViewConfig
{
    public static function sdk(): array
    {
        return [
            'routeNames' => [
                'index' => 'completa.diferido.index',
                'create' => 'completa.deferred.create',
                'installments' => 'completa.deferred.installments',
                'commit' => 'completa.deferred.commit',
                'capture' => 'completa.deferred.capture',
                'status' => 'completa.deferred.status',
                'refund' => 'completa.deferred.refund',
            ],
            'productLabel' => 'Transacción Completa Diferida',
        ];
    }

    public static function api(): array
    {
        return [
            'routeNames' => [
                'index' => 'completa.deferred.1_3.index',
                'create' => 'completa.deferred.1_3.create',
                'installments' => 'completa.deferred.1_3.installments',
                'commit' => 'completa.deferred.1_3.commit',
                'capture' => 'completa.deferred.1_3.capture',
                'status' => 'completa.deferred.1_3.status',
                'refund' => 'completa.deferred.1_3.refund',
            ],
            'productLabel' => 'Transacción Completa Diferida 1.3',
        ];
    }
}
