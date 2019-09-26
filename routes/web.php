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


Route::get('/patpass_comercio/inscription_start', 'PatpassComercio@Create');
Route::get('/patpass_comercio/inscription_status', 'PatpassComercio@Status');
