document.addEventListener('DOMContentLoaded', function () {
    var radioButtons = document.querySelectorAll('input[type="radio"]');
    
    radioButtons.forEach(function (radio) {
        var div = radio.closest('.input-option');

        radio.addEventListener('change', function () {
            updateStyles();
        });

        div.addEventListener('mouseenter', function () {
            if (!radio.checked) {
                div.classList.add('input-option-hover-style');
            }
        });

        div.addEventListener('mouseleave', function () {
            div.classList.remove('input-option-hover-style');
        });
    });

    function updateStyles() {
        radioButtons.forEach(function (radio) {
            var div = radio.closest('.input-option');
            var icon = div.querySelector('i');

            if (radio.checked) {
                div.classList.add('input-option-checked-style');
                icon.classList.add('input-option-checked-icon-style');
            } else {
                div.classList.remove('input-option-checked-style', 'input-option-hover-style');
                icon.classList.remove('input-option-checked-icon-style');
            }
        });
    }
});
