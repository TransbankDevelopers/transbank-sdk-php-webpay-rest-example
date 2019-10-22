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

Route::post('/webpayplus/diferido/status', 'Webpay@statusDiferido');

# Webpay Plus Mall

Route::get('/webpayplus/createMall', 'Webpay@createMall');
Route::post('/webpayplus/createMall', 'Webpay@createdMallTransaction');

Route::post('/webpayplus/mallReturnUrl', 'Webpay@commitMallTransaction');

Route::get('/webpayplus/mallRefund', 'Webpay@showMallRefund');
Route::post('/webpayplus/mallRefund', 'Webpay@refundMallTransaction');
Route::post('/webpayplus/mallTransactionStatus', 'Webpay@getMallTransactionStatus');


# Transaccion Completa
Route::get('/transaccion_completa/create', function () {
    return view('transaccion_completa/create');
});

Route::post('/transaccion_completa/create', 'TransaccionCompleta@createTransaction');

Route::post('/transaccion_completa/installments', 'TransaccionCompleta@installments');

Route::get('/transaccion_completa/transaction_commit', function () {
    return view('transaccion_completa/transaction_commit');
});

Route::post('/transaccion_completa/transaction_commit', 'TransaccionCompleta@commit');

Route::get('/transaccion_completa/transaction_status', function () {
    return view('transaccion_completa/transaction_status');
});

Route::post('/transaccion_completa/transaction_status', 'TransaccionCompleta@status');

Route::post('/transaccion_completa/refund', 'TransaccionCompleta@refund');

# transaccion completa mall

Route::get('/transaccion_completa/mall_create', 'TransaccionCompletaMall@showMallCreate');


Route::post('/transaccion_completa/mall_create', 'TransaccionCompletaMall@mallCreate');

Route::post('/transaccion_completa/mall_installments', 'TransaccionCompletaMall@mallInstallments');

Route::get('/transaccion_completa/mall_commit', function () {
    return view('transaccion_completa/mall_commit');
});

Route::post('/transaccion_completa/mall_commit', 'TransaccionCompletaMall@mallCommit');

Route::get('/transaccion_completa/mall_status', function () {
    return view('transaccion_completa/mall_status');
});

Route::post('/transaccion_completa/mall_status', 'TransaccionCompletaMall@mallStatus');

Route::post('/transaccion_completa/mall_refund', 'TransaccionCompletaMall@mallRefund');

# Patpass comercio

Route::get('/patpass_comercio/create-form', function () {

    return view('patpass_comercio/create_form');
});
Route::post('/patpass_comercio/create-form/', 'PatpassComercio@startTransaction');
Route::post('/patpass_comercio/returnUrl', 'PatpassComercio@finishStartTransaction');
Route::post('/patpass_comercio/status', 'PatpassComercio@status');
Route::post('/patpass_comercio/voucherUrl', 'PatpassComercio@displayVoucher');


# Webpay Plus Mall diferido
Route::get('/webpayplus/mall/diferido/create', function () {
    return view('webpayplus/mall/diferido/create');
});
Route::post('/webpayplus/mall/diferido/create', 'Webpay@createMallDiferido');

Route::post('/webpayplus/mall/diferido/returnUrl', 'Webpay@commitMallDiferido');

Route::get('/webpayplus/mall/diferido/capture', function () {
    return view('webpayplus/mall/diferido/capture');
});
Route::post('/webpayplus/mall/diferido/capture', 'Webpay@captureMallDiferido');


Route::get('/webpayplus/mall/diferido/refund', function () {
    return view('webpayplus/mall/diferido/refund');
});
Route::post('/webpayplus/mall/diferido/refund', 'Webpay@refundMallDiferido');

Route::post('/webpayplus/mall/diferido/transactionStatus', 'Webpay@statusMallDiferido');






# Oneclick Mall

Route::get('/oneclick/startInscription', function() {
    return view('oneclick/start_inscription');
});
Route::post('/oneclick/startInscription', 'Oneclick@startInscription');

Route::delete('/oneclick/inscription', 'Oneclick@deleteInscription');
Route::get('/oneclick/inscription', 'Oneclick@deleteInscription');

Route::post('/oneclick/responseUrl', 'Oneclick@finishInscription');

Route::get('/oneclick/mall/authorizeTransaction', function () {

    return view('/oneclick/authorize_mall');

});
Route::post('/oneclick/mall/authorizeTransaction', 'Oneclick@authorizeMall');

Route::post('/oneclick/mall/transactionStatus', 'Oneclick@transactionStatus');

Route::post('/oneclick/mall/refund', 'Oneclick@refund');

