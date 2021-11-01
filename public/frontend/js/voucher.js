function clickToCopy() {
    let copies = document.querySelectorAll('.voucher-item__button');
    if (copies) {
        copies.forEach(copy => {
            copy.addEventListener('click', (e) => {
                copies.forEach(copy => copy.textContent = 'Copy');
                let voucherCode = copy.parentElement.querySelector('.voucher-item__code');
                navigator.clipboard.writeText(voucherCode.innerText);
                copy.textContent = 'Copied!';
            })
        })
    }
}

function start() {
    clickToCopy();
}

start();