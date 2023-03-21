@extends('layout')
@section('content')
    <h1>El pago fue anulado por tiempo de espera</h1>

    <div>


        <span class="text-red-700 text-xl my-2 inline-block font-bold">Time out en transacción</span>

        <div class="response">
            <pre>{{  print_r($resp, true) }}</pre>
        </div>

        <hr class="my-5">


    </div>
@endsection
