<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Transbank\Patpass;
use Transbank\Patpass\PatpassByWebpay;
use \Transbank\Patpass\PatpassByWebpay\Transaction;


class PatpassWebpay extends Controller
{
    public function create(Request $request)
    {
       PatpassByWebpay::configureForTesting();

        $req = $request->all();
        $resp = Transaction::create($req["buy_order"], $req["session_id"], $req["amount"], $req["return_url"], $req["details"]);

        return view('patpass_by_webpay/transaction_created', [ "req" => $req,"resp" => $resp]);
    }

    public function commitTransaction(Request $request)
    {
        \Transbank\Patpass\PatpassByWebpay::configureForTesting();
        $req = $request->all();
        $token = $req['token_ws'];
        $resp = Transaction::commit($token);

        return view('patpass_by_webpay/transaction_committed', ['req' => $req, 'resp' => $resp]);

    }

    public function getTransactionStatus(Request $request)
    {
        \Transbank\Patpass\PatpassByWebpay::configureForTesting();
        $req = $request->all();
        $token = $req['token'];

        $resp = Transaction::getStatus($token);

        return view('patpass_by_webpay/transaction_status', ['req' => $req, 'resp' => $resp]);
    }
}
