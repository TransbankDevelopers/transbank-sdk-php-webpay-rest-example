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


        $userName = array_key_exists("user_name", $_SESSION) ? $_SESSION["user_name"] : '';
        return view('oneclick/standard_brand/inscription_finished', ["resp" => $resp, "req" => $req, "username" => $userName]);
    }

    public function deleteInscription(Request $request)
    {
        $req = $request->except('_token');
        $tbkUser = $req["tbk_user"];
        $userName = $req["user_name"];

        $resp = $this->standardBrandService->deleteInscription($tbkUser, $userName);
        return view('oneclick/standard_brand/mall_inscription_deleted', ["req" => $req, "resp" => $resp]);
    }
}
