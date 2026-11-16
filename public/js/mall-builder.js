/*
 * Formulario mall (resources/views/webpayplus/partials/mall_create.blade.php).
 * Calcula el total en vivo y, si los comercios hijos son seleccionables, atenúa los desmarcados
 * y exige al menos uno marcado. Sin dependencias.
 */
(function () {
    'use strict';

    function init(form) {
        var children = form.querySelectorAll('[data-mall-child]');
        var totalView = form.querySelector('[data-mall-total]');
        var countView = form.querySelector('[data-mall-count]');
        var errorView = form.querySelector('[data-mall-error]');
        var money = new Intl.NumberFormat('es-CL', { style: 'currency', currency: 'CLP', maximumFractionDigits: 0 });

        function refresh() {
            var total = 0;
            var active = 0;
            Array.prototype.forEach.call(children, function (child) {
                var toggle = child.querySelector('[data-mall-child-active]');
                var isActive = toggle ? toggle.checked : true;
                child.classList.toggle('is-inactive', !isActive);
                if (toggle) {
                    // Un comercio desmarcado no se envía, así que no debe bloquear el formulario con sus campos.
                    Array.prototype.forEach.call(child.querySelectorAll('input:not([type=checkbox])'), function (input) {
                        input.required = isActive;
                    });
                }
                if (isActive) {
                    active++;
                    total += parseInt(child.querySelector('[data-mall-child-amount]').value, 10) || 0;
                }
            });
            if (totalView) totalView.textContent = money.format(total);
            if (countView) countView.textContent = active === 1 ? '1 comercio' : active + ' comercios';
            if (errorView && active > 0) errorView.hidden = true;
            return active;
        }

        form.addEventListener('input', refresh);
        form.addEventListener('change', refresh);
        form.addEventListener('submit', function (event) {
            if (refresh() === 0) {
                event.preventDefault();
                if (errorView) errorView.hidden = false;
            }
        });

        refresh();
    }

    function boot() {
        Array.prototype.forEach.call(document.querySelectorAll('[data-mall-builder]'), init);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', boot);
    } else {
        boot();
    }
})();
