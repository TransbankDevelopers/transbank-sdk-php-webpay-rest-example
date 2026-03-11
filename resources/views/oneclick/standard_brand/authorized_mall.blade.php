@extends('layout')
@section('content')

@if(!$challenge)

    <h1>Request</h1>
    <pre>{{ print_r($req, true) }}</pre>

    <h1>Response</h1>
    <pre>{{ print_r($resp, true) }}</pre>

    <h2>Estado de la transacción</h2>
    <form method="post" action="/oneclick/standard_brand/mall/transactionStatus">
        @csrf
        <label>Buy order:</label>
        <input type="text" name="buy_order" value="{{ $resp->getBuyOrder() }}">

        <button type="submit">Enviar datos</button>
    </form>

    <h2>Reembolso de la transacción</h2>
    <form method="post" action="/oneclick/standard_brand/mall/refund">
        @csrf
        <label>Buy order padre</label>
        <input name="parent_buy_order" value="{{ $resp->getBuyOrder() }}">

        <label>Commerce code hijo</label>
        <input name="commerce_code" value="{{ $resp->getDetails()->getCommerceCode() }}">

        <label>Buy order hijo</label>
        <input name="child_buy_order" value="{{ $resp->getDetails()->getBuyOrder() }}">

        <label>Monto</label>
        <input name="amount" value="{{ $resp->getDetails()->getAmount() }}"/>

        <button type="submit">Enviar</button>
    </form>

@else
    <h1>Challenge requerido</h1>

    <p>La autorización requiere un challenge 3DS.</p>
    <p>Presiona el botón para abrir la ventana del challenge y esta página hará seguimiento de su cierre.</p>
    <p>Puedes editar el buy order antes de que se consulte automáticamente el status.</p>
    <p id="challengeStatusMessage">Aún no se ha abierto la ventana del challenge.</p>

    <form
        id="challengeStatusCheckForm"
        method="post"
        action="/oneclick/standard_brand/mall/transactionStatus"
        style="margin-top: 16px;"
    >
        @csrf
        <label for="challengeStatusBuyOrder">Buy order:</label>
        <input type="text" id="challengeStatusBuyOrder" name="buy_order" value="{{ $buyOrder }}">
    </form>

    <form
        id="challengePopupForm"
        method="post"
        action="/oneclick/standard_brand/mall/challenge-popup"
        target="challengeWindow"
    >
        @csrf
    </form>

    <button type="button" onclick="openChallengeFlow()">
        Abrir challenge
    </button>

    <script>
        let challengeWindow = null;
        let challengeMonitorIntervalId = null;
        let statusRequestSubmitted = false;

        function updateChallengeWindowState() {
            const statusMessage = document.getElementById('challengeStatusMessage');
            const statusCheckForm = document.getElementById('challengeStatusCheckForm');

            if (!challengeWindow) {
                statusMessage.textContent = 'Aún no se ha abierto la ventana del challenge.';
                return;
            }

            if (challengeWindow.closed) {
                statusMessage.textContent = 'Challenge terminado. Consultando status de la autorización...';

                if (challengeMonitorIntervalId) {
                    clearInterval(challengeMonitorIntervalId);
                    challengeMonitorIntervalId = null;
                }

                if (!statusRequestSubmitted) {
                    statusRequestSubmitted = true;
                    statusCheckForm.submit();
                }

                return;
            }

            statusMessage.textContent = 'La ventana del challenge sigue abierta.';
        }

        function openChallengeFlow() {
            challengeWindow = window.open('', 'challengeWindow', 'width=520,height=720,resizable=yes,scrollbars=yes');

            document.getElementById('challengePopupForm').submit();

            updateChallengeWindowState();

            if (!challengeMonitorIntervalId) {
                challengeMonitorIntervalId = window.setInterval(updateChallengeWindowState, 3000);
            }
        }
    </script>

@endif
@endsection
