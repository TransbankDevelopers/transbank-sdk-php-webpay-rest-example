<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OneClickStandardBrandService;

class OneclickStandardBrandController extends Controller
{
    private OneClickStandardBrandService $standardBrandService;

    public function __construct(){
        if (app()->environment('production')) {
            $this->standardBrandService = new OneClickStandardBrandService(
                config('services.transbank.oneclick_mall_standard_brand_cc'),
                config('services.transbank.oneclick_mall_standard_brand_api_key')
            );

        } else {
            // TODO: Add testing configuration here
            $this->standardBrandService = new OneClickStandardBrandService(
                config('services.transbank.oneclick_mall_standard_brand_cc'),
                config('services.transbank.oneclick_mall_standard_brand_api_key')
            );
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
        return view('oneclick/standard_brand/inscription_finished', ["resp" => $resp, "req" => $req, "username" => $userName, "metaData" => $metaData]);
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
            'recur_pmnt' => $req['details'][0]['recur_pmnt'],
            'tid' => $req['details'][0]['tid'],
            'device_type' => $req['details'][0]['device_type'],
            'browserAcceptHeader' => $req['details'][0]['browserAcceptHeader'],
            'browserIP' => $req['details'][0]['browserIP'],
            'browserJavaEnabled' => $req['details'][0]['browserJavaEnabled'],
            'browserLanguage' => $req['details'][0]['browserLanguage'],
            'browserScreenHeight' => $req['details'][0]['browserScreenHeight'],
            'browserScreenWidth' => $req['details'][0]['browserScreenWidth'],
            'browserTZ' => $req['details'][0]['browserTZ'],
            'browserUserAgent' => $req['details'][0]['browserUserAgent'],
            'browserJavascriptEnabled' => $req['details'][0]['browserJavascriptEnabled'],
            'installments_number' => $req['details'][0]['installments_number'],
        ];

        try {
            $response = $this->standardBrandService->authorize($req["username"], $req["tbk_user"], $req["buy_order"], $req['pos_entry_mode'], $req['request_3ds_authentication'], $details);
            $challenge = false;
            if($response instanceof \App\Dto\ChallengeResponseDTO){
                $challenge = true;
            }
            return view('oneclick/standard_brand/authorized_mall', ["req" => $req, "resp" => $response, "challenge" => $challenge]);
        }

        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function challengeStart(Request $request)
    {
        $token = $request->query('token');
        $url   = $request->query('url');

        return view('oneclick.standard_brand.challenge_start', [
            'browserChallengeToken' => $token,
            'baseUrl' => $url
        ]);
    }
}
