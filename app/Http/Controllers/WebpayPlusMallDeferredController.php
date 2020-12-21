<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\Options;
use Transbank\Webpay\WebpayPlus;

class WebpayPlusMallDeferredController extends Controller
{
    public function __construct(){
        if (app()->environment('production')) {
            WebpayPlus::setCommerceCode(config('services.transbank.webpay_plus_mall_deferred_cc'));
            WebpayPlus::setApiKey(config('services.transbank.webpay_plus_mall_deferred_api_key'));
            WebpayPlus::setIntegrationType('LIVE');
        } else {
            WebpayPlus::setCommerceCode("597055555544");
            WebpayPlus::setApiKey("579B532A7440BB0C9079DED94D31EA1615BACEB56610332264630D42D0A36B1C");
            WebpayPlus::setIntegrationType('TEST');
        }
    }
    public function createMallDiferido(Request $request)
    {
        $req = $request->except('_token');
        $resp = WebpayPlus\Transaction::createMall($req["buy_order"], $req["session_id"],  $req["return_url"], $req["detail"]);

        return view('webpayplus/mall/diferido/transaction_created', [ "params" => $req,"response" => $resp]);
    }

    public function commitMallDiferido(Request $request)
    {
        $req = $request->except('_token');
        $resp = WebpayPlus\Transaction::commitMall($req["token_ws"]);

        return view('webpayplus/mall/diferido/transaction_committed', ["resp" => $resp, 'req' => $req]);
    }

    public function captureMallDiferido(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token"];
        $childCommerceCode = $req["commerce_code"];
        $buyOrder = $req["buy_order"];
        $authCode = $req["authorization_code"];
        $amount = $req["capture_amount"];
        $resp = WebpayPlus\Transaction::captureMall($childCommerceCode, $token, $buyOrder, $authCode, $amount);

        return view('webpayplus/mall/diferido/transaction_captured', ["req" => $req, 'resp' => $resp]);

    }

    public function refundMallDiferido(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token"];
        $amount = $req["amount"];
        $childCommerceCode = $req["child_commerce_code"];
        $childBuyOrder = $req["child_buy_order"];
        $resp = WebpayPlus\Transaction::refundMall($token, $childBuyOrder, $childCommerceCode, $amount);
        dd($resp);
    }

    public function statusMallDiferido(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token"];
        $resp = WebpayPlus\Transaction::getMallStatus($token);
        dd($resp);
    }
}
