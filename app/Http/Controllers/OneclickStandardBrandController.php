<?php

namespace App\Http\Controllers;

use App\Http\Requests\OneclickStandardBrand\AuthorizeRequest;
use Illuminate\Http\Request;
use App\Services\OneClickStandardBrandService;

class OneclickStandardBrandController extends Controller
{
    private OneClickStandardBrandService $standardBrandService;
    private $childCC;

    public function __construct()
    {
        if (app()->environment('production')) {
            $this->standardBrandService = new OneClickStandardBrandService(
                config('services.transbank.oneclick_mall_standard_brand_cc'),
                config('services.transbank.oneclick_mall_standard_brand_api_key')
            );
            $this->childCC = config('services.transbank.oneclick_mall_standard_brand_child_cc');
        } else {
            // TODO: Add testing configuration here
            $this->standardBrandService = new OneClickStandardBrandService(
                config('services.transbank.oneclick_mall_standard_brand_cc'),
                config('services.transbank.oneclick_mall_standard_brand_api_key')
            );
            $this->childCC = config('services.transbank.oneclick_mall_standard_brand_child_cc');
        }
    }

    public function startInscription(Request $request)
    {

        session_start();

        $req = $request->except('_token');
        $userName = $req["user_name"];
        $email = $req["email"];
        $responseUrl = $req["response_url"];

        $resp = $this->standardBrandService->startInscription($userName, $email, $responseUrl);

        $_SESSION["user_name"] = $userName;
        $_SESSION["email"] = $email;
        return view('oneclick/standard_brand/inscription_successful', ['resp' => $resp, 'req' => $req]);
    }


    public function finishInscription(Request $request)
    {
        session_start();
        $req = $request->except('_token');
        $token = $req["TBK_TOKEN"];

        $resp = $this->standardBrandService->finishInscription($token);

        $metaData = [
            "ip_address" => $request->ip(),
            "accept_header" => $request->header('Accept'),
            "user_agent" => $request->header('User-Agent'),
            "language" => $request->header('Accept-Language')
        ];

        $userName = array_key_exists("user_name", $_SESSION) ? $_SESSION["user_name"] : '';
        return view('oneclick/standard_brand/inscription_finished', [
            "resp" => $resp,
            "req" => $req,
            "username" => $userName,
            "metaData" => $metaData,
            "childCC" => $this->childCC,
        ]);
    }

    public function showDirectAuthorize(Request $request)
    {
        $metaData = [
            "ip_address" => $request->ip(),
            "accept_header" => $request->header('Accept'),
            "user_agent" => $request->header('User-Agent'),
            "language" => $request->header('Accept-Language')
        ];
        $parentBuyOrder = (string) random_int(100000000, 999999999);
        $detailsBuyOrder = 'child-' . random_int(100000000, 999999999);

        return view('oneclick/standard_brand/authorize_directly', [
            "metaData" => $metaData,
            "childCC" => $this->childCC,
            "parentBuyOrder" => $parentBuyOrder,
            "detailsBuyOrder" => $detailsBuyOrder,
        ]);
    }

    public function showChallengePopup(Request $request)
    {
        $challengeData = $request->session()->get('oneclick_standard_brand_challenge');

        if (!$challengeData) {
            abort(400, 'Desafío no disponible en sesión');
        }

        $challengeUrl = $challengeData['challenge_url'] ?? '';
        $redirectMethod = strtoupper($challengeData['redirect_method'] ?? 'POST');
        $browserChallengeToken = $challengeData['browser_challenge_token'] ?? '';

        if (!$this->isAllowedChallengeUrl($challengeUrl)) {
            abort(400, 'URL de desafío inválida');
        }

        if ($redirectMethod !== 'POST') {
            abort(400, 'Método de redirección inválido');
        }

        return view('oneclick/standard_brand/challenge_popup', [
            'challengeUrl' => $challengeUrl,
            'redirectMethod' => $redirectMethod,
            'browserChallengeToken' => $browserChallengeToken,
        ]);
    }

    public function deleteInscription(Request $request)
    {
        $req = $request->except('_token');
        $tbkUser = $req["tbk_user"];
        $userName = $req["user_name"];

        $resp = $this->standardBrandService->deleteInscription($tbkUser, $userName);
        return view('oneclick/standard_brand/mall_inscription_deleted', ["req" => $req, "resp" => $resp]);
    }

    public function transactionStatus(Request $request)
    {
        $req = $request->except('_token');
        $buyOrder = $req["buy_order"];

        $resp = $this->standardBrandService->status($buyOrder);

        return view('oneclick/standard_brand/mall_transaction_status', ["req" => $req, "resp" => $resp]);
    }

    public function pollTransactionStatus(Request $request)
    {
        $validated = $request->validate([
            'buy_order' => 'required|string|max:26',
        ]);
        $buyOrder = $validated['buy_order'];

        try {
            $resp = $this->standardBrandService->status($buyOrder);
        } catch (\Exception $e) {
            $statusCode = (int) $e->getCode();

            if ($statusCode >= 400 && $statusCode < 500) {
                return response()->json(['error' => 'Unable to retrieve transaction status'], 400);
            }

            if ($statusCode === 0 || $statusCode >= 500) {
                return response()->json(['error' => 'Transaction status service unavailable'], 503);
            }

            return response()->json(['error' => 'Unable to retrieve transaction status'], 500);
        }

        $status = $this->getStatusFromResponse($resp);

        if ($status === null) {
            return response()->json(['error' => 'Invalid response format'], 500);
        }

        return response()->json([
            'is_initialized' => $status === 'INITIALIZED',
        ]);
    }

    private function getStatusFromResponse(array $resp): ?string
    {
        if (!isset($resp['details']) || !is_array($resp['details'])) {
            return null;
        }

        if (empty($resp['details']) || !is_array($resp['details'][0])) {
            return null;
        }

        if (!isset($resp['details'][0]['status']) || !is_string($resp['details'][0]['status'])) {
            return null;
        }

        return $resp['details'][0]['status'];
    }

    public function refund(Request $request)
    {
        $req = $request->except('_token');
        $buyOrder = $req["parent_buy_order"];
        $childCommerceCode = $req["commerce_code"];
        $childBuyOrder = $req["child_buy_order"];
        $amount = $req["amount"];

        $resp = $this->standardBrandService->refund($buyOrder, $childCommerceCode, $childBuyOrder, $amount);

        return view('oneclick/standard_brand/mall_refund_transaction', ["req" => $req, "resp" => $resp]);
    }

    public function authorizeMall(AuthorizeRequest $request)
    {
        $validated = $request->validated();

        $validatedDetails = $validated['details'][0];

        $details = [
            'amount' => $validatedDetails['amount'],
            'buy_order' => $validatedDetails['buy_order'],
            'commerce_code' => $validatedDetails['commerce_code'],
            'pmnt_ind' => $validatedDetails['pmnt_ind'],
            'recur_pmnt' => $validatedDetails['recur_pmnt'],
            'tid' => $validatedDetails['tid'] ?? '',
            'browserUserAgent' => $validatedDetails['browserUserAgent'],
            'browserAcceptHeader' => $validatedDetails['browserAcceptHeader'],
            'browserIP' => $validatedDetails['browserIP'],
            'browserJavaEnabled' => $validatedDetails['browserJavaEnabled'],
            'browserScreenHeight' => $validatedDetails['browserScreenHeight'],
            'browserScreenWidth' => $validatedDetails['browserScreenWidth'],
            'browserTZ' => $validatedDetails['browserTZ'],
            'browserJavascriptEnabled' => $validatedDetails['browserJavascriptEnabled'],
            'installments_number' => $validatedDetails['installments_number'],
        ];

        try {
            $response = $this->standardBrandService->authorize($validated["username"], $validated["tbk_user"], $validated["buy_order"], $validated['pos_entry_mode'], $validated['request_3ds_authentication'], $details);
            $challenge = false;
            if ($response instanceof \App\Dto\OneclickStandardBrand\ChallengeResponseDTO) {
                $challenge = true;
                $request->session()->put('oneclick_standard_brand_challenge', [
                    'challenge_url' => $response->getChallengeData()->getBaseUrl(),
                    'redirect_method' => strtoupper($response->getChallengeData()->getRedirectMethod()),
                    'browser_challenge_token' => $response->getChallengeData()->getParameters()->getBrowserChallengeToken(),
                ]);
            } else {
                $request->session()->forget('oneclick_standard_brand_challenge');
            }
            return view('oneclick/standard_brand/authorized_mall', ["req" => $validated, "resp" => $response, "challenge" => $challenge, "buyOrder" => $validated["buy_order"]]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function isAllowedChallengeUrl(string $challengeUrl): bool
    {
        if ($challengeUrl === '') {
            return false;
        }

        $parsedUrl = parse_url($challengeUrl);
        if ($parsedUrl === false) {
            return false;
        }

        $allowedHosts = config('services.transbank.oneclick_mall_standard_brand_challenge_allowed_hosts', []);
        $normalizedAllowedHosts = array_map('strtolower', $allowedHosts);
        $host = strtolower($parsedUrl['host'] ?? '');
        $scheme = strtolower($parsedUrl['scheme'] ?? '');
        $port = $parsedUrl['port'] ?? null;

        if ($scheme !== 'https') {
            return false;
        }

        if (!in_array($host, $normalizedAllowedHosts, true)) {
            return false;
        }

        return $port === null || (int)$port === 443;
    }

}
