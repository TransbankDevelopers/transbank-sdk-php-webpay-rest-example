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
    <h1>Se requiere completar desafío de autenticación</h1>

    <p>La autorización requiere un desafío 3DS.</p>
    <p>Presiona el botón para abrir la ventana del desafío y esta página hará seguimiento de su cierre.</p>
    <p>Puedes editar el buy order antes de que se consulte automáticamente el status.</p>
    <p id="challengeStatusMessage">Aún no se ha abierto la ventana del desafío.</p>

    <form
        id="challengeStatusCheckForm"
        method="post"
        action="/oneclick/standard_brand/mall/transactionStatus"
        class="mt-4"
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

    <button type="button" id="openChallengeButton">
        Abrir desafío
    </button>

    <script>
        let challengeWindow = null;
        let challengeMonitorIntervalId = null;
        let challengeStatusPollInProgress = false;
        let statusRequestSubmitted = false;

        function submitStatusForm(message) {
            const statusMessage = document.getElementById('challengeStatusMessage');
            const statusCheckForm = document.getElementById('challengeStatusCheckForm');

            statusMessage.textContent = message;

            if (challengeMonitorIntervalId) {
                clearInterval(challengeMonitorIntervalId);
                challengeMonitorIntervalId = null;
            }

            if (!statusRequestSubmitted) {
                statusRequestSubmitted = true;
                statusCheckForm.submit();
            }
        }

        async function pollChallengeStatus() {
            if (challengeStatusPollInProgress || statusRequestSubmitted) {
                return;
            }

            challengeStatusPollInProgress = true;

            const statusMessage = document.getElementById('challengeStatusMessage');
            const buyOrder = document.getElementById('challengeStatusBuyOrder').value;
            const pollUrl = `/oneclick/standard_brand/mall/transactionStatus/poll?buy_order=${encodeURIComponent(buyOrder)}`;

            try {
                const response = await fetch(pollUrl, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    statusMessage.textContent = 'No fue posible consultar el status. Se reintentará en unos segundos.';
                    return;
                }

                const data = await response.json();

                if (!data.is_initialized) {
                    if (challengeWindow && !challengeWindow.closed) {
                        challengeWindow.close();
                    }

                    submitStatusForm('Autorización actualizada. Consultando status de la autorización...');
                    return;
                }

                statusMessage.textContent = 'La ventana del desafío sigue abierta. Status actual: INITIALIZED.';
            } catch (error) {
                statusMessage.textContent = 'No fue posible consultar el status. Se reintentará en unos segundos.';
            } finally {
                challengeStatusPollInProgress = false;
            }
        }

        function updateChallengeWindowState() {
            const statusMessage = document.getElementById('challengeStatusMessage');

            if (!challengeWindow) {
                statusMessage.textContent = 'Aún no se ha abierto la ventana del desafío.';
                return;
            }

            if (challengeWindow.closed) {
                submitStatusForm('Desafío terminado. Consultando status de la autorización...');
                return;
            }

            pollChallengeStatus();
        }

        function openChallengeFlow() {
            challengeWindow = window.open('', 'challengeWindow', 'width=520,height=720,resizable=yes,scrollbars=yes');

            document.getElementById('challengePopupForm').submit();

            updateChallengeWindowState();

            if (!challengeMonitorIntervalId) {
                challengeMonitorIntervalId = window.setInterval(updateChallengeWindowState,3000);
            }
        }

        document.getElementById('openChallengeButton').addEventListener('click', openChallengeFlow);
    </script>

@endif
@endsection
