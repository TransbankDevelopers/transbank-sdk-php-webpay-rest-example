<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\Oneclick as Oclick;

class Oneclick extends Controller
{

    public function startInscription(Request $request)
    {

        $req = $request->all();
        $userName = $req["user_name"];
        $email = $req["email"];
        $responseUrl = $req["response_url"];

        $resp = \Transbank\Webpay\Oneclick\MallInscription::start($userName, $email, $responseUrl);

        dd($resp);


    }


}
