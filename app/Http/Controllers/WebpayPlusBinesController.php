<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;

class WebpayPlusBinesController extends Controller
{
    public function __construct()
    {
        if (app()->environment('production')) {
            WebpayPlus::configureForProduction(
                config('services.transbank.webpay_plus_bines_cc'),
                config('services.transbank.webpay_plus_bines_api_key')
            );
        } else {
            WebpayPlus::configureForTesting();
        }
    }

    public function createdTransaction(Request $request)
    {
        $req = $request->except('_token');
        $response = (new Transaction)->create(
            $req['buy_order'],
            $req['session_id'],
            $req['amount'],
            $req['return_url']
        );

        return view('webpayplus/bines/transaction_created', [
            'params' => $req,
            'response' => $response,
        ]);
    }

    public function commitTransaction(Request $request)
    {
        if ($request->exists('token_ws')) {
            $req = $request->except('_token');
            $response = (new Transaction)->commit($req['token_ws']);

            return view('webpayplus/bines/transaction_committed', [
                'resp' => $response,
                'req' => $req,
            ]);
        }

        if ($request->exists('TBK_TOKEN')) {
            return view('webpayplus/bines/transaction_aborted', ['resp' => $request->all()]);
        }

        return view('webpayplus/bines/transaction_timeout', ['resp' => $request->all()]);
    }

    public function showRefund()
    {
        return view('webpayplus/bines/refund');
    }

    public function refundTransaction(Request $request)
    {
        $error = false;
        try {
            $req = $request->except('_token');
            $response = (new Transaction)->refund($req['token'], $req['amount']);
        } catch (\Exception $exception) {
            $response = [
                'msg' => $exception->getMessage(),
                'code' => $exception->getCode(),
            ];
            $error = true;
        }

        return view('webpayplus/bines/refund_success', ['resp' => $response, 'error' => $error]);
    }

    public function getTransactionStatus(Request $request)
    {
        $req = $request->except('_token');
        $response = (new Transaction)->status($req['token']);

        return view('webpayplus/bines/transaction_status', [
            'resp' => $response,
            'req' => $req,
        ]);
    }
}
