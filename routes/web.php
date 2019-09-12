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
