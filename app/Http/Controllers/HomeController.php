<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

class HomeController extends Controller
{

    public function welcome()
    {
        $data = array(
            'production' => app()->environment('production'),
            'webpay_plus_credentials_present' =>
                config('services.transbank.webpay_plus_cc') !=  null && config('services.transbank.webpay_plus_api_key') != null,
            'webpay_plus_mall_credentials_present' =>
                config('services.transbank.webpay_plus_mall_cc') != null && config('services.transbank.webpay_plus_mall_api_key') != null,
            'webpay_plus_mall_qr_dues_credentials_present' =>
                config('services.transbank.webpay_plus_mall_dues_qr_cc') != null
                && config('services.transbank.webpay_plus_mall_dues_qr_api_key') != null,
            'webpay_plus_mall_qr_credentials_present' =>
                config('services.transbank.webpay_plus_mall_qr_cc') != null && config('services.transbank.webpay_plus_mall_qr_api_key') != null,
            'webpay_plus_deferred_credentials_present' =>
                config('services.transbank.webpay_plus_deferred_cc') != null && config('services.transbank.webpay_plus_deferred_api_key') != null,
            'webpay_plus_mall_deferred_credentials_present' =>
                config('services.transbank.webpay_plus_mall_deferred_cc') != null && config('services.transbank.webpay_plus_mall_deferred_api_key') != null,
            'oneclick_mall_credentials_present' =>
                config('services.transbank.oneclick_mall_cc') != null && config('services.transbank.oneclick_mall_api_key') != null,
            'oneclick_mall_deferred_credentials_present' =>
                config('services.transbank.oneclick_mall_deferred_cc') != null && config('services.transbank.oneclick_mall_deferred_api_key') != null,
            'transaccion_completa_credentials_present' =>
                config('services.transbank.transaccion_completa_cc') != null && config('services.transbank.transaccion_completa_api_key') != null,
            'transaccion_completa_deferred_credentials_present' =>
                config('services.transbank.transaccion_completa_deferred_cc') != null && config('services.transbank.transaccion_completa_deferred_api_key') != null,
            'transaccion_completa_mall_credentials_present' =>
                config('services.transbank.transaccion_completa_mall_cc') != null && config('services.transbank.transaccion_completa_mall_api_key') != null,
            'patpass_comercio_credentials_present' =>
                config('services.transbank.patpass_comercio_cc') != null && config('services.transbank.patpass_comercio_api_key') != null
        );
        return view('welcome', compact('data'));
    }
}
