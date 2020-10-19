<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\Options;
use Transbank\Webpay\authorize;
use Transbank\Webpay\Oneclick\MallInscription;
use Transbank\Webpay\Oneclick\MallTransaction;
use Transbank\Webpay\WebpayPlus;

class OneclickController extends Controller
{

    public function startInscription(Request $request)
    {

        session_start();

        $req = $request->all();
        $userName = $req["user_name"];
        $email = $req["email"];
        $responseUrl = $req["response_url"];

        $resp = MallInscription::start($userName, $email, $responseUrl);

        $_SESSION["user_name"] = $userName;
        $_SESSION["email"] = $email;
        return view('oneclick/inscription_successful', ['resp' => $resp, 'req' => $req]);
    }

    public function finishInscription(Request $request)
    {
        session_start();
        $req = $request->all();
        $token = $req["TBK_TOKEN"];

        $resp = MallInscription::finish($token);
        $userName = array_key_exists("user_name", $_SESSION) ? $_SESSION["user_name"] : '';
        return view('oneclick/inscription_finished', ["resp" => $resp, "req" => $req, "username" => $userName]);

    }

    public function authorizeMall(Request $request)
    {
        session_start();
        $req = $request->all();

        $userName = $req["username"];
        $tbkUser = $req["tbk_user"];
        $parentBuyOrder = $req["buy_order"];
        $childBuyOrder = $req["details"][0]["buy_order"];
        $amount = $req["details"][0]["amount"];
        $installmentsNumber = $req["details"][0]["installments_number"];
        $childCommerceCode = $req["details"][0]["commerce_code"];

        $details = [
            [
                "commerce_code" => $childCommerceCode,
                "buy_order" => $childBuyOrder,
                "amount" => $amount,
                "installments_number" => $installmentsNumber
            ]
        ];

        $apiKey = \Transbank\Webpay\Oneclick::getApiKey();
        $parentCommerceCode = 597055555541;
        $options = new Options($apiKey, $parentCommerceCode);

        $resp = MallTransaction::authorize($userName, $tbkUser, $parentBuyOrder, $details, $options);

        return view('oneclick/authorized_mall', ["req" => $req, "resp" => $resp]);

    }

    public function transactionStatus(Request $request)
    {
        $req = $request->all();
        $buyOrder = $req["buy_order"];

        $apiKey = \Transbank\Webpay\Oneclick::getApiKey();
        $parentCommerceCode = 597055555541;
        $options = new Options($apiKey, $parentCommerceCode);

        $resp = MallTransaction::getStatus($buyOrder, $options);

        return view('oneclick/mall_transaction_status', ["req" => $req, "resp" => $resp]);
    }

    public function refund(Request $request)
    {
        $req = $request->all();
        $buyOrder = $req["parent_buy_order"];
        $childCommerceCode = $req["commerce_code"];
        $childBuyOrder = $req["child_buy_order"];
        $amount = $req["amount"];
        $apiKey = \Transbank\Webpay\Oneclick::getApiKey();
        $parentCommerceCode = 597055555541;
        $options = new Options($apiKey, $parentCommerceCode);

        $resp = MallTransaction::refund($buyOrder, $childCommerceCode, $childBuyOrder, $amount, $options);

        return view('oneclick/mall_refund_transaction', ["req" => $req, "resp" => $resp]);
    }

    public function deleteInscription(Request $request)
    {
        $req = $request->all();
        $tbkUser = $req["tbk_user"];
        $userName = $req["user_name"];

        $apiKey = \Transbank\Webpay\Oneclick::getApiKey();
        $parentCommerceCode = 597055555541;
        $options = new Options($apiKey, $parentCommerceCode);

        $resp = MallInscription::delete($tbkUser, $userName, $options);
        return view('oneclick/mall_inscription_deleted', ["req" => $req, "resp" => $resp]);
    }



}
