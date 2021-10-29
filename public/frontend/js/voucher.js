function clickToCopy() {
    let copies = document.querySelectorAll('.voucher-item__button');
    if (copies) {
        copies.forEach(copy => {
            copy.addEventListener('click', (e) => {
                let voucherCode = copy.parentElement.querySelector('.voucher-item__code');
                navigator.clipboard.writeText(voucherCode.innerText);
                alert('copied!');
            })
        })
    }
}

function start() {
    clickToCopy();
}

start();