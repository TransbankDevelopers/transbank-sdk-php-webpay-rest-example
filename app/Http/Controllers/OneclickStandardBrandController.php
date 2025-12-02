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
    public function authorizeBrandStandard(Request $request)
    {
        //TODO: Get these values from the request
        $details = [
            'amount' => 50,
            'buy_order' => 'order12345',
            'commerce_code' => config('services.oneclick_mall_standard_brand_child_cc') ?? "",
            'pmnt_ind' => 'C',
            'recur_pmnt' => 'V',
            'tid' => '',
            'device_type' => '',
            'browserAcceptHeader' => '',
            'browserIP' => '',
            'browserJavaEnabled' => '',
            'browserLanguage' => '',
            'browserScreenHeight' => '',
            'browserScreenWidth' => '',
            'browserTZ' => '',
            'browserUserAgent' => '',
            'browserJavascriptEnabled' => true,
            'installments_number' => 0,
        ];

        try {
            //TODO: Get these values from the request
            $response = $this->standardBrandService->authorize('user-name', 'tbk_user_123', 'order12345', 1, 'NO', $details);
            if($response instanceof \App\Dto\ChallengeResponseDTO){
                //TODO: Handle brand challenge response

            }
            else if($response instanceof \App\Dto\AuthorizeResponseDTO){
                //TODO: Handle no challenge response

            }
            return response()->json($response);
        }

        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }
}
