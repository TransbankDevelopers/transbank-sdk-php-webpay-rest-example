<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus;

class WebpayPlusMallDuesQrController extends Controller
{
    public function __construct(){
        if (app()->environment('production')) {
            WebpayPlus::configureForProduction(config('services.transbank.webpay_plus_mall_dues_qr_cc'),
            config('services.transbank.webpay_plus_mall_dues_qr_api_key'));
        } else {
            WebpayPlus::configureForTestingMall();
        }
    }

    public function createMall(Request $request)
    {
        $childCommerceCodeNormal = config('services.transbank.webpay_plus_mall_dues_qr_child_cc');

        $commerceCodeList = [];
        foreach ($childCommerceCodeNormal as $childNormal){
            if ($childNormal != ""){
                $commerceCodeList[] = ['commerce_code' => $childNormal, 'type_child'=> 'normal'];
            }
        }

        return view('webpayplus/mall_dues_qr/mall_create', compact('commerceCodeList'));
    }

    public function createdMallTransaction(Request $request)
    {
        $req = $request->except('_token');
        $new_details = [];
        foreach($req["detail"] as $item) {
            if (isset($item["active"]) && $item["active"] == "1"){
                $new_detail = [];
                $new_detail["commerce_code"] = $item["commerce_code"];
                $new_detail["buy_order"] = $item["buy_order"];
                $new_detail["amount"] = $item["amount"];

                $new_details[] = $new_detail;
            }
        }
        $req["detail"] = $new_details;
        $resp = (new WebpayPlus\MallTransaction)->create($req["buy_order"],
            $req["session_id"],
            $req["return_url"],
            $req["detail"]);

        return view('webpayplus/transaction_created', [ "params" => $req,"response" => $resp]);

    }


    public function commitmallTransaction(Request $request)
    {
        //Flujo normal
        if($request->exists("token_ws")){
            $req = $request->except('_token');
            $token = $req["token_ws"];
            $resp = (new WebpayPlus\MallTransaction)->commit($token);

            return view('webpayplus/mall_dues_qr/mall_transaction_committed', ["params" => $req, "response" => $resp]);
        }

        //Pago abortado
        if($request->exists("TBK_TOKEN")){
            return view('webpayplus/mall_dues_qr/mall_transaction_aborted', ["resp" => $request->all()]);
        }

        //Timeout
        return view('webpayplus/mall_dues_qr/mall_transaction_timeout', ["resp" => $request->all()]);

    }

    public function getMallTransactionStatus(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token"];
        $resp = (new WebpayPlus\MallTransaction)->status($token);

        return view('webpayplus/mall_dues_qr/mall_transaction_status', ["resp" => $resp, "req" => $req]);
    }

    public function refundMallTransaction(Request $request)
    {
        $req = $request->except('_token');
        $token = $req["token"];
        try {
            $resp = (new WebpayPlus\MallTransaction)->refund($token,
                $req["buy_order"],
                $req["commerce_code"],
                $req["amount"]);
        } catch (WebpayPlus\Exceptions\TransactionRefundException $e) {
            dd($e);
        }


        return view('webpayplus/mall_dues_qr/mall_refund_success', ["req" => $req,"resp" => $resp]);
    }
}
