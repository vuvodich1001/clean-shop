const addressForm = document.querySelector('#address-form');

function borderWhenChecked(selector) {
    //Address group
    let addressButton = document.querySelector('.address-button');
    let inputRadios = document.querySelectorAll(`${selector} input[type="radio"]`);
    let selectorGroups = document.querySelectorAll(`${selector}`);
    if (inputRadios) {
        inputRadios.forEach(inputRadio => {
            inputRadio.addEventListener('change', e => {
                selectorGroups.forEach(selectorGroup => {
                    selectorGroup.style.border = 'none';
                })
                let selectorGroup = inputRadio.parentElement;
                selectorGroup.style.border = '2px solid var(--main-color)';
                if (inputRadio.classList.contains('new-address')) {
                    addressButton.classList.add('address-active');
                    addressForm.classList.add('address-active');
                }
                else {
                    addressButton.classList.remove('address-active');
                    addressForm.classList.remove('address-active');
                }
            })
        })
    }
}

function findActiveRadio() {
    let inputRadios = document.querySelectorAll(`.address-group input[type="radio"]`);
    inputRadios.forEach(inputRadio => {
        if (inputRadio.checked) {
            return inputRadio.id;
        }
    })
    return 0;
}

function checkout() {
    let btnCheckout = document.querySelector('.btn-checkout');
    if (btnCheckout) {
        btnCheckout.addEventListener('click', (e) => {
            e.preventDefault();
            let addressId = findActiveRadio();
            if (addressId != 0) {
                fetch(`index.php?controller=order&action=createOrder&addressId=${addressId}`)
                    .then(response => response.json())
                    .then(customer => {

                    })
            }
            else {
                Validator({
                    form: '#address-form',
                    rules: [
                        isRequired('#firstname'),
                        isRequired('#lastname'),
                        isRequired('#address'),
                        isRequired('#ward'),
                        isRequired('#district'),
                        isRequired('#city'),
                        isRequired('#phone'),
                        isRequired('#zipcode'),
                    ],
                    onSubmit(formData) {
                        fetch('index.php?controller=order&action=createOrderWithNewAddress', {
                            method: 'POST',
                            body: formData
                        })
                            .then(response => response.json())
                            .then(error => {
                                if (error == 1) alert('Địa chỉ giao hàng đã tồn tại!!!');
                            })
                    }
                })
                document.querySelector('.address-form-button').click();
            }
        });
    }
}

function start() {
    borderWhenChecked('.address-group');
    borderWhenChecked('.payment-group');
    checkout();
}

start();