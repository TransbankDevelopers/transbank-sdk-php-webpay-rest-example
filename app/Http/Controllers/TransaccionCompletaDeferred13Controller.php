<?php

namespace App\Http\Controllers;

use App\Services\TransaccionCompletaDeferred13Service;
use App\Support\TransaccionCompletaDeferredViewConfig;
use Illuminate\Http\Request;
use Transbank\TransaccionCompleta\TransaccionCompleta;

class TransaccionCompletaDeferred13Controller extends Controller
{
    private TransaccionCompletaDeferred13Service $service;

    public function __construct()
    {
        if (app()->environment('production')) {
            $commerceCode = (string) config('services.transbank.transaccion_completa_deferred_1_3_cc', '');
            $apiKey = (string) config('services.transbank.transaccion_completa_deferred_1_3_api_key', '');
        } else {
            $commerceCode = TransaccionCompleta::DEFAULT_DEFERRED_COMMERCE_CODE;
            $apiKey = TransaccionCompleta::DEFAULT_API_KEY;
        }

        $this->service = new TransaccionCompletaDeferred13Service($commerceCode, $apiKey);
    }

    public function createTransaction(Request $request)
    {
        $req = $request->except('_token');

        $payload = [
            'buy_order' => $req['buy_order'],
            'session_id' => $req['session_id'],
            'amount' => (int) $req['amount'],
            'cvv' => $req['cvv'],
            'card_number' => $req['card_number'],
            'card_expiration_date' => $this->formatExpirationDate($req['card_expiration_date']),
        ];

        try {
            $res = $this->service->createTransaction($payload);

            return $this->renderDeferredView('transaccion_completa/diferido/created', $req, $res, [
                'token' => $res['token'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return $this->renderError($e, $req, 'createTransaction');
        }
    }

    public function installments(Request $request)
    {
        $req = $request->except('_token');
        $payload = [
            'installments_number' => (int) $req['installments_number'],
        ];

        try {
            $res = $this->service->installments($req['token_ws'], $payload);

            return $this->renderDeferredView('transaccion_completa/diferido/installments', $req, $res, [
                'token' => $req['token_ws'],
                'idQueryInstallments' => $res['id_query_installments'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return $this->renderError($e, $req, 'installments');
        }
    }

    public function commit(Request $request)
    {
        $req = $request->except('_token');
        $payload = [];

        if (isset($req['id_query_installments']) && $req['id_query_installments'] !== '') {
            $payload['id_query_installments'] = (int) $req['id_query_installments'];
        }

        if (isset($req['deferred_period_index']) && $req['deferred_period_index'] !== '') {
            $payload['deferred_period_index'] = (int) $req['deferred_period_index'];
        }

        $gracePeriod = $this->normalizeGracePeriod($req['grace_period'] ?? null);
        if ($gracePeriod !== null) {
            $payload['grace_period'] = $gracePeriod;
        }

        try {
            $res = $this->service->commit($req['token_ws'], $payload);

            return $this->renderDeferredView('transaccion_completa/diferido/commit', $req, $res, [
                'token' => $req['token_ws'],
                'buyOrder' => $res['buy_order'] ?? null,
                'authorizationCode' => $res['authorization_code'] ?? null,
                'amount' => $res['amount'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return $this->renderError($e, $req, 'commit');
        }
    }

    public function capture(Request $request)
    {
        $req = $request->except('_token');
        $payload = [
            'buy_order' => $req['buy_order'],
            'authorization_code' => $req['authorization_code'],
            'capture_amount' => (int) $req['amount'],
        ];

        try {
            $res = $this->service->capture($req['token_ws'], $payload);

            return $this->renderDeferredView('transaccion_completa/diferido/captured', $req, $res, [
                'token' => $req['token_ws'],
                'capturedAmount' => $res['captured_amount'] ?? ($res['amount'] ?? null),
            ]);
        } catch (\Throwable $e) {
            return $this->renderError($e, $req, 'capture');
        }
    }

    public function status(Request $request)
    {
        $req = $request->except('_token');

        try {
            $res = $this->service->status($req['token']);

            return $this->renderDeferredView('transaccion_completa/diferido/status', $req, $res);
        } catch (\Throwable $e) {
            return $this->renderError($e, $req, 'status');
        }
    }

    public function refund(Request $request)
    {
        $req = $request->except('_token');
        $payload = [
            'amount' => (int) $req['amount'],
        ];

        try {
            $res = $this->service->refund($req['token_ws'], $payload);

            return $this->renderDeferredView('transaccion_completa/diferido/refund', $req, $res);
        } catch (\Throwable $e) {
            return $this->renderError($e, $req, 'refund');
        }
    }

    private function renderDeferredView(string $view, array $req, array $res, array $extra = [])
    {
        return view($view, array_merge([
            'req' => $req,
            'res' => $res,
        ], TransaccionCompletaDeferredViewConfig::api(), $extra));
    }

    private function renderError(\Throwable $e, array $req, string $action)
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

    private function formatExpirationDate(string $value): string
    {
        return substr($value, 3, 2) . '/' . substr($value, 0, 2);
    }

    private function normalizeGracePeriod($value): ?bool
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (is_bool($value)) {
            return $value;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    }
}
