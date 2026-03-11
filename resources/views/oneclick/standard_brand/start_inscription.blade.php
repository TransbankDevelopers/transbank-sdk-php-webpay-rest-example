@extends('layout')
@section('content')
        <h1>Oneclick inscripción</h1>

    <form method="post" action="startInscription" class="flex flex-col w-4/5 text-xl">
            @csrf
            <label for="userName">Nombre de usuario</label>
            <input id="userName" name="user_name" value="nombre_de_usuario">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="example@example.com">

            <label for="responseUrl">URL de Respuesta</label>
            <input id="responseUrl" name="response_url" value="{{ url('/') }}/oneclick/standard_brand/responseUrl">


            <button type="submit">Enviar datos</button>
        </form>
    <hr class="m-2">
        <h1>Autorizar con cuenta existente</h1>
        <p class="w-4/5">Si ya tienes una cuenta de usuario previamente enrolada, puedes autorizar directamente.</p>
        <form method="get" action="/oneclick/standard_brand/mall/direct-authorize" class="flex flex-col w-4/5 text-xl">
            <button type="submit">Ir a autorizar</button>
        </form>
@endsection
