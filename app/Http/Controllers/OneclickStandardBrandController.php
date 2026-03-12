<?php

namespace App\Http\Controllers;

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

    //TODO: Confirm that this method is Ok
    public function transactionStatus(Request $request)
    {
        $req = $request->except('_token');
        $buyOrder = $req["buy_order"];

        $resp = $this->standardBrandService->status($buyOrder);

        return view('oneclick/standard_brand/mall_transaction_status', ["req" => $req, "resp" => $resp]);
    }

    //TODO: Confirm that this method is Ok
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

    //TODO: Confirm that this method is Ok
    public function authorizeMall(Request $request)
    {
        $req = $request->except('_token');
        $details = [
            'amount' => $req['details'][0]['amount'],
            'buy_order' => $req['details'][0]['buy_order'],
            'commerce_code' => $req['details'][0]['commerce_code'],
            'pmnt_ind' => $req['details'][0]['pmnt_ind'],
            'recur_pmnt' => $req['details'][0]['recur_pmnt'] ?? ' ',
            'tid' => $req['details'][0]['tid'] ?? '',
            'browserAcceptHeader' => $req['details'][0]['browserAcceptHeader'],
            'browserJavaEnabled' => filter_var($req['details'][0]['browserJavaEnabled'] ?? false, FILTER_VALIDATE_BOOLEAN),
            'browserScreenHeight' => $req['details'][0]['browserScreenHeight'],
            'browserScreenWidth' => $req['details'][0]['browserScreenWidth'],
            'browserTZ' => $req['details'][0]['browserTZ'],
            'browserJavascriptEnabled' => filter_var($req['details'][0]['browserJavascriptEnabled'] ?? false, FILTER_VALIDATE_BOOLEAN),
            'installments_number' => $req['details'][0]['installments_number'],
        ];

        try {
            $response = $this->standardBrandService->authorize($req["username"], $req["tbk_user"], $req["buy_order"], $req['pos_entry_mode'], $req['request_3ds_authentication'], $details);
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
            return view('oneclick/standard_brand/authorized_mall', ["req" => $req, "resp" => $response, "challenge" => $challenge, "buyOrder" => $req["buy_order"]]);
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
