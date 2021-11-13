let btnDetailOrders = document.querySelectorAll('.btn-detail-order');
let btnSuccesses = document.querySelectorAll('.btn-success-status');
let btnShippings = document.querySelectorAll('.btn-shipping-status');
function openOrderDetail() {
    if (btnDetailOrders) {
        btnDetailOrders.forEach(btnDetailOrder => {
            btnDetailOrder.addEventListener('click', e => {
                e.preventDefault();
                modal.classList.add('modal-active');
                let orderId = btnDetailOrder.getAttribute('order-id');
                fetch(`index.php?controller=order&action=orderDetail&id=${orderId}`)
                    .then(response => response.json())
                    .then(results => {
                        let detail = document.querySelector('.detail-body');
                        let orderDetails = results.map(result => {
                            return `
                                <tr>
                                    <td>${result.title}</td>
                                    <td>${result.main_image}</td>
                                    <td>${result.quantity}</td>
                                    <td>${result.price}</td>
                                    <td>${result.subtotal}</td>
                              </tr>
                            `;
                        })
                        detail.innerHTML = orderDetails.join('');
                    })
            });
        });
        if (btnCancel) {
            btnCancel.addEventListener('click', (e) => {
                e.preventDefault();
                modal.classList.remove('modal-active');
            })
        }
    }
}

function changeStatus() {
    if (btnSuccesses) {
        btnSuccesses.forEach(btnSuccess => {
            btnSuccess.addEventListener('click', (e) => {
                e.preventDefault();
                let check = confirm('Bạn đã hoàn thành đơn hàng này rồi phải không!!!');
                let orderId = btnSuccess.getAttribute('order-id');
                let orderStatus = document.querySelector(`.order-status-${orderId}`);
                if (check) {
                    orderStatus.textContent = 'Giao hàng thành công';
                    btnSuccess.remove();
                    fetch(`index.php?controller=order&action=changeStatusSuccess&id=${orderId}`);

                }
            })
        })
    }

    if (btnShippings) {
        btnShippings.forEach(btnShipping => {
            btnShipping.addEventListener('click', (e) => {
                e.preventDefault();
                let check = confirm('Bạn đang giao đơn hàng này rồi phải không!!!');
                let orderId = btnShipping.getAttribute('order-id');
                let orderStatus = document.querySelector(`.order-status-${orderId}`);
                if (check) {
                    orderStatus.textContent = 'Đang giao hàng';
                    btnShipping.remove();
                    fetch(`index.php?controller=order&action=changeStatusShipping&id=${orderId}`);
                }
            })
        })
    }
}
function start() {
    openOrderDetail();
    changeStatus();
}

start();