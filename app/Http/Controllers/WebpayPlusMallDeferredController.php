<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\Options;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\MallTransaction;

class WebpayPlusMallDeferredController extends Controller
{
    public function __construct(){
        if (app()->environment('production')) {
            WebpayPlus::configureForProduction(config('services.transbank.webpay_plus_mall_deferred_cc'), config('services.transbank.webpay_plus_mall_deferred_api_key'));
        } else {
            WebpayPlus::configureForTestingMallDeferred();
        }
    }
    public function createMallDiferido(Request $request)
    {
        $req = $request->except('_token');
        $resp = (new MallTransaction)->create($req["buy_order"], $req["session_id"],  $req["return_url"], $req["detail"]);

        return view('webpayplus/mall/diferido/transaction_created', [ "params" => $req,"response" => $resp]);
    }

    public function commitMallDiferido(Request $request)
    {
        $req = $request->except('_token');
        $resp = (new MallTransaction)->commit($req["token_ws"]);

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
        $resp = (new MallTransaction)->capture($childCommerceCode, $token, $buyOrder, $authCode, $amount);

        return view('webpayplus/mall/diferido/transaction_captured', ["req" => $req, 'resp' => $resp]);

    }

    public function refundMallDiferido(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token"];
        $amount = $req["amount"];
        $childCommerceCode = $req["child_commerce_code"];
        $childBuyOrder = $req["child_buy_order"];
        $resp = (new MallTransaction)->refund($token, $childBuyOrder, $childCommerceCode, $amount);
        dd($resp);
    }

    public function statusMallDiferido(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token"];
        $resp = (new MallTransaction)->status($token);
        dd($resp);
    }

    public function increaseAmountMallDiferido(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token"];
        $buyOrder = $req["buyOrder"];
        $authCode = $req["authCode"];
        $amount = $req["amount"];
        $commerceCode = $req["commerceCode"];

        $resp = (new MallTransaction)->increaseAmount($token, $buyOrder, $authCode, $amount, $commerceCode);
        return view('webpayplus/mall/diferido/amount_increased', ["req" => $req, 'resp' => $resp]);
    }

    public function reverseAmountMallDiferido(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token"];
        $buyOrder = $req["buyOrder"];
        $authCode = $req["authCode"];
        $amount = $req["amount"];
        $commerceCode = $req["commerceCode"];

        $resp = (new MallTransaction)->reversePreAuthorizedAmount($token, $buyOrder, $authCode, $amount, $commerceCode);
        return view('webpayplus/mall/diferido/amount_reversed', ["req" => $req, 'resp' => $resp]);
    }

    public function increaseDateMallDiferido(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token"];
        $buyOrder = $req["buyOrder"];
        $authCode = $req["authCode"];
        $commerceCode = $req["commerceCode"];

        $resp = (new MallTransaction)->increaseAuthorizationDate($token, $buyOrder, $authCode, $commerceCode);
        return view('webpayplus/mall/diferido/date_increased', ["req" => $req, 'resp' => $resp]);
    }

    public function transactionHistoryMallDiferido(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token"];
        $buyOrder = $req["buyOrder"];
        $commerceCode = $req["commerceCode"];

        $resp = (new MallTransaction)->deferredCaptureHistory($token, $buyOrder, $commerceCode);
        return view('webpayplus/mall/diferido/history', ["req" => $req, 'resp' => $resp]);
    }
}
