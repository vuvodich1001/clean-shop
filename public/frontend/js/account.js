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

function start() {
    deleteAddress();
}

start();