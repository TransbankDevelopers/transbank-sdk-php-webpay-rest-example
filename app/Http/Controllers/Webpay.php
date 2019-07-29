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

       # dd($resp);
        return view('webpayplus/mall_refund_success', ["req" => $req,"resp" => $resp]);
    }


    public function createDiferido(Request $request)
    {
        $req = $request->all();
        $commerceCode = 597055555540;
        $apiKey = WebpayPlus::getApiKey();
        $options = new Options($apiKey, $commerceCode);
        $resp = WebpayPlus\Transaction::create($req["buy_order"], $req["session_id"], $req["amount"], $req["return_url"], $options);

        return view('webpayplus/diferido/transaction_created', [ "params" => $req,"response" => $resp]);
    }

    public function commitDiferidoTransaction(Request $request)
    {

        $req = $request->all();
        $commerceCode = 597055555540;
        $apiKey = WebpayPlus::getApiKey();
        $options = new Options($apiKey, $commerceCode);
        $resp = WebpayPlus\Transaction::commit($req["token_ws"], $options);

        return view('webpayplus/diferido/transaction_committed', ["resp" => $resp, 'req' => $req]);
    }


    public function captureDiferido(Request $request)
    {
        $req = $request->all();
        $token = $req["token"];
        $buyOrder = $req["buy_order"];
        $authCode = $req["authorization_code"];
        $amount = (int)$req["capture_amount"];
        $commerceCode = 597055555540;
        $apiKey = WebpayPlus::getApiKey();
        $options = new Options($apiKey, $commerceCode);

        $resp = WebpayPlus\Transaction::capture($token, $buyOrder, $authCode, $amount, $options);

        return view('webpayplus/diferido/transaction_captured', ["req" => $req, 'resp' => $resp]);

    }

    public function statusDiferido(Request $request)
    {
        $req = $request->all();
        $token = $req["token"];
        $commerceCode = 597055555540;
        $apiKey = WebpayPlus::getApiKey();
        $options = new Options($apiKey, $commerceCode);

        $resp = WebpayPlus\Transaction::getStatus($token, $options);
        dd($resp);
    }

    public function refundDiferido(Request $request)
    {
        $req = $request->all();
        $token = $req["token"];
        $amount = $req["amount"];

        $commerceCode = 597055555540;
        $apiKey = WebpayPlus::getApiKey();
        $options = new Options($apiKey, $commerceCode);
        $resp = WebpayPlus\Transaction::refund($token, $amount, $options);
        dd($resp);

    }

    public function createMallDiferido(Request $request)
    {
        $req = $request->all();
        $commerceCode = 597055555544;
        $apiKey = WebpayPlus::getApiKey();
        $options = new Options($apiKey, $commerceCode);

        $resp = WebpayPlus\Transaction::createMall($req["buy_order"], $req["session_id"],  $req["return_url"], $req["detail"], $options);

        return view('webpayplus/mall/diferido/transaction_created', [ "params" => $req,"response" => $resp]);
    }

    public function commitMallDiferido(Request $request)
    {
        $req = $request->all();
        $commerceCode = 597055555544;
        $apiKey = WebpayPlus::getApiKey();
        $options = new Options($apiKey, $commerceCode);
        $resp = WebpayPlus\Transaction::commitMall($req["token_ws"], $options);

        return view('webpayplus/mall/diferido/transaction_committed', ["resp" => $resp, 'req' => $req]);
    }

    public function captureMallDiferido(Request $request)
    {
        $req = $request->all();
        $token = $req["token"];
        $childCommerceCode = $req["commerce_code"];
        $buyOrder = $req["buy_order"];
        $authCode = $req["authorization_code"];
        $amount = (int)$req["capture_amount"];
        $commerceCode = 597055555544;
        $apiKey = WebpayPlus::getApiKey();
        $options = new Options($apiKey, $commerceCode);

        $resp = WebpayPlus\Transaction::captureMall($childCommerceCode, $token, $buyOrder, $authCode, $amount, $options);

        return view('webpayplus/mall/diferido/transaction_captured', ["req" => $req, 'resp' => $resp]);

    }

    public function refundMallDiferido(Request $request)
    {
        $req = $request->all();
        $token = $req["token"];
        $amount = $req["amount"];
        $childCommerceCode = $req["child_commerce_code"];
        $childBuyOrder = $req["child_buy_order"];
        $commerceCode = 597055555544;
        $apiKey = WebpayPlus::getApiKey();
        $options = new Options($apiKey, $commerceCode);
        $resp = WebpayPlus\Transaction::refundMall($token, $childBuyOrder, $childCommerceCode, $amount, $options);
        dd($resp);
    }

    public function statusMallDiferido(Request $request)
    {
        $req = $request->all();
        $token = $req["token"];
        $commerceCode = 597055555544;
        $apiKey = WebpayPlus::getApiKey();
        $options = new Options($apiKey, $commerceCode);

        $resp = WebpayPlus\Transaction::getMallStatus($token, $options);
        dd($resp);
    }





}
