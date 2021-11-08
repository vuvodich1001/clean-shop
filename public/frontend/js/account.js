// let accountItems = document.querySelectorAll('.account-item');
// function removeAllAccountActive() {
//     if (accountItems) {
//         accountItems.forEach(accountItem => {
//             accountItem.classList.remove('account-item--active');
//         })
//     }
// }

// function changeActiveAccount() {
//     if (accountItems) {
//         accountItems.forEach(accountItem => {
//             accountItem.onlick = function () {
//                 removeAllAccountActive();
//                 console.log('test');
//                 this.classList.add('account-item--active');
//             }
//         })
//     }
// }

// function start() {
//     changeActiveAccount();
// }

// start();

let btnDeleteAddresses = document.querySelectorAll('.btn-delete-address');
function deleteAddress() {
    if (btnDeleteAddresses) {
        btnDeleteAddresses.forEach(btnDeleteAddress => {
            btnDeleteAddress.addEventListener('click', (e) => {
                let id = btnDeleteAddress.getAttribute('address-id');
                let check = confirm('Bạn có muốn xóa địa chỉ này');
                if (check) {
                    btnDeleteAddress.parentElement.remove();
                    fetch(`index.php?controller=account&action=deleteAddress&id=${id}`);
                }
            });
        });
    }
}

function cancelOrder() {
    let btnCancelOrder = document.querySelector('.btn-cancel-order');
    let detailStatus = document.querySelector('.detail-status');
    if (btnCancelOrder) {
        btnCancelOrder.addEventListener('click', (e) => {
            let orderId = btnCancelOrder.getAttribute('order-id');
            let check = confirm('Bạn có muốn hủy đơn đặt hàng này?');
            if (check) {
                fetch(`index.php?controller=account&action=cancelOrder&id=${orderId}`);
                detailStatus.textContent = 'Đã hủy';
                btnCancelOrder.textContent = 'Đã hủy';
                btnCancelOrder.disabled = true;
            }
        });
    }
}
function start() {
    deleteAddress();
    cancelOrder();
}

start();