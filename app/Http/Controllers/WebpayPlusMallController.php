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
        $childCommerceCodeNormal = config('services.transbank.webpay_plus_mall_child_cc');
        $childCommerceCode3ds = config('services.transbank.webpay_plus_mall_child_3ds');

        $commerceCodeList = [];
        foreach ($childCommerceCodeNormal as $childNormal){
            if ($childNormal != ""){
                $commerceCodeList[] = ['commerce_code' => $childNormal, 'type_child'=> 'normal'];
            }
        }

        foreach ($childCommerceCode3ds as $child){
            if($child != ""){
                $commerceCodeList[] = ['commerce_code' => $child, 'type_child'=> '3DS'];
            }
        }

        return view('webpayplus/mall_create', compact('commerceCodeList'));
    }

    public function createdMallTransaction(Request $request)
    {

        $req = $request->except('_token');
        $resp = (new WebpayPlus\MallTransaction)->create($req["buy_order"], $req["session_id"],  $req["return_url"], $req["detail"]);

        return view('webpayplus/transaction_created', [ "params" => $req,"response" => $resp]);

    }


    public function commitmallTransaction(Request $request)
    {
        //Flujo normal
        if($request->exists("token_ws")){
            $req = $request->except('_token');
            $token = $req["token_ws"];
            $resp = (new WebpayPlus\MallTransaction)->commit($token);

            return view('webpayplus/mall_transaction_committed', ["params" => $req, "response" => $resp]);
        }

        //Pago abortado
        if($request->exists("TBK_TOKEN")){
            return view('webpayplus/mall_transaction_aborted', ["resp" => $request->all()]);
        }

        //Timeout
        return view('webpayplus/mall_transaction_timeout', ["resp" => $request->all()]);

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
