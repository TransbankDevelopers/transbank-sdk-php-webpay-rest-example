<?php

/**
 * Class TransaccionCompleta
 *
 * @category
 * @package App\Http\Controllers
 *
 */


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\TransaccionCompleta\Transaction;
use Transbank\TransaccionCompleta\TransaccionCompleta;
use Transbank\Webpay\Options;

class TransaccionCompletaController extends Controller
{

    public function __construct(){
        if (app()->environment('production')) {
            TransaccionCompleta::configureForProduction(config('services.transbank.transaccion_completa_cc'), config('services.transbank.transaccion_completa_api_key'));
        } else {
            TransaccionCompleta::configureForTesting();
        }
    }

    public function createTransaction(Request $request)
    {

        $req = $request->all();
        $res = (new Transaction)->create(
            $req["buy_order"],
            $req["session_id"],
            $req["amount"],
            $req["cvv"],
            $req["card_number"],
            $req["card_expiration_date"]
        );

        return view('transaccion_completa/transaction_created', [
            "req" => $req,
            "res" => $res,
        ]);
    }

    public function installments(Request $request)
    {

        $req = $request->all();

        $res = (new Transaction)->installments(
            $req['token_ws'],
            $req["installments_number"]
        );

        return view('transaccion_completa/transaction_installments', [
            "req" => $req,
            "res" => $res
        ]);

    }

    public function commit(Request $request)
    {

        $req = $request->all();

        $res = (new Transaction)->commit(
            $req['token_ws'],
            $req["id_query_installments"],
            $req["deferred_period_index"],
            $req["grace_period"]
        );

        return view('transaccion_completa/transaction_commit', [
            "req" => $req,
            "res" => $res
        ]);
    }

    public function status(Request $request)
    {

        $req = $request->all();

        $res = (new Transaction)->status(
            $req['token_ws']
        );

        return view('transaccion_completa/transaction_status', [
            "req" => $req,
            "res" => $res
        ]);

    }

    public function refund(Request $request)
    {
        $req = $request->all();

        $res = (new Transaction)->refund(
            $req['token_ws'],
            $req["amount"]
        );

        return view('transaccion_completa/refund', [
            "req" => $req,
            "res" => $res
        ]);
    }
}
