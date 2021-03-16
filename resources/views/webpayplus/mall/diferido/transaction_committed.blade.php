@extends('layout')
@section('content')
        <h1>Webpay plus mall diferido transaccion confirmada</h1>

    <div>

        <div>
            <h2>Parametros</h2>
            <pre> {{  print_r($req, true) }} </pre>
            @if ($resp->isApproved())
                <span class="text-green-700 text-xl my-2 inline-block font-bold">Transacción aprobada</span>
            @else
                <span class="text-red-700 text-xl my-2 inline-block font-bold">Transacción rechazada</span>
            @endif
            <h2>Respuesta</h2>
            <pre> {{  print_r($resp, true) }} </pre>
        </div>

        <h2 class="text-lg mt-2 font-bold">Obtener status de la transacción</h2>

        <form method="post" action="/webpayplus/mall/diferido/transactionStatus">
            @csrf
            <input type="text"
                   value="{{ $req["token_ws"] }}"
                   name="token">
            <div> Token: {{ $req["token_ws"] }}</div>
            <button type="submit">Obtener status</button>
        </form>



        <h2 class="text-lg mt-2 font-bold">Capturar monto</h2>
        @foreach($resp->getDetails() as $key => $detail)
            <h3 class="text-lg mt-1">Transacción #{{ $key + 1 }}</h3>
            <form method="post" action="/webpayplus/mall/diferido/capture" style="display: flex; flex-direction: column; width: 20%;">
                @csrf

                <label>Token</label>
                <input value="{{ $req["token_ws"] }}" name="token">

                <label for="child_commerce_code_1">Commerce Code hijo</label>
                <input id="child_commerce_code_1" name="commerce_code" value="{{ $detail->getCommerceCode()  }}" >

                <label for="buy_order_1">Buy Order</label>
                <input id="buy_order_1" name="buy_order" value="{{ $detail->getBuyOrder()  }}" >

                <label for="authorization_code_1">Authorization code</label>
                <input id="authorization_code_1" name="authorization_code" value="{{ $detail->getAuthorizationCode()  }}" >

                <label for="child_amount_1">Monto 1</label>
                <input id="child_amount_1" name="capture_amount" value="{{ $detail->getAmount()  }}" >

                <button type="submit">Capturar transacción #{{ $key + 1 }}</button>
            </form>
        @endforeach


        <h2>Reembolsar la transacción</h2>
        @foreach($resp->getDetails() as $key => $detail)
            <h3 class="text-lg mt-1">Transacción #{{ $key + 1 }}</h3>
            <form method="post" action="/webpayplus/mallRefund" style="display: flex; flex-direction: column; width: 20%;">
                @csrf
                <input type="text" name="token" value="{{ $req["token_ws"] }}">

                <label for="buy_order_1">Buy Order</label>
                <input id="buy_order_1" name="buy_order" value="{{ $detail->getBuyOrder()  }}" >

                <label for="child_commerce_code_1">Commerce Code hijo</label>
                <input id="child_commerce_code_1" name="commerce_code" value="{{ $detail->getCommerceCode()  }}" >

                <label for="child_amount_1">Monto 1</label>
                <input id="child_amount_1" name="amount" value="{{ $detail->getAmount()  }}" >

                <button type="submit">Enviar</button>
            </form>
        @endforeach

    </div>
@endsection
