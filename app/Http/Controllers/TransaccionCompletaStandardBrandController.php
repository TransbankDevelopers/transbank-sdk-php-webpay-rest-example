<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TransaccionCompletaStandardBrandService;

class TransaccionCompletaStandardBrandController extends Controller
{
    private TransaccionCompletaStandardBrandService $standardBrandService;

    public function __construct()
    {
        $this->standardBrandService = new TransaccionCompletaStandardBrandService(
            config('services.transbank.transacction_completa_mall_standard_brand_cc'),
            config('services.transbank.transacction_completa_mall_standard_brand_api_key')
        );
    }

    public function showCreate()
    {
        $childCommerceCodes = $this->getChildCommerceCodes();

        return view('transaccion_completa/standard_brand/create', [
            'childCommerceCodes' => $childCommerceCodes,
            'sessionId' => session()->getId(),
        ]);
    }

    public function createTransaction(Request $request)
    {
        $req = $request->except('_token');
        try {
            $resp = $this->standardBrandService->createTransaction($req);

            return view('transaccion_completa/standard_brand/created', [
                'req' => $req,
                'res' => $resp,
            ]);
        } catch (\Throwable $e) {
            return $this->renderError($e, $req, 'createTransaction');
        }
    }

    public function installments(Request $request)
    {
        $req = $request->except('_token');

        $payload = [
            'buy_order' => $req['buy_order'],
            'commerce_code' => $req['commerce_code'],
            'installments_number' => (int) $req['installments_number'],
        ];

        try {
            $resp = $this->standardBrandService->installments($req['token'], $payload);

            return view('transaccion_completa/standard_brand/installments', [
                'req' => $req,
                'res' => $resp,
            ]);
        } catch (\Throwable $e) {
            return $this->renderError($e, $req, 'installments');
        }
    }

    public function commit(Request $request)
    {
        $req = $request->except('_token');

        $detail = [
            'commerce_code' => $req['commerce_code'],
            'buy_order' => $req['buy_order'],
        ];

        if (isset($req['id_query_installments'])) {
            $detail['id_query_installments'] = (int) $req['id_query_installments'];
        }

        $payload = [
            'details' => [
                $detail,
            ],
        ];

        try {
            $resp = $this->standardBrandService->commit($req['token'], $payload);

            return view('transaccion_completa/standard_brand/commit', [
                'req' => $req,
                'res' => $resp,
            ]);
        } catch (\Throwable $e) {
            return $this->renderError($e, $req, 'commit');
        }
    }

    public function status(Request $request)
    {
        $req = $request->except('_token');
        try {
            $resp = $this->standardBrandService->status($req['token']);

            return view('transaccion_completa/standard_brand/status', [
                'req' => $req,
                'res' => $resp,
            ]);
        } catch (\Throwable $e) {
            return $this->renderError($e, $req, 'status');
        }
    }

    public function refund(Request $request)
    {
        $req = $request->except('_token');

        $payload = [
            'commerce_code' => $req['commerce_code'],
            'buy_order' => $req['buy_order'],
            'amount' => (int) $req['amount'],
        ];

        try {
            $resp = $this->standardBrandService->refund($req['token'], $payload);

            return view('transaccion_completa/standard_brand/refund', [
                'req' => $req,
                'res' => $resp,
            ]);
        } catch (\Throwable $e) {
            return $this->renderError($e, $req, 'refund');
        }
    }

    public function showAccountVerify()
    {
        $childCommerceCodes = $this->getChildCommerceCodes();

        return view('transaccion_completa/standard_brand/account_verify_form', [
            'childCommerceCodes' => $childCommerceCodes,
        ]);
    }

    public function accountVerify(Request $request)
    {
        $req = $request->except('_token');

        $payload = [
            'card_detail' => [
                'card_number' => $req['card_number'],
                'card_expiration_date' => $req['card_expiration_date'],
                'cvv' => $req['cvv'],
            ],
            'eci' => $req['eci'],
            'authentication_value' => $req['authentication_value'],
            'trans_status' => $req['trans_status'],
            'message_version' => $req['message_version'],
            'ds_trans_id' => $req['ds_trans_id'],
            'commerce_code' => $req['commerce_code'],
        ];

        try {
            $resp = $this->standardBrandService->accountVerify($payload);

            return view('transaccion_completa/standard_brand/account_verify_result', [
                'req' => $req,
                'res' => $resp,
            ]);
        } catch (\Throwable $e) {
            return $this->renderError($e, $req, 'accountVerify');
        }
    }

    private function renderError(\Throwable $e, array $req, string $action)
    {
        $status = (int) $e->getCode();
        if ($status < 100 || $status > 599) {
            $status = 500;
        }

        $view = $status >= 400 && $status < 500
            ? 'errors/standard_brand_error'
            : 'errors/general';

        return response()->view($view, [
            'action' => $action,
            'status' => $status,
            'message' => $e->getMessage(),
            'req' => $req,
        ], $status);
    }

    private function getChildCommerceCodes(): array
    {
        $codes = config('services.transbank.transacction_completa_mall_standard_brand_child_cc');

        if (is_array($codes)) {
            return $codes;
        }

        if (is_string($codes) && trim($codes) !== '') {
            return array_map('trim', explode(',', $codes));
        }

        return ['597038367138'];
    }
}
