<?php

/**
 * Class Patpass Comercio
 *
 * @category
 * @package App\Http\Controllers
 *
 */


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Patpass\Options;
use Transbank\Patpass\PatpassComercio;


class PatpassComercio extends Controller
{
  public function Create(Request $request) {
    PatpassComercio::configureForTesting();
    $req = $request->all();
    $res = Inscription::start(
      $req['url'],
      $req['nombre'],
      $req['pApellido'],
      $req['sApellido'],
      $req['rut'],
      $req['serviceId'] ,
      $req['finalUrl'],
      $req['commerceCode'],
      $req['montoMaximo'],
      $req['telefonoFijo'],
      $req['telefonoCelular'],
      $req['nombrePatPass'],
      $req['correoPersona'],
      $req['correoComercio'],
      $req['direccion'],
      $req['ciudad']
    );
    return view('patpass_comercio/incription_start', [
        "req" => $req,
        "res" => $res,
    ]);
}
public function Status(Request $request)
{
    PatpassComercio::configureForTesting();
    $req = $request->all();
    $res = Inscription::getStatus(
        $req["token_ws"],
    );
    return view('patpass_comercio/inscription_status', [
        "req" => $req,
        "res" => $res,
    ]);
}
}
