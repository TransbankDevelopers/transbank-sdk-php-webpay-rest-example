<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\TransaccionCompleta\Transaction;
use Transbank\TransaccionCompleta\TransaccionCompleta;
use Transbank\Webpay\Options;

class TransaccionCompletaDeferredController extends Controller
{
    private const ROUTE_NAMES = [
        'index' => 'completa.diferido.index',
        'create' => 'completa.deferred.create',
        'installments' => 'completa.deferred.installments',
        'commit' => 'completa.deferred.commit',
        'capture' => 'completa.deferred.capture',
        'status' => 'completa.deferred.status',
        'refund' => 'completa.deferred.refund',
    ];

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
        try {
            $expirationDateFormated = substr($req["card_expiration_date"], 3, 2) . "/" . substr($req["card_expiration_date"], 0, 2);
            $res = (new Transaction)->create(
                $req["buy_order"],
                $req["session_id"],
                $req["amount"],
                $req["cvv"],
                $req["card_number"],
                $expirationDateFormated
            );

            return $this->renderDeferredView('transaccion_completa/diferido/created', $req, $res, [
                'ui' => [
                    'token' => $res->getToken(),
                ],
            ]);
        } catch (\Throwable $e) {
            return $this->renderError($e, $req, 'createTransaction');
        }
    }

    public function installments(Request $request)
    {

        $req = $request->except('_token');

        try {
            $res = (new Transaction)->installments(
                $req['token_ws'],
                $req["installments_number"]
            );

            return $this->renderDeferredView('transaccion_completa/diferido/installments', $req, $res, [
                'ui' => [
                    'token' => $req['token_ws'],
                    'id_query_installments' => $res->getIdQueryInstallments(),
                ],
            ]);
        } catch (\Throwable $e) {
            return $this->renderError($e, $req, 'installments');
        }

    }

    public function commit(Request $request)
    {

        $req = $request->except('_token');

        try {
            $res = (new Transaction)->commit(
                $req['token_ws'],
                $req["id_query_installments"] ?? null,
                $req["deferred_period_index"] ?? null,
                $req["grace_period"] ?? null
            );

            return $this->renderDeferredView('transaccion_completa/diferido/commit', $req, $res, [
                'ui' => [
                    'token' => $req['token_ws'],
                    'buy_order' => $res->buyOrder,
                    'authorization_code' => $res->authorizationCode,
                    'amount' => $res->amount,
                ],
            ]);
        } catch (\Throwable $e) {
            return $this->renderError($e, $req, 'commit');
        }
    }

    public function capture(Request $request)
    {
        $req = $request->except('_token');

        try {
            $res = (new Transaction)->capture(
                $req["token_ws"],
                $req["buy_order"],
                $req["authorization_code"],
                $req["amount"]
            );

            return $this->renderDeferredView('transaccion_completa/diferido/captured', $req, $res, [
                'ui' => [
                    'token' => $req['token_ws'],
                    'captured_amount' => $res->getCapturedAmount(),
                ],
            ]);
        } catch (\Throwable $e) {
            return $this->renderError($e, $req, 'capture');
        }
    }

    public function status(Request $request)
    {

        $req = $request->except('_token');

        try {
            $res = (new Transaction)->status(
                $req['token']
            );

            return $this->renderDeferredView('transaccion_completa/diferido/status', $req, $res);
        } catch (\Throwable $e) {
            return $this->renderError($e, $req, 'status');
        }

    }

    public function refund(Request $request)
    {
        $req = $request->except('_token');

        try {
            $res = (new Transaction)->refund(
                $req['token_ws'],
                $req["amount"]
            );

            return $this->renderDeferredView('transaccion_completa/diferido/refund', $req, $res);
        } catch (\Throwable $e) {
            return $this->renderError($e, $req, 'refund');
        }
    }

    protected function renderDeferredView(string $view, array $req, $res, array $extra = [])
    {
        return view($view, array_merge([
            'req' => $req,
            'res' => $res,
            'routeNames' => static::ROUTE_NAMES,
            'productLabel' => 'Transacción Completa Diferida',
        ], $extra));
    }

    protected function renderError(\Throwable $e, array $req, string $action)
    {
        $status = (int) $e->getCode();
        if ($status < 100 || $status > 599) {
            $status = 500;
        }

        return response()->view('errors/general', [
            'action' => $action,
            'status' => $status,
            'message' => $e->getMessage(),
            'req' => $req,
        ], $status);
    }
}
