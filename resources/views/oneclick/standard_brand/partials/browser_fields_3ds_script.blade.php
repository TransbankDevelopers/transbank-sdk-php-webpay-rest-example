<script>
    const browserFieldDefaultsForNo3ds = {
        browserAcceptHeader: '',
        browserUserAgent: '',
        browserIP: '',
        browserJavaEnabled: 'false',
        browserScreenHeight: '',
        browserScreenWidth: '',
        browserTZ: '',
        browserJavascriptEnabled: 'false'
    };

    const browserFieldIds = Object.keys(browserFieldDefaultsForNo3ds);
    const browserFieldValuesFor3ds = {};

    async function getTransactionDetails() {
        const details = {
            browserJavaEnabled: navigator.javaEnabled ? navigator.javaEnabled() : 'false',
            browserScreenHeight: window.screen.height.toString(),
            browserScreenWidth: window.screen.width.toString(),
            browserTZ: String(new Date().getTimezoneOffset()),
            browserJavascriptEnabled: true
        };

        return details;
    }

    function storeBrowserFieldValuesFor3ds() {
        browserFieldIds.forEach(function(fieldId) {
            const field = document.getElementById(fieldId);

            if (field && !field.readOnly) {
                browserFieldValuesFor3ds[fieldId] = field.value;
            }
        });
    }

    function applyBrowserFieldsMode() {
        const request3dsAuthentication = document.getElementById('request_3ds_authentication').value;
        const shouldRequest3ds = request3dsAuthentication === 'SI';

        if (!shouldRequest3ds) {
            storeBrowserFieldValuesFor3ds();
        }

        browserFieldIds.forEach(function(fieldId) {
            const field = document.getElementById(fieldId);

            if (!field) {
                return;
            }

            if (shouldRequest3ds) {
                field.readOnly = false;
                field.classList.remove('browser-field-readonly');
                field.value = browserFieldValuesFor3ds[fieldId] || '';
                return;
            }

            field.value = browserFieldDefaultsForNo3ds[fieldId];
            field.readOnly = true;
            field.classList.add('browser-field-readonly');
        });
    }

    document.addEventListener('DOMContentLoaded', async function() {
        const details = await getTransactionDetails();

        document.getElementById('browserJavaEnabled').value = details.browserJavaEnabled;
        document.getElementById('browserScreenHeight').value = details.browserScreenHeight;
        document.getElementById('browserScreenWidth').value = details.browserScreenWidth;
        document.getElementById('browserTZ').value = details.browserTZ;
        document.getElementById('browserJavascriptEnabled').value = details.browserJavascriptEnabled;

        storeBrowserFieldValuesFor3ds();
        applyBrowserFieldsMode();
        document.getElementById('request_3ds_authentication').addEventListener('change', applyBrowserFieldsMode);
    });
</script>
