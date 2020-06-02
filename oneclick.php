<?php

require_once('vendor/autoload.php');

use Transbank\Webpay\Oneclick\MallInscription;
$username = "nombre_de_usuario";
$email = "nombre_de_usuario@gmail.com(opens in new tab)";
$resp_url = "https://callback/resultado/de/transaccion";
$resp = MallInscription::start($username, $email, $resp_url);
$url_webpay = $resp->getUrlWebpay();
$tbk_token = $resp->getToken();
