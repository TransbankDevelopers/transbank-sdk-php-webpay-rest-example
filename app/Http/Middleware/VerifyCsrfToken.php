<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        "/webpayplus/returnUrl",
        "/webpayplus/mallReturnUrl",
        "/webpayplus/diferido/returnUrl",
        "/webpayplus/mall/diferido/returnUrl",
        "/oneclick/responseUrl",
        "/oneclick/diferido/responseUrl",
        "/patpass_comercio/returnUrl",
        "/patpass_comercio/voucherUrl",
        "/webpayplus/mall/diferido/returnUrl",
        "/patpass_by_webpay/returnUrl"
    ];
}
