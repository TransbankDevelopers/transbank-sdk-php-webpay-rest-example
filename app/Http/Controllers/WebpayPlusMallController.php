<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\Options;
use Transbank\Webpay\WebpayPlus;

class WebpayPlusMallController extends Controller
{
    public function __construct(){
        if (app()->environment('production')) {
            WebpayPlus::configureForProduction(config('services.transbank.webpay_plus_mall_cc'), config('services.transbank.webpay_plus_mall_api_key'));
        } else {
            WebpayPlus::configureForTestingMall();
        }
    }

    public function createMall(Request $request)
    {
        return view('webpayplus/mall_create');
    }

    public function createdMallTransaction(Request $request)
    {

        $req = $request->except('_token');
        $resp = (new WebpayPlus\MallTransaction)->create($req["buy_order"], $req["session_id"],  $req["return_url"], $req["detail"]);

        return view('webpayplus/transaction_created', [ "params" => $req,"response" => $resp]);

    }


    public function commitmallTransaction(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token_ws"];
        $resp = (new WebpayPlus\MallTransaction)->commit($token);

        return view('webpayplus/mall_transaction_committed', ["params" => $req, "response" => $resp]);

    }

    public function getMallTransactionStatus(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token"];
        $resp = (new WebpayPlus\MallTransaction)->status($token);

        return view('webpayplus/mall_transaction_status', ["resp" => $resp, "req" => $req]);
    }

    public function refundMallTransaction(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token"];
        try {
            $resp = (new WebpayPlus\MallTransaction)->refund($token, $req["buy_order"],$req["commerce_code"], $req["amount"]);
        } catch (WebpayPlus\Exceptions\TransactionRefundException $e) {
            dd($e);
        }


        return view('webpayplus/mall_refund_success', ["req" => $req,"resp" => $resp]);
    }
}
