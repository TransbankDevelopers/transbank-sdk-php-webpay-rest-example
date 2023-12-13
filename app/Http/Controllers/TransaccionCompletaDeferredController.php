<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\TransaccionCompleta\Transaction;
use Transbank\TransaccionCompleta\TransaccionCompleta;
use Transbank\Webpay\Options;

class TransaccionCompletaDeferredController extends Controller
{
    public function __construct(){
        if (app()->environment('production')) {
            TransaccionCompleta::configureForProduction(
                config('services.transbank.transaccion_completa_deferred_cc'),
                config('services.transbank.transaccion_completa_deferred_api_key')
            );
        } else {
            TransaccionCompleta::configureForTestingDeferred();
        }
    }

    public function createTransaction(Request $request)
    {

        $req = $request->except('_token');
        $res = (new Transaction)->create(
            $req["buy_order"],
            $req["session_id"],
            $req["amount"],
            $req["cvv"],
            $req["card_number"],
            $req["card_expiration_date"]
        );

        return view('transaccion_completa/diferido/created', [
            "req" => $req,
            "res" => $res,
        ]);
    }

    public function installments(Request $request)
    {

        $req = $request->except('_token');

        $res = (new Transaction)->installments(
            $req['token_ws'],
            $req["installments_number"]
        );

        return view('transaccion_completa/diferido/installments', [
            "req" => $req,
            "res" => $res
        ]);

    }

    public function commit(Request $request)
    {

        $req = $request->except('_token');

        $res = (new Transaction)->commit(
            $req['token_ws'],
            $req["id_query_installments"],
            $req["deferred_period_index"],
            $req["grace_period"]
        );

        return view('transaccion_completa/diferido/commit', [
            "req" => $req,
            "res" => $res
        ]);
    }

    public function capture(Request $request)
    {
        $req = $request->except('_token');

        $res = (new Transaction)->capture(
            $req["token_ws"],
            $req["buy_order"],
            $req["authorization_code"],
            $req["amount"]
        );

        return view('transaccion_completa/diferido/captured', [
            "req" => $req,
            "res" => $res
        ]);
    }

    public function status(Request $request)
    {

        $req = $request->except('_token');

        $res = (new Transaction)->status(
            $req['token']
        );

        return view('transaccion_completa/diferido/status', [
            "req" => $req,
            "res" => $res
        ]);

    }

    public function refund(Request $request)
    {
        $req = $request->except('_token');

        $res = (new Transaction)->refund(
            $req['token_ws'],
            $req["amount"]
        );

        return view('transaccion_completa/diferido/refund', [
            "req" => $req,
            "res" => $res
        ]);
    }

}
