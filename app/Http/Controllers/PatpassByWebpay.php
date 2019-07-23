<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\PatPassByWebpay\Transaction;

class PatpassByWebpay extends Controller
{
    public function create(Request $request)
    {
        \Transbank\Webpay\PatPassByWebpay::configureForTesting();

        $req = $request->all();
        $resp = Transaction::create($req["buy_order"], $req["session_id"], $req["amount"], $req["return_url"], $req["details"]);

        return view('patpass_by_webpay/transaction_created', [ "req" => $req,"resp" => $resp]);
    }

    public function commitTransaction(Request $request)
    {
        \Transbank\Webpay\PatPassByWebpay::configureForTesting();
        $req = $request->all();
        if (isset($req['token_ws'])) {
            $token = $req['token_ws'];
        } elseif (isset($req['TBK_TOKEN'])) {
            $token = $req['TBK_TOKEN'];
        }


        $resp = Transaction::commit($token);



        return view('patpass_by_webpay/transaction_committed', ['req' => $req, 'resp' => $resp]);

    }
}
