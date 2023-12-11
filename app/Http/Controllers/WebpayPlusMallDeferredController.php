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
        //Flujo normal
        if($request->exists("token_ws")){
            $req = $request->except('_token');
            $resp = (new MallTransaction)->commit($req["token_ws"]);

            return view('webpayplus/mall/diferido/transaction_committed', ["resp" => $resp, 'req' => $req]);
        }

        //Pago abortado
        if($request->exists("TBK_TOKEN")){
            return view('webpayplus/mall/diferido/transaction_aborted', ["resp" => $request->all()]);
        }

        //Timeout
        return view('webpayplus/mall/diferido/transaction_timeout', ["resp" => $request->all()]);
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
        return view('webpayplus/mall/diferido/refund', ["req" => $req, 'resp' => $resp]);
    }

    public function statusMallDiferido(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token"];
        $resp = (new MallTransaction)->status($token);
        return view('webpayplus/mall/diferido/status', ["req" => $req, 'resp' => $resp]);
    }


}
