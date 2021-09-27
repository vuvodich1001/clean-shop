function authentication() {
    let btnLogin = document.querySelector('.btn-login');
    let btnRegister = document.querySelector('.btn-register');
    let modal = document.querySelector('.modal');
    let btnClose = document.querySelectorAll('.btn-close-form');
    if (btnLogin) {
        btnLogin.addEventListener('click', e => {
            modal.classList.add('modal-active');
            let formLogin = document.querySelector('#form-login');
            formLogin.style.display = 'block';
            btnClose[0].addEventListener('click', e => {
                modal.classList.remove('modal-active');
                formLogin.style.display = 'none';
            });
        });

        btnRegister.addEventListener('click', e => {
            modal.classList.add('modal-active');
            let formRegister = document.querySelector('#form-register');
            formRegister.style.display = 'block';
            btnClose[1].addEventListener('click', e => {
                modal.classList.remove('modal-active');
                formRegister.style.display = 'none';
            });
        });
    }
}

function start() {
    authentication();
}

start();