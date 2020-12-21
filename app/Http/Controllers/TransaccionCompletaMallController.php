<?php

/**
 * Class TransaccionCompletaMall
 *
 * @category
 * @package App\Http\Controllers
 *
 */


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Transbank\TransaccionCompleta;
use Transbank\TransaccionCompleta\MallTransaction;
use Transbank\TransaccionCompleta\MallTransaccionCompleta;
use Transbank\TransaccionCompleta\Options;

class TransaccionCompletaMallController
{

    public function __construct(){
        if (app()->environment('production')) {
            TransaccionCompleta::setCommerceCode(config('services.transbank.transaccion_completa_mall_cc'));
            TransaccionCompleta::setApiKey(config('services.transbank.transaccion_completa_mall_api_key'));
            TransaccionCompleta::setIntegrationType('LIVE');
        } else {
            TransaccionCompleta::configureMallForTesting();
        }
    }

    public function showMallCreate(Request $request)
    {
        $childCommerceCodes = Options::DEFAULT_TRANSACCION_COMPLETA_MALL_CHILD_COMMERCE_CODE;
        return view('transaccion_completa/mall_create',["childCommerceCodes" => $childCommerceCodes ]);
    }


    public function mallCreate(Request $request) {
        MallTransaccionCompleta::configureForTesting();

        $req = $request->all();
        $res = MallTransaction::create(
            $req["buy_order"],
            $req["session_id"],
            $req["card_number"],
            $req["card_expiration_date"],
            $req["details"]
        );


        return view('transaccion_completa/mall_created', [
                "req" => $req,
                "res" => $res,
                "details" => $req["details"]
        ]);
    }

    public function mallInstallments(Request $request)
    {
        MallTransaccionCompleta::configureForTesting();

        $req = $request->all();
        $res = MallTransaction::installments(
            $req["token_ws"],
            $req["details"]
        );

        return view('transaccion_completa/mall_installments', [
            "req" => $req,
            "res" => $res,
            "details" => $req["details"]
        ]);

    }

    public function mallCommit(Request $request)
    {
        MallTransaccionCompleta::configureForTesting();

        $req = $request->all();
        $res = MallTransaction::commit(
            $req["token"],
            $req["details"]
        );

        return view('transaccion_completa/mall_commit', [
            "req" => $req,
            "res" => $res
        ]);

    }

    public function mallStatus($token, Request $request)
    {
        MallTransaccionCompleta::configureForTesting();

        $req = $request->all();
        $res = MallTransaction::getStatus($token);

        return view('transaccion_completa/mall_status', [
            "req" => $req,
            "res" => $res,
            "token" => $token
        ]);
    }

    public function mallRefund(Request $request)
    {
        MallTransaccionCompleta::configureForTesting();

        $req = $request->all();

        $res = MallTransaction::refund(
          $req["token"],
          $req["child_buy_order"],
          $req["child_commerce_code"],
          $req["amount"]
        );

        return view('transaccion_completa/mall_refund', [
            "req" => $req,
            "res" => $res
        ]);

    }


}
