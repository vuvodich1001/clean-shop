const checkoutTemp = document.querySelector('.checkout-temp');
const checkoutTotal = document.querySelector('.checkout-total');
const checkoutCoupon = document.querySelector('.checkout-coupon');
function removeCartItem() {
    let cartItems = document.querySelectorAll('.shopping-cart .btn-delete');
    let btnDeteleAllCartItem = document.querySelector('.btn-delete-all');
    if (cartItems) {
        cartItems.forEach(cartItem => {
            cartItem.onclick = function (e) {
                let bookId = e.target.parentElement.parentElement.parentElement.querySelector('.cart-item-id');
                e.target.parentElement.parentElement.parentElement.remove();
                fetch('index.php?controller=cart&action=deleteCartItem&id=' + bookId.getAttribute('book-id'))
                    .then(response => response.json())
                    .then(total => {
                        let billTotal = total.toString().replace(
                            /(\d)(?=(\d{3})+(?!\d))/g,
                            "$1.");
                        checkoutTemp.textContent = `${billTotal}đ`;
                        checkoutTotal.textContent = `${billTotal}đ`;
                        checkoutTotal.setAttribute('value', total);
                        checkoutCoupon.textContent = '0đ';
                    })
            }
        })
    }

    if (btnDeteleAllCartItem) {
        btnDeteleAllCartItem.onclick = function (e) {
            cartItems.forEach(cartItem => {
                cartItem.parentElement.parentElement.remove();
            })
            fetch('index.php?controller=cart&action=removeCart');
        }
    }
}

function add() {
    let btnAdds = document.querySelectorAll('.shopping-cart .btn-add');
    if (btnAdds) {
        btnAdds.forEach(btnAdd => {
            btnAdd.onclick = function (e) {
                let id = e.target.parentElement.parentElement.parentElement.querySelector('.cart-item-id');
                let quantity = e.target.parentElement.parentElement.querySelector('.cart-quantity');
                quantity.textContent = Number(quantity.textContent) + 1;
                fetch('index.php?controller=cart&action=increaseQuantity&id=' + id.getAttribute('book-id'))
                    .then(response => response.json())
                    .then(total => {
                        let billTotal = total.toString().replace(
                            /(\d)(?=(\d{3})+(?!\d))/g,
                            "$1.");
                        checkoutTemp.textContent = `${billTotal}đ`;
                        checkoutTotal.textContent = `${billTotal}đ`;
                        checkoutTotal.setAttribute('value', total);
                        checkoutCoupon.textContent = '0đ';
                    })
            }
        })
    }
}

function minus() {
    let btnMinuss = document.querySelectorAll('.shopping-cart .btn-minus');
    if (btnMinuss) {
        btnMinuss.forEach(btnMinus => {
            btnMinus.onclick = function (e) {
                let id = e.target.parentElement.parentElement.parentElement.querySelector('.cart-item-id');
                let quantity = e.target.parentElement.parentElement.querySelector('.cart-quantity');
                if (quantity.textContent > 1) {
                    quantity.textContent = Number(quantity.textContent) - 1;
                    fetch('index.php?controller=cart&action=decreaseQuantity&id=' + id.getAttribute('book-id'))
                        .then(response => response.json())
                        .then(total => {
                            let billTotal = total.toString().replace(
                                /(\d)(?=(\d{3})+(?!\d))/g,
                                "$1.");
                            checkoutTemp.textContent = `${billTotal}đ`;
                            checkoutTotal.textContent = `${billTotal}đ`;
                            checkoutTotal.setAttribute('value', total);
                            checkoutCoupon.textContent = '0đ';
                        })
                }
            }
        })
    }
}

function addVoucher() {
    let btnCoupon = document.querySelector('.btn-coupon');
    let couponCode = document.querySelector('#coupon-code');
    if (btnCoupon) {
        btnCoupon.addEventListener('click', (e) => {
            if (couponCode.value != '') {
                let formData = new FormData();
                let total = checkoutTotal.getAttribute('value');
                formData.append('code', couponCode.value);
                formData.append('total', total);
                for (let [key, value] of formData) {
                    console.log(`${key} => ${value}`);
                }
                fetch('index.php?controller=discount&action=addVoucher', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(result => {
                        if (result == 0) {
                            alert('Bạn không đủ điều kiện để giảm giá sản phẩm!')
                        }
                        else {
                            let discount = result.toString().replace(
                                /(\d)(?=(\d{3})+(?!\d))/g,
                                "$1.");
                            let newTotal = Number(total) - result;
                            newTotal = newTotal.toString().replace(
                                /(\d)(?=(\d{3})+(?!\d))/g,
                                "$1.");
                            checkoutTotal.textContent = `${newTotal}đ`;
                            checkoutCoupon.textContent = `${discount}đ`;
                            console.log(discount, newTotal);
                        }
                    })
            }
            else {
                alert('Chưa có mã giảm giá nào được áp dụng!!!');
            }
        })
    }
}

function resetVoucher() {
    let shoppingCart = document.querySelector('.shopping-cart');
    if (shoppingCart)
        fetch('index.php?controller=discount&action=removeVoucher');
}

function start() {
    resetVoucher();
    removeCartItem();
    add();
    minus();
    addVoucher();
}

start();