<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransaccionCompletaStandardBrandWithoutCvv\CreateRequest;
use Illuminate\Http\Request;
use App\Services\TransaccionCompletaStandardBrandService;

class TransaccionCompletaStandardBrandWithoutCvvController extends Controller
{
    private TransaccionCompletaStandardBrandService $standardBrandService;

    public function __construct()
    {
        $this->standardBrandService = new TransaccionCompletaStandardBrandService(
            (string) config('services.transbank.transaccion_completa_mall_standard_brand_without_cvv_cc'),
            (string) config('services.transbank.transaccion_completa_mall_standard_brand_without_cvv_api_key')
        );
    }

    public function showCreate()
    {
        $childCommerceCodes = $this->getChildCommerceCodes();

        return view('transaccion_completa/standard_brand_without_cvv/create', [
            'childCommerceCodes' => $childCommerceCodes,
            'sessionId' => session()->getId(),
        ]);
    }

    public function createTransaction(CreateRequest $request)
    {
        $validated = $request->validated();
        $detail = $validated['details'][0];

        $req = [
            'buy_order' => $validated['buy_order'],
            'session_id' => $validated['session_id'],
            'card_number' => $validated['card_number'],
            'card_expiration_date' => $validated['card_expiration_date'],
            'details' => [
                [
                    'amount' => (int) $detail['amount'],
                    'commerce_code' => $detail['commerce_code'],
                    'buy_order' => $detail['buy_order'],
                    'post_entry_mod' => $detail['post_entry_mod'],
                    'eci' => $detail['eci'] ?? null,
                    'authentication_value' => $detail['authentication_value'] ?? null,
                    'message_version' => $detail['message_version'] ?? null,
                    'trans_status' => $detail['trans_status'] ?? null,
                    'ds_trans_id' => $detail['ds_trans_id'] ?? null,
                    'authentication_type' => $detail['authentication_type'] ?? null,
                    'identify_initiated_trx' => $detail['identify_initiated_trx'] ?? null,
                    'tid' => $detail['tid'] ?? null,
                    'pmnt_ind' => $detail['pmnt_ind'] ?? null,
                    'recur_pmnt' => $detail['recur_pmnt'] ?? null,
                ],
            ],
        ];

        try {
            $resp = $this->standardBrandService->createTransaction($req);

            return view('transaccion_completa/standard_brand_without_cvv/created', [
                'req' => $req,
                'res' => $resp,
            ]);
        } catch (\Throwable $e) {
            return $this->renderError($e, $req, 'createTransaction');
        }
    }

    public function installments(Request $request)
    {
        $validated = $request->validate([
            'token' => 'required|string|max:64',
            'buy_order' => 'required|string|max:26',
            'commerce_code' => 'required|string|max:12',
            'installments_number' => 'required|integer|min:1|max:99',
            'amount' => 'nullable|integer|min:1',
        ]);

        $payload = [
            'buy_order' => $validated['buy_order'],
            'commerce_code' => $validated['commerce_code'],
            'installments_number' => (int) $validated['installments_number'],
        ];

        try {
            $resp = $this->standardBrandService->installments($validated['token'], $payload);

            return view('transaccion_completa/standard_brand_without_cvv/installments', [
                'req' => $validated,
                'res' => $resp,
            ]);
        } catch (\Throwable $e) {
            return $this->renderError($e, $validated, 'installments');
        }
    }

    public function commit(Request $request)
    {
        $validated = $request->validate([
            'token' => 'required|string|max:64',
            'commerce_code' => 'required|string|max:12',
            'buy_order' => 'required|string|max:26',
            'id_query_installments' => 'nullable|integer',
            'amount' => 'nullable|integer|min:1',
        ]);

        $detail = [
            'commerce_code' => $validated['commerce_code'],
            'buy_order' => $validated['buy_order'],
        ];

        if (isset($validated['id_query_installments'])) {
            $detail['id_query_installments'] = $validated['id_query_installments'];
        }

        $payload = [
            'details' => [
                $detail,
            ],
        ];

        try {
            $resp = $this->standardBrandService->commit($validated['token'], $payload);

            return view('transaccion_completa/standard_brand_without_cvv/commit', [
                'req' => $validated,
                'res' => $resp,
            ]);
        } catch (\Throwable $e) {
            return $this->renderError($e, $validated, 'commit');
        }
    }

    public function status(Request $request)
    {
        $validated = $request->validate([
            'token' => 'required|string|max:64',
        ]);

        try {
            $resp = $this->standardBrandService->status($validated['token']);

            return view('transaccion_completa/standard_brand_without_cvv/status', [
                'req' => $validated,
                'res' => $resp,
            ]);
        } catch (\Throwable $e) {
            return $this->renderError($e, $validated, 'status');
        }
    }

    public function refund(Request $request)
    {
        $validated = $request->validate([
            'token' => 'required|string|max:64',
            'commerce_code' => 'required|string|max:12',
            'buy_order' => 'required|string|max:26',
            'amount' => 'required|integer|min:1',
        ]);

        $payload = [
            'commerce_code' => $validated['commerce_code'],
            'buy_order' => $validated['buy_order'],
            'amount' => (int) $validated['amount'],
        ];

        try {
            $resp = $this->standardBrandService->refund($validated['token'], $payload);

            return view('transaccion_completa/standard_brand_without_cvv/refund', [
                'req' => $validated,
                'res' => $resp,
            ]);
        } catch (\Throwable $e) {
            return $this->renderError($e, $validated, 'refund');
        }
    }

    public function showAccountVerify()
    {
        $childCommerceCodes = $this->getChildCommerceCodes();

        return view('transaccion_completa/standard_brand_without_cvv/account_verify_form', [
            'childCommerceCodes' => $childCommerceCodes,
        ]);
    }

    public function accountVerify(Request $request)
    {
        $validated = $request->validate([
            'card_number' => ['required', 'string', 'regex:/^\d{12,19}$/'],
            'card_expiration_date' => ['required', 'string', 'regex:/^\d{2}\/(0[1-9]|1[0-2])$/'],
            'cvv' => 'required|string|max:4',
            'eci' => 'nullable|in:01,02,05,06',
            'authentication_value' => 'nullable|string|max:255',
            'trans_status' => 'nullable|in:C,Y,A,N,R,D,U,I',
            'message_version' => 'nullable|string|max:255',
            'ds_trans_id' => 'nullable|string|max:255',
            'commerce_code' => 'required|string|max:12',
        ]);

        $payload = [
            'card_detail' => [
                'card_number' => $validated['card_number'],
                'card_expiration_date' => $validated['card_expiration_date'],
                'cvv' => $validated['cvv'],
            ],
            'commerce_code' => $validated['commerce_code'],
        ];

        foreach (['eci', 'authentication_value', 'trans_status', 'message_version', 'ds_trans_id'] as $field) {
            if (isset($validated[$field]) && $validated[$field] !== '') {
                $payload[$field] = $validated[$field];
            }
        }

        try {
            $resp = $this->standardBrandService->accountVerify($payload);

            return view('transaccion_completa/standard_brand_without_cvv/account_verify_result', [
                'req' => $validated,
                'res' => $resp,
            ]);
        } catch (\Throwable $e) {
            return $this->renderError($e, $validated, 'accountVerify');
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
        $codes = config('services.transbank.transaccion_completa_mall_standard_brand_without_cvv_child_cc');

        if (is_array($codes)) {
            return $codes;
        }

        if (is_string($codes) && trim($codes) !== '') {
            return array_map('trim', explode(',', $codes));
        }

        return [];
    }
}
