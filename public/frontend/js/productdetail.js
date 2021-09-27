function addToCart() {
    let btnAddToCart = document.querySelector('.btn-addtocart');
    let cartSuccess = document.querySelector('.nav-cart-success');

    cartSuccess.onclick = function (e) {
        if (e.target.closest('.cart-close')) {
            cartSuccess.classList.toggle('cart-active');
        }
    }
    if (btnAddToCart) {
        btnAddToCart.onclick = function (e) {
            cartSuccess.classList.toggle('cart-active');
            let id = this.getAttribute('book-id');
            let url = `index.php?controller=cart&action=addToCart&id=${id}`;
            fetch(url);
        }
    }
}

function start() {
    addToCart();
}

start();