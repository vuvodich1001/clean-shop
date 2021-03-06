function Validator(options) {
    let formElement = document.querySelector(options.form);
    let ruleSelectors = {};

    function validate(inputElement, value) {
        let mess = inputElement.parentElement.querySelector('.form-message');
        let messageElement = document.createElement('span');
        messageElement.classList.add('form-message');
        let check;
        for (let val of ruleSelectors[value.selector]) {
            if (val(inputElement.value)) {
                check = val(inputElement.value);
                break;
            }
        }
        if (check) {
            if (mess) {

            }
            else {
                inputElement.parentElement.classList.add('invalid');
                messageElement.textContent = check;
                inputElement.parentElement.append(messageElement);
            }

        } else {
            inputElement.parentElement.classList.remove('invalid')
            if (mess) {
                mess.remove();
            }
        }

        return check ? true : false;
    };


    if (formElement) {
        options.rules.forEach(function (value) {
            if (Array.isArray(ruleSelectors[value.selector])) {
                ruleSelectors[value.selector].push(value.test);
            }
            else {
                ruleSelectors[value.selector] = [value.test];
            }
            let inputElement = formElement.querySelector(value.selector);
            inputElement.onblur = function (e) {
                validate(inputElement, value);
            }

            inputElement.onfocus = function (e) {
                let messageElement = inputElement.parentElement.querySelector('.form-message');
                if (messageElement) {
                    inputElement.parentElement.classList.remove('invalid');
                    messageElement.remove();
                }
            }
        });
    }

    formElement.onsubmit = (e) => {
        e.preventDefault();
        let flag = true;
        options.rules.forEach((value) => {
            let inputElement = formElement.querySelector(value.selector);
            if (validate(inputElement, value)) {
                flag = false;
            }
        });

        if (flag) {
            if (typeof options.onSubmit === 'function') {
                let arrInputs = new FormData(formElement);
                options.onSubmit(arrInputs);
            }
            else {
                formElement.submit();
            }
        }
    }
}
let isRequired = function (selector) {
    return {
        selector: selector,
        test: function (val) {
            return val ? undefined : "Vui l??ng ??i???n th??ng tin";
        },
    };
};

let isEmail = function (selector) {
    return {
        selector: selector,
        test: function (val) {
            let regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            return regex.test(val) ? undefined : "Email kh??ng h???p l???";
        },
    };
};

let isPassword = function (selector, number) {
    return {
        selector: selector,
        test: function (val) {
            return val.trim().length >= number ? undefined : `M???t kh???u ph???i c?? ??t nh???t ${number} k?? t???`;
        }
    }
}

let isConfirmed = function (selector, confirm) {
    return {
        selector: selector,
        test: function (val) {
            return val === confirm() ? undefined : "Nh???p l???i m???t kh???u kh??ng ch??nh x??c!";
        }
    }
}

let minLength = function (selector, number) {
    return {
        selector: selector,
        test: function (val) {
            return val.trim().length >= number ? undefined : `N???i dung ph???i c?? ??t nh???t ${number} k?? t???`;
        }
    }
}