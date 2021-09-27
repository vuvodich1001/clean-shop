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
            return val ? undefined : "Vui lòng điền thông tin";
        },
    };
};

let isEmail = function (selector) {
    return {
        selector: selector,
        test: function (val) {
            let regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            return regex.test(val) ? undefined : "Email không hợp lệ";
        },
    };
};

let isPassword = function (selector, number) {
    return {
        selector: selector,
        test: function (val) {
            return val.trim().length >= number ? undefined : `Mật khẩu phải có ít nhất ${number} kí tự`;
        }
    }
}

let isConfirmed = function (selector, confirm) {
    return {
        selector: selector,
        test: function (val) {
            return val === confirm() ? undefined : "Nhập lại mật khẩu không chính xác!";
        }
    }
}

let minLength = function (selector, number) {
    return {
        selector: selector,
        test: function (val) {
            return val.trim().length >= number ? undefined : `Nội dung phải có ít nhất ${number} kí tự`;
        }
    }
}