<!DOCTYPE html>
<html>
<head>
    <title>Iniciando Challenge 3DS...</title>
</head>
<body onload="document.getElementById('challengeForm').submit();">

    <p>Redirigiendo al desafío de autenticación…</p>

    <form id="challengeForm" method="POST" action="{{ $baseUrl }}">
        <input type="hidden" name="browserChallengeToken" value="{{ $browserChallengeToken }}">
    </form>

</body>
</html>
