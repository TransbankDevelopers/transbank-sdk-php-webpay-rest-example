/*
 * Formulario de tarjeta interactivo (resources/views/partials/card_form.blade.php).
 * Sin dependencias: formatea los campos y refleja lo escrito en la vista previa de la tarjeta.
 */
(function () {
    'use strict';

    var MASTERCARD_MARK =
        '<svg class="tbk-card__mark-mc" viewBox="0 0 50 31" focusable="false">' +
        '<circle cx="15.5" cy="15.5" r="15.5" fill="#eb001b"/>' +
        '<circle cx="34.5" cy="15.5" r="15.5" fill="#f79e1b"/>' +
        '<path d="M25 3.2a15.5 15.5 0 0 1 0 24.6 15.5 15.5 0 0 1 0-24.6z" fill="#ff5f00"/>' +
        '</svg>';

    var BRANDS = [
        { id: 'amex', label: 'American Express', mark: '<span class="tbk-card__mark tbk-card__mark--amex">AMEX</span>', re: /^3[47]/, groups: [4, 6, 5], max: 15, cvv: 4 },
        { id: 'diners', label: 'Diners Club', mark: '<span class="tbk-card__mark tbk-card__mark--diners">Diners Club</span>', re: /^3(0[0-5]|[689])/, groups: [4, 6, 4], max: 14, cvv: 3 },
        { id: 'jcb', label: 'JCB', mark: '<span class="tbk-card__mark tbk-card__mark--jcb">JCB</span>', re: /^35/, groups: [4, 4, 4, 4, 3], max: 19, cvv: 3 },
        { id: 'visa', label: 'Visa', mark: '<span class="tbk-card__mark tbk-card__mark--visa">VISA</span>', re: /^4/, groups: [4, 4, 4, 4, 3], max: 19, cvv: 3 },
        { id: 'mastercard', label: 'Mastercard', mark: MASTERCARD_MARK, re: /^(5[1-5]|2(2[2-9]|[3-6]|7[01]|720))/, groups: [4, 4, 4, 4], max: 16, cvv: 3 }
    ];
    var UNKNOWN = { id: '', label: '', mark: '', groups: [4, 4, 4, 4, 3], max: 19, cvv: 4 };

    function digitsOf(value) {
        return String(value || '').replace(/\D/g, '');
    }

    function detectBrand(digits) {
        for (var i = 0; i < BRANDS.length; i++) {
            if (BRANDS[i].re.test(digits)) return BRANDS[i];
        }
        return UNKNOWN;
    }

    function group(digits, groups) {
        var parts = [];
        var pos = 0;
        for (var i = 0; i < groups.length && pos < digits.length; i++) {
            parts.push(digits.slice(pos, pos + groups[i]));
            pos += groups[i];
        }
        return parts.join(' ');
    }

    // Largo que se dibuja en la tarjeta: 16 por defecto, el largo exacto para Amex/Diners, o lo escrito si es más.
    function displayLength(brand, digits) {
        var base = brand.max < 16 ? brand.max : 16;
        return Math.max(base, digits.length);
    }

    function init(root) {
        if (root.getAttribute('data-card-ready')) return;
        root.setAttribute('data-card-ready', '1');

        var format = root.getAttribute('data-exp-format') === 'YY/MM' ? 'YY/MM' : 'MM/YY';
        var numberInput = root.querySelector('[data-card-input="number"]');
        var hiddenNumber = root.querySelector('[data-card-hidden-number]');
        var expInput = root.querySelector('[data-card-input="exp"]');
        var cvvInput = root.querySelector('[data-card-input="cvv"]');
        var numberView = root.querySelector('[data-card-number]');
        var expView = root.querySelector('[data-card-exp]');
        var cvvView = root.querySelector('[data-card-cvv]');
        var cvvFrontView = root.querySelector('[data-card-cvv-front]');
        var brandView = root.querySelector('[data-card-brand]');
        var announce = root.querySelector('[data-card-announce]');
        var brand = UNKNOWN;

        function setBrand(next) {
            if (next.id === brand.id) return;
            brand = next;
            root.setAttribute('data-brand', brand.id);
            brandView.innerHTML = brand.mark;
            if (announce) announce.textContent = brand.label ? 'Marca detectada: ' + brand.label : '';
            if (cvvInput) {
                cvvInput.maxLength = brand.cvv;
                if (cvvInput.value.length > brand.cvv) {
                    cvvInput.value = cvvInput.value.slice(0, brand.cvv);
                    renderCvv();
                }
            }
        }

        function renderNumber() {
            var raw = digitsOf(numberInput.value);
            setBrand(detectBrand(raw));
            var digits = raw.slice(0, brand.max);

            // Mantiene el cursor después del mismo dígito tras reformatear.
            var caret = numberInput.selectionStart;
            var digitsBeforeCaret = caret == null ? digits.length : digitsOf(numberInput.value.slice(0, caret)).length;
            var formatted = group(digits, brand.groups);
            if (numberInput.value !== formatted) {
                numberInput.value = formatted;
                if (document.activeElement === numberInput) {
                    var pos = 0;
                    var seen = 0;
                    while (pos < formatted.length && seen < digitsBeforeCaret) {
                        if (/\d/.test(formatted.charAt(pos))) seen++;
                        pos++;
                    }
                    numberInput.setSelectionRange(pos, pos);
                }
            }
            hiddenNumber.value = digits;

            var padded = digits;
            var total = displayLength(brand, digits);
            while (padded.length < total) padded += '•';
            numberView.textContent = group(padded, brand.groups);
            root.classList.toggle('has-number', digits.length > 0);
        }

        function renderExp() {
            var digits = digitsOf(expInput.value).slice(0, 4);
            expInput.value = digits.length > 2 ? digits.slice(0, 2) + '/' + digits.slice(2) : digits;

            var first = digits.slice(0, 2);
            var second = digits.slice(2, 4);
            var month = format === 'YY/MM' ? second : first;
            var year = format === 'YY/MM' ? first : second;
            expView.textContent = (month + 'MM'.slice(month.length)) + '/' + (year + 'AA'.slice(year.length));
        }

        function renderCvv() {
            if (!cvvInput) return;
            var digits = digitsOf(cvvInput.value).slice(0, brand.cvv);
            if (cvvInput.value !== digits) cvvInput.value = digits;
            var placeholder = brand.cvv === 4 ? '••••' : '•••';
            var shown = digits + placeholder.slice(digits.length);
            if (cvvView) cvvView.textContent = shown;
            if (cvvFrontView) cvvFrontView.textContent = shown;
        }

        function focusOn(slot) {
            return function () {
                root.setAttribute('data-focus', slot);
                // Amex lleva el código impreso en el frente, así que no se voltea.
                root.classList.toggle('is-flipped', slot === 'cvv' && brand.id !== 'amex');
            };
        }

        function blur() {
            root.removeAttribute('data-focus');
            root.classList.remove('is-flipped');
        }

        numberInput.addEventListener('input', renderNumber);
        numberInput.addEventListener('focus', focusOn('number'));
        numberInput.addEventListener('blur', blur);

        expInput.addEventListener('input', renderExp);
        expInput.addEventListener('focus', focusOn('exp'));
        expInput.addEventListener('blur', blur);

        if (cvvInput) {
            cvvInput.addEventListener('input', renderCvv);
            cvvInput.addEventListener('focus', focusOn('cvv'));
            cvvInput.addEventListener('blur', blur);
        }

        renderNumber();
        renderExp();
        renderCvv();
    }

    function boot() {
        var roots = document.querySelectorAll('[data-card-form]');
        for (var i = 0; i < roots.length; i++) init(roots[i]);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', boot);
    } else {
        boot();
    }
})();
