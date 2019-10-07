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

Route::get('/transaccion_completa/mall_create', function () {
    return view('transaccion_completa/mall_create');
});


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
