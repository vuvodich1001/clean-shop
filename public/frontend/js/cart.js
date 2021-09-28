function removeCartItem() {
    let cartItems = document.querySelectorAll('.shopping-cart .btn-delete');
    let btnDeteleAllCartItem = document.querySelector('.btn-delete-all');
    if (cartItems) {
        cartItems.forEach(cartItem => {
            cartItem.onclick = function (e) {
                let bookId = e.target.parentElement.parentElement.querySelector('.cart-item-id');
                e.target.parentElement.parentElement.remove();
                fetch('index.php?controller=cart&action=deleteCartItem&id=' + bookId.getAttribute('book-id'));
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
                let id = e.target.parentElement.parentElement.querySelector('.cart-item-id');
                let quantity = e.target.parentElement.parentElement.querySelector('.cart-quantity');
                quantity.textContent = Number(quantity.textContent) + 1
                fetch('index.php?controller=cart&action=increaseQuantity&id=' + id.innerText);
            }
        })
    }
}

function minus() {
    let btnMinuss = document.querySelectorAll('.shopping-cart .btn-minus');
    if (btnMinuss) {
        btnMinuss.forEach(btnMinus => {
            btnMinus.onclick = function (e) {
                let id = e.target.parentElement.parentElement.querySelector('.cart-item-id');
                let quantity = e.target.parentElement.parentElement.querySelector('.cart-quantity');
                if (quantity.textContent > 1) {
                    quantity.textContent = Number(quantity.textContent) - 1;
                    fetch('index.php?controller=cart&action=decreaseQuantity&id=' + id.innerText);
                }
            }
        })
    }
}
function start() {
    removeCartItem();
    add();
    minus();
}

start();