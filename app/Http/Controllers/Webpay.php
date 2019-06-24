<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus;

class Webpay extends Controller
{

    public function createTransaction(Request $request)
    {

    }


    public function createdTransactionResult(Request $request)
    {
        $req = $request->all();
        $resp = WebpayPlus::create($req["buy_order"], $req["session_id"], $req["amount"], $req["return_url"]);

        return view('webpayplus/transaction_created', [ "params" => $req,"response" => $resp]);
    }
}
