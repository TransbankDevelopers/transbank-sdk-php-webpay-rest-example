@extends('layout')
@section('content')
    <h1> Oneclick mall inscripción finalizada</h1>

<h2>Request</h2>
<pre> {{  print_r($req, true) }} </pre>

<h2>Respuesta</h2>
@if ($resp->isApproved())
    <span class="text-green-700 text-xl my-2 inline-block font-bold">Transacción aprobada</span>
@else
    <span class="text-red-700 text-xl my-2 inline-block font-bold">Transacción rechazada</span>
@endif
<pre> {{  print_r($resp, true) }} </pre>

@if ($resp->responseCode == 0)

    <h2>Autorizar transacción</h2>
    <div class="operations-home">
    <form class="operations-home__form" method="post" action="/oneclick/mall/authorizeTransaction">
        @csrf

        <label for="username">Nombre de usuario</label>
        <input id="username" name="username" value="{{ $username }}" required />

        <label for="tbk_user">Codigo de usuario</label>
        <input id="tbk_user" name="tbk_user" value="{{ $resp->getTbkUser() }}" required />

        <label for="parent_buy_order">Orden de compra padre</label>
        <input id="parent_buy_order" name="buy_order" value="{{ rand(100000000, 999999999) }}" maxlength="26" required />

        @include('oneclick.partials.commerce_details')

        <button class="operations-home__submit" type="submit">Autorizar transacción</button>
    </form>
    </div>

    <h2>Eliminar inscripcion</h2>
    <form method="delete" action="/oneclick/inscription" style="display: flex; flex-direction:column; width:50%;font-size: 20px;">

        <label>Nombre de usuario</label>
        <input name="user_name" value="{{ $username}}"/>

        <label>Id de usuario</label>
        <input name="tbk_user" value="{{ $resp->getTbkUser() }}"/>

        <button type="submit">Enviar</button>


    </form>
@endif
@endsection
