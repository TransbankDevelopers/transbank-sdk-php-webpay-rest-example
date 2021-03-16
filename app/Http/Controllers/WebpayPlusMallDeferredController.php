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
            WebpayPlus::configureMallDeferredForTesting();
        }
    }
    public function createMallDiferido(Request $request)
    {
        $req = $request->except('_token');
        $resp = WebpayPlus\MallTransaction::create($req["buy_order"], $req["session_id"],  $req["return_url"], $req["detail"]);

        return view('webpayplus/mall/diferido/transaction_created', [ "params" => $req,"response" => $resp]);
    }

    public function commitMallDiferido(Request $request)
    {
        $req = $request->except('_token');
        $resp = WebpayPlus\MallTransaction::commit($req["token_ws"]);

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
        $resp = WebpayPlus\MallTransaction::capture($childCommerceCode, $token, $buyOrder, $authCode, $amount);

        return view('webpayplus/mall/diferido/transaction_captured', ["req" => $req, 'resp' => $resp]);

    }

    public function refundMallDiferido(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token"];
        $amount = $req["amount"];
        $childCommerceCode = $req["child_commerce_code"];
        $childBuyOrder = $req["child_buy_order"];
        $resp = WebpayPlus\MallTransaction::refund($token, $childBuyOrder, $childCommerceCode, $amount);
        dd($resp);
    }

    public function statusMallDiferido(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token"];
        $resp = WebpayPlus\MallTransaction::status($token);
        dd($resp);
    }
}
