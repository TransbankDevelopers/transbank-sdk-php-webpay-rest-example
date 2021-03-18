<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\Options;
use Transbank\Webpay\WebpayPlus;

class WebpayPlusController extends Controller
{
    public function __construct(){
        if (app()->environment('production')) {
            WebpayPlus::configureForProduction(config('services.transbank.webpay_plus_cc'), config('services.transbank.webpay_plus_api_key'));
        } else {
            WebpayPlus::configureForProduction('597035769625', '0b12a12a7ec72992cf1f557042c4fa9b');
        }
    }

    public function createdTransaction(Request $request)
    {
        $req = $request->except('_token');
        $resp = WebpayPlus\Transaction::create($req["buy_order"], $req["session_id"], $req["amount"], $req["return_url"]);

        return view('webpayplus/transaction_created', [ "params" => $req,"response" => $resp]);
    }

    public function commitTransaction(Request $request)
    {
        $req = $request->except('_token');
        $resp = WebpayPlus\Transaction::commit($req["token_ws"]);

        return view('webpayplus/transaction_committed', ["resp" => $resp, 'req' => $req]);
    }


    public function showRefund()
    {
        return view('webpayplus/refund');
    }

    public function refundTransaction(Request $request)
    {
        $req = $request->except('_token');
        
        $resp = WebpayPlus\Transaction::refund($req["token"], $req["amount"]);

        return view('webpayplus/refund_success', ["resp" => $resp]);
    }

    public function getTransactionStatus(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token"];

        $resp = WebpayPlus\Transaction::status($token);

        return view('webpayplus/transaction_status', ["resp" => $resp, "req" => $req]);
    }
}
