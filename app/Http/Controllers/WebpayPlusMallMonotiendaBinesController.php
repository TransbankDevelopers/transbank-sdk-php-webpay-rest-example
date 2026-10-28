<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\MallTransaction;

class WebpayPlusMallMonotiendaBinesController extends Controller
{
    public function __construct()
    {
        if (app()->environment('production')) {
            WebpayPlus::configureForProduction(
                config('services.transbank.webpay_plus_mall_monotienda_bines_cc'),
                config('services.transbank.webpay_plus_mall_monotienda_bines_api_key')
            );
        } else {
            WebpayPlus::configureForTestingMall();
        }
    }

    public function createMall()
    {
        $childCommerceCode = config('services.transbank.webpay_plus_mall_monotienda_bines_child_cc');

        return view('webpayplus/mall_monotienda_bines/create', compact('childCommerceCode'));
    }

    public function createdMallTransaction(Request $request)
    {
        $req = $request->except('_token');
        $response = (new MallTransaction)->create(
            $req['buy_order'],
            $req['session_id'],
            $req['return_url'],
            $req['detail']
        );

        return view('webpayplus/mall_monotienda_bines/transaction_created', [
            'params' => $req,
            'response' => $response,
        ]);
    }

    public function commitMallTransaction(Request $request)
    {
        if ($request->exists('token_ws')) {
            $req = $request->except('_token');
            $response = (new MallTransaction)->commit($req['token_ws']);

            return view('webpayplus/mall_monotienda_bines/transaction_committed', [
                'params' => $req,
                'response' => $response,
            ]);
        }

        if ($request->exists('TBK_TOKEN')) {
            return view('webpayplus/mall_monotienda_bines/transaction_aborted', ['resp' => $request->all()]);
        }

        return view('webpayplus/mall_monotienda_bines/transaction_timeout', ['resp' => $request->all()]);
    }

    public function getMallTransactionStatus(Request $request)
    {
        $req = $request->except('_token');
        $response = (new MallTransaction)->status($req['token']);

        return view('webpayplus/mall_monotienda_bines/transaction_status', [
            'resp' => $response,
            'req' => $req,
        ]);
    }

    public function showMallRefund()
    {
        return view('webpayplus/mall_monotienda_bines/refund');
    }

    public function refundMallTransaction(Request $request)
    {
        $req = $request->except('_token');
        $response = (new MallTransaction)->refund(
            $req['token'],
            $req['buy_order'],
            $req['commerce_code'],
            $req['amount']
        );

        return view('webpayplus/mall_monotienda_bines/refund_success', [
            'req' => $req,
            'resp' => $response,
        ]);
    }
}
