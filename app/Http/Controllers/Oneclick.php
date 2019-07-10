<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\Oneclick\MallInscription;

class Oneclick extends Controller
{

    public function startInscription(Request $request)
    {

        $req = $request->all();
        $userName = $req["user_name"];
        $email = $req["email"];
        $responseUrl = $req["response_url"];

        $resp = MallInscription::start($userName, $email, $responseUrl);

        return view('oneclick/inscription_successful', ['resp' => $resp, 'req' => $req]);
    }

    public function finishInscription(Request $request)
    {

        $req = $request->all();
        $token = $req["TBK_TOKEN"];

        $resp = MallInscription::finish($token);

        return view('oneclick/inscription_finished', ["resp" => $resp, "req" => $req]);

    }



}
