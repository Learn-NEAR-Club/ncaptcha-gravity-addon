const nCaptchaProcessor = (submit) => {
    submit.disabled = true;
    submit.value = window?.userAccount
        ? 'Submit'
        : 'Validate with nCaptcha before Submit';
};

function checkForChanges(callback, interval = 600) {
    let previousValue = null;

    setInterval(() => {
        const currentValue = window?.nCaptchaWallet?.nCaptcha?.isValid;
        if (currentValue !== previousValue) {
            previousValue = currentValue;
            callback(currentValue);
        }
    }, interval);
}

document.addEventListener('DOMContentLoaded', function (event) {
    const nCaptcha = document.getElementById('nCaptcha-verification');
    const nCaptchaFieldInput = document.querySelector('.nCaptcha-transaction-field');

    if (nCaptchaFieldInput) {
        const submit = nCaptchaFieldInput.closest('form').querySelector('input[type="submit"]');
        nCaptchaProcessor(submit);
    }
    if (nCaptcha) {
        window.initNCaptcha();
        const submit = nCaptcha.closest('form').querySelector('input[type="submit"]');
        const transactionField = nCaptcha?.closest('form')?.querySelector('.nCaptcha-transaction-field');
        const checkNcaptchaAvailability = setInterval(() => {
            if (window.nCaptchaWallet && window.nCaptchaWallet.nCaptcha) {
                clearInterval(checkNcaptchaAvailability);
                checkForChanges((newValue) => {
                    if (newValue === true) {
                        submit.value = 'Submit';
                        submit.disabled = '';
                        if (transactionField) {
                            transactionField.value = window?.nCaptchaWallet?.nCaptcha?.transaction;
                        }
                    }
                });
            }
        }, 100);
    }
});
