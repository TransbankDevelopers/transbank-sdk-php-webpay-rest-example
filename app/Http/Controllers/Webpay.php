<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\Options;
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

    public function createMall(Request $request)
    {
        return view('webpayplus/mall_create');
    }

    public function createdMallTransaction(Request $request)
    {

        $req = $request->all();
        $commerceCode = 597055555535;
        $apiKey = WebpayPlus::getApiKey();
        $options = new Options($apiKey, $commerceCode);

        $resp = WebpayPlus\Transaction::createMall($req["buy_order"], $req["session_id"],  $req["return_url"], $req["detail"], $options);

        return view('webpayplus/transaction_created', [ "params" => $req,"response" => $resp]);

    }


    public function commitmallTransaction(Request $request)
    {
        $req = $request->all();
        $token = $req["token_ws"];
        $commerceCode = 597055555535;
        $apiKey = WebpayPlus::getApiKey();
        $options = new Options($apiKey, $commerceCode);
        $resp = WebpayPlus\Transaction::commitMall($token, $options);


        return view('webpayplus/mall_transaction_committed', ["params" => $req, "response" => $resp]);

    }

    public function getMallTransactionStatus(Request $request)
    {
        $req = $request->all();
        $token = $req["token"];
        $commerceCode = 597055555535;
        $apiKey = WebpayPlus::getApiKey();
        $options = new Options($apiKey, $commerceCode);
        $resp = WebpayPlus\Transaction::getMallStatus($token, $options);

        return view('webpayplus/mall_transaction_status', ["resp" => $resp, "req" => $req]);

    }

    public function refundMallTransaction(Request $request)
    {
        $req = $request->all();
        $token = $req["token"];
        $commerceCode = 597055555535;
        $apiKey = WebpayPlus::getApiKey();

        $options = new Options($apiKey, $commerceCode);
        $resp = WebpayPlus\Transaction::refundMall($token, $req["buy_order"],$req["commerce_code"], $req["amount"], $options);

        dd($resp);
        return view('webpayplus/mall_refund_success', ["req" => $req,"resp" => $resp]);
    }


}
