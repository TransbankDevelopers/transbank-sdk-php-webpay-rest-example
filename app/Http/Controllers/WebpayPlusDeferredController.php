<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\Options;
use Transbank\Webpay\WebpayPlus;

class WebpayPlusDeferredController extends Controller
{
    public function __construct(){
        if (app()->environment('production')) {
            WebpayPlus::setCommerceCode(config('services.transbank.webpay_plus_deferred_cc'));
            WebpayPlus::setApiKey(config('services.transbank.webpay_plus_deferred_api_key'));
            WebpayPlus::setIntegrationType('LIVE');
        } else {
            WebpayPlus::configureDeferredForTesting();
        }
    }

    public function createDiferido(Request $request)
    {
        $req = $request->except('_token');
        $resp = WebpayPlus\Transaction::create($req["buy_order"], $req["session_id"], $req["amount"], $req["return_url"]);

        return view('webpayplus/diferido/transaction_created', [ "params" => $req,"response" => $resp]);
    }

    public function commitDiferidoTransaction(Request $request)
    {

        $req = $request->except('_token');
        $resp = WebpayPlus\Transaction::commit($req["token_ws"]);

        return view('webpayplus/diferido/transaction_committed', ["resp" => $resp, 'req' => $req]);
    }


    public function captureDiferido(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token"];
        $buyOrder = $req["buy_order"];
        $authCode = $req["authorization_code"];
        $amount = (int)$req["capture_amount"];
        $resp = WebpayPlus\Transaction::capture($token, $buyOrder, $authCode, $amount);

        return view('webpayplus/diferido/transaction_captured', ["req" => $req, 'resp' => $resp]);

    }

    public function statusDiferido(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token"];

        $resp = WebpayPlus\Transaction::getStatus($token);
        dd($resp);
    }

    public function refundDiferido(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token"];
        $amount = $req["amount"];

        $resp = WebpayPlus\Transaction::refund($token, $amount);
        dd($resp);

    }
}
