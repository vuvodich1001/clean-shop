function authentication() {
    let btnLogins = document.querySelectorAll('.btn-login');
    let btnRegisters = document.querySelectorAll('.btn-register');
    let loginFail = document.querySelector('.login-fail');
    let modal = document.querySelector('.modal-auth');
    let btnClose = document.querySelectorAll('.btn-close-form');
    let authContent = document.querySelector('.auth-content');
    const formLogin = document.querySelector('#form-login');
    const formRegister = document.querySelector('#form-register');

    if (btnLogins) {
        btnLogins.forEach(btnLogin => {
            btnLogin.addEventListener('click', e => {
                modal.classList.add('modal-active');
                formLogin.style.display = 'block';
                btnClose[0].addEventListener('click', e => {
                    modal.classList.remove('modal-active');
                    formLogin.style.display = 'none';
                    if (loginFail) loginFail.style.display = 'none';
                    formLogin.reset();
                    let invalidInputs = formLogin.querySelectorAll('.form-group');
                    invalidInputs.forEach(invalidInput => {
                        if (invalidInput.classList.contains('invalid')) {
                            let errorMessage = invalidInput.querySelector('.form-message');
                            errorMessage.remove();
                            invalidInput.classList.remove('invalid');
                        }
                    })
                });
            });
        })
    }

    if (btnRegisters) {
        btnRegisters.forEach(btnRegister => {
            btnRegister.addEventListener('click', e => {
                modal.classList.add('modal-active');
                formRegister.style.display = 'block';
                btnClose[1].addEventListener('click', e => {
                    modal.classList.remove('modal-active');
                    formRegister.style.display = 'none';
                    formRegister.reset();
                    let invalidInputs = formRegister.querySelectorAll('.form-group');
                    invalidInputs.forEach(invalidInput => {
                        if (invalidInput.classList.contains('invalid')) {
                            let errorMessage = invalidInput.querySelector('.form-message');
                            errorMessage.remove();
                            invalidInput.classList.remove('invalid');
                        }
                    })
                });
            });
        });
    }

    modal.addEventListener('click', () => {
        if (formRegister.style.display == 'block') {
            btnClose[1].click();
        }

        if (formLogin.style.display == 'block') {
            btnClose[0].click();
        }
    })

    authContent.addEventListener('click', e => {
        e.stopPropagation();
    })
}
function start() {
    authentication();
}

start();