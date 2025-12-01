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
}
