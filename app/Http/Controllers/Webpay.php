<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus;

class Webpay extends Controller
{

    public function createdTransaction(Request $request)
    {
        $req = $request->all();
        $resp = WebpayPlus\Transaction::create($req["buy_order"], $req["session_id"], $req["amount"], $req["return_url"]);

        return view('webpayplus/transaction_created', [ "params" => $req,"response" => $resp]);
    }

    public function commitTransaction(Request $request)
    {

        $req = $request->all();

        $resp = WebpayPlus\Transaction::commit($req["token_ws"]);

        return view('webpayplus/transaction_committed', ["resp" => $resp, 'req' => $req]);
    }


    public function showRefund()
    {
        return view('webpayplus/refund');
    }

    public function refundTransaction(Request $request)
    {
        $req = $request->all();

        $resp = WebpayPlus\Transaction::refund($req["token"], $req["amount"]);

        return view('webpayplus/refund_success', ["resp" => $resp]);
    }

    public function getTransactionStatus(Request $request)
    {
        $req = $request->all();
        $token = $req["token"];

        $resp = WebpayPlus\Transaction::getStatus($token);

        return view('webpayplus/transaction_status', ["resp" => $resp, "req" => $req]);
    }

}
