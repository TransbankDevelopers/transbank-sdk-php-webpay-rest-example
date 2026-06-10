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
        let challengeMonitorTimeoutId = null;
        let challengeStatusPollPromise = null;
        let statusRequestSubmitted = false;
        let challengePollingStopped = false;
        let challengeStartedAt = null;
        let consecutivePollErrors = 0;
        const challengePollBaseDelayMs = 3000;
        const challengePollMaxBackoffMs = 30000;
        const challengePollMaxDurationMs = 10 * 60 * 1000;
        const challengePollMaxConsecutiveErrors = 10;

        function clearChallengeMonitor() {
            if (challengeMonitorTimeoutId) {
                clearTimeout(challengeMonitorTimeoutId);
                challengeMonitorTimeoutId = null;
            }
        }

        function submitStatusForm(message) {
            if (statusRequestSubmitted) {
                return;
            }

            statusRequestSubmitted = true;

            const statusMessage = document.getElementById('challengeStatusMessage');
            const statusCheckForm = document.getElementById('challengeStatusCheckForm');

            statusMessage.textContent = message;

            clearChallengeMonitor();
            statusCheckForm.submit();
        }

        function getNextPollDelay() {
            if (consecutivePollErrors === 0) {
                return challengePollBaseDelayMs;
            }

            return Math.min(
                challengePollBaseDelayMs * Math.pow(2, consecutivePollErrors - 1),
                challengePollMaxBackoffMs
            );
        }

        function hasExceededMaxPollingDuration() {
            return challengeStartedAt && Date.now() - challengeStartedAt >= challengePollMaxDurationMs;
        }

        function stopChallengePolling(message) {
            const statusMessage = document.getElementById('challengeStatusMessage');

            challengePollingStopped = true;
            clearChallengeMonitor();
            statusMessage.textContent = message;
        }

        function handleChallengePollingTimeout() {
            if (challengeWindow && !challengeWindow.closed) {
                challengeWindow.close();
            }

            clearChallengeMonitor();
            submitStatusForm('Tiempo máximo de espera alcanzado. Consultando status de la autorización...');
        }

        function scheduleChallengeMonitor() {
            if (challengePollingStopped || statusRequestSubmitted || !challengeWindow || challengeWindow.closed) {
                return;
            }

            if (hasExceededMaxPollingDuration()) {
                handleChallengePollingTimeout();
                return;
            }

            const remainingDurationMs = challengePollMaxDurationMs - (Date.now() - challengeStartedAt);
            const delayMs = Math.min(getNextPollDelay(), remainingDurationMs);

            clearChallengeMonitor();
            challengeMonitorTimeoutId = window.setTimeout(() => {
                challengeMonitorTimeoutId = null;
                updateChallengeWindowState();
            }, delayMs);
        }

        function registerPollFailure(message) {
            consecutivePollErrors++;

            if (consecutivePollErrors >= challengePollMaxConsecutiveErrors) {
                if (challengeWindow && !challengeWindow.closed) {
                    challengeWindow.close();
                }

                submitStatusForm('Consultando status de la autorización...');
                return;
            }

            const nextRetrySeconds = Math.ceil(getNextPollDelay() / 1000);
            document.getElementById('challengeStatusMessage').textContent = `${message} Se reintentará en ${nextRetrySeconds} segundos.`;
        }

        async function pollChallengeStatus() {
            if (challengeStatusPollPromise || statusRequestSubmitted || challengePollingStopped) {
                return;
            }

            const statusMessage = document.getElementById('challengeStatusMessage');
            const buyOrder = document.getElementById('challengeStatusBuyOrder').value;
            const csrfToken = document.querySelector('#challengeStatusCheckForm input[name="_token"]').value;
            const pollUrl = '/oneclick/standard_brand/mall/transactionStatus/poll';

            try {
                challengeStatusPollPromise = fetch(pollUrl, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        buy_order: buyOrder
                    })
                });

                const response = await challengeStatusPollPromise;

                if (!response.ok) {
                    registerPollFailure('No fue posible consultar el status.');
                    return;
                }

                const data = await response.json();

                if (!data || typeof data.is_initialized !== 'boolean') {
                    registerPollFailure('Respuesta inválida del servidor.');
                    return;
                }

                consecutivePollErrors = 0;

                if (!data.is_initialized) {
                    if (challengeWindow && !challengeWindow.closed) {
                        challengeWindow.close();
                    }

                    submitStatusForm('Autorización actualizada. Consultando status de la autorización...');
                    return;
                }

                statusMessage.textContent = 'La ventana del desafío sigue abierta. Status actual: INITIALIZED.';
            } catch (error) {
                registerPollFailure('No fue posible consultar el status.');
            } finally {
                challengeStatusPollPromise = null;
                scheduleChallengeMonitor();
            }
        }

        function updateChallengeWindowState() {
            const statusMessage = document.getElementById('challengeStatusMessage');

            if (!challengeWindow) {
                statusMessage.textContent = 'Aún no se ha abierto la ventana del desafío.';
                return;
            }

            if (hasExceededMaxPollingDuration()) {
                handleChallengePollingTimeout();
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

            if (!challengeWindow || challengeWindow.closed) {
                document.getElementById('challengeStatusMessage').textContent = 'No fue posible abrir la ventana del desafío. Habilita los popups e intenta nuevamente.';
                return;
            }

            challengePollingStopped = false;
            challengeStartedAt = Date.now();
            consecutivePollErrors = 0;

            document.getElementById('challengePopupForm').submit();

            updateChallengeWindowState();
        }

        document.getElementById('openChallengeButton').addEventListener('click', openChallengeFlow);
    </script>

@endif
@endsection
