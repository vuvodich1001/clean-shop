function borderWhenChecked(selector) {
    //Address group
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
            })
        })
    }
}

function start() {
    borderWhenChecked('.address-group');
    borderWhenChecked('.payment-group');
}

start();