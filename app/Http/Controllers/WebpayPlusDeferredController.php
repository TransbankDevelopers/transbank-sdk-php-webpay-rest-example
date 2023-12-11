<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\Options;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;

class WebpayPlusDeferredController extends Controller
{
    public function __construct(){
        if (app()->environment('production')) {
            WebpayPlus::configureForProduction(config('services.transbank.webpay_plus_deferred_cc'), config('services.transbank.webpay_plus_deferred_api_key'));
        } else {
            WebpayPlus::configureForTestingDeferred();
        }
    }

    public function createDiferido(Request $request)
    {
        $req = $request->except('_token');
        $resp = (new Transaction())->create($req["buy_order"], $req["session_id"], $req["amount"], $req["return_url"]);

        return view('webpayplus/diferido/transaction_created', [ "params" => $req,"response" => $resp]);
    }

    public function commitDiferidoTransaction(Request $request)
    {
        //Flujo normal
        if($request->exists("token_ws")){
            $req = $request->except('_token');
            $resp = (new Transaction())->commit($req["token_ws"]);

            return view('webpayplus/diferido/transaction_committed', ["resp" => $resp, 'req' => $req]);
        }

        //Pago abortado
        if($request->exists("TBK_TOKEN")){
            return view('webpayplus/diferido/transaction_aborted', ["resp" => $request->all()]);
        }

        //Timeout
        return view('webpayplus/diferido/transaction_timeout', ["resp" => $request->all()]);
    }


    public function captureDiferido(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token"];
        $buyOrder = $req["buy_order"];
        $authCode = $req["authorization_code"];
        $amount = (int)$req["capture_amount"];
        $resp = (new Transaction())->capture($token, $buyOrder, $authCode, $amount);

        return view('webpayplus/diferido/transaction_captured', ["req" => $req, 'resp' => $resp]);

    }

    public function statusDiferido(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token"];

        $resp = (new Transaction())->status($token);

        return view('webpayplus/diferido/status', ["req" => $req, 'resp' => $resp]);

    }

    public function refundDiferido(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token"];
        $amount = $req["amount"];

        $resp = (new Transaction())->refund($token, $amount);

        return view('webpayplus/diferido/refund', ["req" => $req, 'resp' => $resp]);

    }


}
