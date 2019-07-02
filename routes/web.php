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

Route::get('/webpayplus/createMall', 'webpayplus/createMall');
Route::post('/webpayplus/createMall', 'webpayplus/createdMall');

Route::post('/webpayplus/returnUrl', 'Webpay@commitMallTransaction');

Route::get('/webpayplus/refund', 'Webpay@showMallRefund');
Route::post('/webpayplus/refund', 'Webpay@refundMallTransaction');
