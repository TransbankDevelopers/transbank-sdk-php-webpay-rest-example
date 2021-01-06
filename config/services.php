<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],
    // CC stands for commerce_code
    'transbank' => [
        'webpay_plus_cc' => env('WEBPAY_PLUS_CC'),
        'webpay_plus_api_key' => env('WEBPAY_PLUS_API_KEY'),
        'webpay_plus_mall_cc' => env('WEBPAY_PLUS_MALL_CC'),
        'webpay_plus_mall_child_cc' => env ('WEBPAY_PLUS_MALL_CHILD_CC'),
        'webpay_plus_mall_api_key' => env('WEBPAY_PLUS_MALL_API_KEY'),
        'webpay_plus_deferred_cc' => env('WEBPAY_PLUS_DEFERRED_CC'),
        'webpay_plus_deferred_api_key' => env('WEBPAY_PLUS_DEFERRED_API_KEY'),
        'webpay_plus_mall_deferred_cc' => env('WEBPAY_PLUS_MALL_DEFERRED_CC'),
        'webpay_plus_mall_deferred_child_cc' => env('WEBPAY_PLUS_MALL_DEFERRED_CHILD_CC'),
        'webpay_plus_mall_deferred_api_key' => env('WEBPAY_PLUS_MALL_DEFERRED_API_KEY'),
        'oneclick_mall_cc' => env('ONECLICK_MALL_CC'),
        'oneclick_mall_api_key' => env('ONECLICK_MALL_API_KEY'),
        'oneclick_mall_child_cc' => env('ONECLICK_MALL_CHILD_CC'),
        'oneclick_mall_deferred_cc' => env('ONECLICK_MALL_DEFERRED_CC'),
        'oneclick_mall_deferred_child_cc' => env('ONECLICK_MALL_DEFERRED_CHILD_CC'),
        'oneclick_mall_deferred_api_key' => env('ONECLICK_MALL_DEFERRED_API_KEY'),
        'transaccion_completa_cc' => env('TRANSACCION_COMPLETA_CC'),
        'transaccion_completa_api_key' => env('TRANSACCION_COMPLETA_API_KEY'),
        'transaccion_completa_mall_cc' => env('TRANSACCION_COMPLETA_MALL_CC'),
        'transaccion_completa_mall_child_cc' => env('TRANSACCION_COMPLETA_MALL_CHILD_CC'),
        'transaccion_completa_mall_api_key' => env('TRANSACCION_COMPLETA_MALL_API_KEY'),
        'patpass_comercio_cc' => env('PATPASS_COMERCIO_CC'),
        'patpass_comercio_api_key' => env('PATPASS_COMERCIO_API_KEY'),
        'webpay_modal_cc' => env('WEBPAY_MODAL_CC'),
        'webpay_modal_api_key' => env('WEBPAY_MODAL_API_KEY'),
    ]
];
