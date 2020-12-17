@extends('layout')
@section('content')
        <h1>Oneclick inscripción</h1>

        <form method="post" action="startInscription"  style="display: flex; flex-direction:column; width:50%;font-size: 20px;">
            @csrf
            <label for="userName">Nombre de usuario</label>
            <input id="userName" name="user_name" value="nombre_de_usuario">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="example@example.com">

            <label for="responseUrl">URL de Respuesta</label>
            <input id="responseUrl" name="response_url" value="{{ url('/') }}/oneclick/responseUrl">


            <button type="submit">Enviar datos</button>
        </form>
@endsection
