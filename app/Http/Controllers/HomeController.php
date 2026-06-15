<?php

namespace App\Http\Controllers;

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
            'oneclick_mall_standard_brand_credentials_present' =>
            config('services.transbank.oneclick_mall_standard_brand_cc') != null && config('services.transbank.oneclick_mall_standard_brand_api_key') != null,
            'oneclick_mall_deferred_credentials_present' =>
            config('services.transbank.oneclick_mall_deferred_cc') != null && config('services.transbank.oneclick_mall_deferred_api_key') != null,
            'transaccion_completa_credentials_present' =>
            config('services.transbank.transaccion_completa_cc') != null && config('services.transbank.transaccion_completa_api_key') != null,
            'transaccion_completa_deferred_credentials_present' =>
            config('services.transbank.transaccion_completa_deferred_cc') != null && config('services.transbank.transaccion_completa_deferred_api_key') != null,
            'transaccion_completa_deferred_1_3_credentials_present' =>
            config('services.transbank.transaccion_completa_deferred_1_3_cc') != null && config('services.transbank.transaccion_completa_deferred_1_3_api_key') != null,
            'transaccion_completa_mall_credentials_present' =>
            config('services.transbank.transaccion_completa_mall_cc') != null && config('services.transbank.transaccion_completa_mall_api_key') != null,
            'transaccion_completa_standard_brand_credentials_present' =>
            config('services.transbank.transacction_completa_mall_standard_brand_cc') != null
                && config('services.transbank.transacction_completa_mall_standard_brand_api_key') != null,
            'transaccion_completa_standard_brand_without_cvv_credentials_present' =>
            config('services.transbank.transaccion_completa_mall_standard_brand_without_cvv_cc') != null
                && config('services.transbank.transaccion_completa_mall_standard_brand_without_cvv_api_key') != null,
            'patpass_comercio_credentials_present' =>
            config('services.transbank.patpass_comercio_cc') != null && config('services.transbank.patpass_comercio_api_key') != null
        );
        return view('welcome', compact('data'));
    }
}
