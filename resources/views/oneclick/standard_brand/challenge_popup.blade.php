@extends('layout')
@section('content')
    <h1>Desafío 3DS</h1>

    <p>Presiona el botón para abrir el desafío en esta ventana.</p>

    <form method="{{ $redirectMethod }}" action="{{ $challengeUrl }}">
        <input
            id="browserChallengeToken"
            type="text"
            name="browserChallengeToken"
            value="{{ $browserChallengeToken }}"
        >

        <button type="submit">Continuar al challenge</button>
    </form>

@endsection
