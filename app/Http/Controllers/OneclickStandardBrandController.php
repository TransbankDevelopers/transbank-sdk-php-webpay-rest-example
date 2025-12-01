<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OneclickStandardBrandController extends Controller
{
    public function __construct(){
        if (app()->environment('production')) {
            // TODO: Add production configuration here
        } else {
            // TODO: Add testing configuration here
        }
    }

    public function startInscription(Request $request)
    {

        session_start();

        $req = $request->except('_token');
        $userName = $req["user_name"];
        $email = $req["email"];
        $responseUrl = $req["response_url"];


        $resp = [
            "url_webpay" => url('oneclick/standard_brand/responseUrl'),
            "token" => "fake-token-1234567890"
        ];

        $_SESSION["user_name"] = $userName;
        $_SESSION["email"] = $email;
        return view('oneclick/standard_brand/inscription_successful', ['resp' => $resp, 'req' => $req]);
    }


    public function finishInscription(Request $request)
    {
        session_start();
        $req = $request->except('_token');
        $token = $req["TBK_TOKEN"];

        $resp = [
            "response_code" => 0,
            "tbk_user" => "fake-tbk-user-123456",
            "card_number" => "1234",
            "card_type" => "VISA",
            "authorization_code" => "123456"

        ];

        $userName = array_key_exists("user_name", $_SESSION) ? $_SESSION["user_name"] : '';
        return view('oneclick/standard_brand/inscription_finished', ["resp" => $resp, "req" => $req, "username" => $userName]);
    }

    public function deleteInscription(Request $request)
    {
        $req = $request->except('_token');
        $tbkUser = $req["tbk_user"];
        $userName = $req["user_name"];

        $resp = [
            "success" => true,
            "code" => 204
        ];
        return view('oneclick/standard_brand/mall_inscription_deleted', ["req" => $req, "resp" => $resp]);
    }
}
