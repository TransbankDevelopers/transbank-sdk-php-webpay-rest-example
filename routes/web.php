<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use function foo\func;

Route::get('/', function () {
    return view('welcome');
});

# Webpay Plus
Route::get('/webpayplus/create', function () {

    return view('webpayplus/create');
});

Route::post('/webpayplus/create/', 'Webpay@createdTransaction');

Route::post('/webpayplus/returnUrl', 'Webpay@commitTransaction');

Route::get('/webpayplus/refund', 'Webpay@showRefund');
Route::post('/webpayplus/refund', 'Webpay@refundTransaction');

Route::get('/webpayplus/transactionStatus', 'Webpay@showGetStatus');
Route::post('/webpayplus/transactionStatus', 'Webpay@getTransactionStatus');

# Webpay Plus Diferido
Route::get('/webpayplus/diferido/create', function () {
    return view('webpayplus/diferido/create');
});
Route::post('/webpayplus/diferido/create', 'Webpay@createDiferido');

Route::post('/webpayplus/diferido/returnUrl', 'Webpay@commitDiferidoTransaction');

Route::get('/webpayplus/diferido/capture', function () {
    return view('webpayplus/diferido/diferido');
});
Route::post('/webpayplus/diferido/capture', 'Webpay@captureDiferido');


Route::get('/webpayplus/diferido/refund', function () {
    return view('webpayplus/diferido/refund');
});
Route::post('/webpayplus/diferido/refund', 'Webpay@refundDiferido');

Route::post('/webpayplus/diferido/transactionStatus', 'Webpay@statusDiferido');

# Webpay Plus Mall

Route::get('/webpayplus/createMall', 'Webpay@createMall');
Route::post('/webpayplus/createMall', 'Webpay@createdMallTransaction');

Route::post('/webpayplus/mallReturnUrl', 'Webpay@commitMallTransaction');

Route::get('/webpayplus/mallRefund', 'Webpay@showMallRefund');
Route::post('/webpayplus/mallRefund', 'Webpay@refundMallTransaction');
Route::post('/webpayplus/mallTransactionStatus', 'Webpay@getMallTransactionStatus');


# Webpay Plus Mall diferido

#...TODO need commerce code

# Oneclick

Route::get('/oneclick/startInscription', function() {
    return view('oneclick/start_inscription');
});
    Route::post('/oneclick/startInscription', 'Oneclick@startInscription');

