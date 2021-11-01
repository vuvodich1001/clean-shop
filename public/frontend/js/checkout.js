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
                if (selector == '.address-group') {
                    if (inputRadio.classList.contains('new-address')) {
                        addressButton.classList.add('address-active');
                        addressForm.classList.add('address-active');
                    }
                    else {
                        addressButton.classList.remove('address-active');
                        addressForm.classList.remove('address-active');
                    }
                }
            })
        })
    }
}

function findActiveRadio(selector) {
    let inputRadio = document.querySelector(`${selector} input[type="radio"]:checked`);
    return inputRadio ? inputRadio.id : 0;
}

function checkout() {
    let btnCheckout = document.querySelector('.btn-checkout');
    if (btnCheckout) {
        btnCheckout.addEventListener('click', (e) => {
            e.preventDefault();
            let addressId = Number(findActiveRadio('.address-group'));
            let paymentMethod = findActiveRadio('.payment-group');
            if (!addressId) {
                alert('Chưa chọn địa chỉ giao hàng');
                return;
            }

            if (!paymentMethod) {
                alert('Chưa chọn phương thức thanh toán');
                return;
            }

            if (Number.isInteger(addressId)) {
                fetch(`index.php?controller=order&action=createOrder&addressId=${addressId}&payment=cod`)
                    .then(response => response.json())
                    .then(info => {
                        console.log(info);
                        alert('Bạn đã đặt hàng thành công!');
                        location.href = btnCheckout.href;
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
                        fetch('index.php?controller=order&action=createOrder&payment=cod', {
                            method: 'POST',
                            body: formData
                        })
                            .then(response => response.json())
                            .then(error => {
                                if (error == 1) alert('Địa chỉ giao hàng đã tồn tại!!!');
                                else {
                                    alert('Bạn đã đặt hàng thành công!');
                                    location.href = btnCheckout.href;
                                }
                            })
                    }
                })
                document.querySelector('.address-form-button').click();
            }
        });
    }
}

// function removeVoucher() {
//     let btnCartBack = document.querySelector('.cart-back');
//     if (btnCartBack) {
//         btnCartBack.addEventListener('click', (e) => {
//             fetch('index.php?controller=discount&action=removeVoucher');
//         });
//     }
// }
function start() {
    borderWhenChecked('.address-group');
    borderWhenChecked('.payment-group');
    checkout();
}

start();