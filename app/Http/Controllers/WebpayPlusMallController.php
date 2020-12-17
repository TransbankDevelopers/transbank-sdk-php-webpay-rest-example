<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\Options;
use Transbank\Webpay\WebpayPlus;

class WebpayPlusMallController extends Controller
{
    public function __construct(){
        if (app()->environment('production')) {
            WebpayPlus::setCommerceCode(config('services.transbank.webpay_plus_mall_cc'));
            WebpayPlus::setApiKey(config('services.transbank.webpay_plus_mall_api_key'));
            WebpayPlus::setIntegrationType('LIVE');
        } else {
            WebpayPlus::configureMallForTesting();
        }
    }

    public function createMall(Request $request)
    {
        return view('webpayplus/mall_create');
    }

    public function createdMallTransaction(Request $request)
    {

        $req = $request->except('_token');
        $resp = WebpayPlus\Transaction::createMall($req["buy_order"], $req["session_id"],  $req["return_url"], $req["detail"]);

        return view('webpayplus/transaction_created', [ "params" => $req,"response" => $resp]);

    }


    public function commitmallTransaction(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token_ws"];
        $resp = WebpayPlus\Transaction::commitMall($token);

        return view('webpayplus/mall_transaction_committed', ["params" => $req, "response" => $resp]);

    }

    public function getMallTransactionStatus(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token"];
        $resp = WebpayPlus\Transaction::getMallStatus($token);

        return view('webpayplus/mall_transaction_status', ["resp" => $resp, "req" => $req]);
    }

    public function refundMallTransaction(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token"];
        $resp = WebpayPlus\Transaction::refundMall($token, $req["buy_order"],$req["commerce_code"], $req["amount"]);

        return view('webpayplus/mall_refund_success', ["req" => $req,"resp" => $resp]);
    }
}
