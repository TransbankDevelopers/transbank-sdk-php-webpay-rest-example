<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\Exceptions\WebpayRequestException;
use Transbank\Webpay\Modal\Exceptions\TransactionRefundException;
use Transbank\Webpay\Modal\Transaction;

class WebpayModalController extends Controller
{
    public function create_form()
    {
        return view('modal/create-form');
    }

    public function create(Request $request)
    {
        try {
            $response = Transaction::create($request->get('amount'), $request->get('buy_order'), $request->get('session_id'));
        } catch (WebpayRequestException $e) {
            dd($e);
        }
        

        return view('modal/created', [
            'token' => $response->getToken(),
            'response' => json_decode(json_encode($response), true),
            'request' => $request->except('_token')
        ]);
    }

    public function commit(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
        $response = Transaction::commit($request->get('token'));
        return response()->json($response);
    }

    public function status(Request $request, $token)
    {
        $response = Transaction::status($token);
        return view('modal/status', ['transaction' => $response, 'token' => $token]);
    }

    public function refund(Request $request)
    {
        $this->validate($request, [
            'refund_token' => 'required',
            'refund_amount' => 'required',
        ]);
        $request = [
            'token' => $request->get('refund_token'),
            'amount' => $request->get('refund_amount')
        ];
        $error = false;
        $response = null;
        try {
            $response = Transaction::refund($request['token'], $request['amount']);
        } catch (TransactionRefundException $e) {
            $error = $e->getTransbankError();
        }

        return view('modal/refunded', ['response' => $response, 'request' => $request, 'error' => $error]);
    }
}
