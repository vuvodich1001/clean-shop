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
            setTimeout(() => {
                cartSuccess.classList.toggle('cart-active');
            }, 4000);
            let id = this.getAttribute('book-id');
            let url = `index.php?controller=cart&action=addToCart&id=${id}`;
            fetch(url);
        }
    }
}

function changeImageProduct() {
    let imageItems = document.querySelectorAll('.book-detail-img-item img');
    let bookImage = document.querySelector('.book-detail-img img');
    if (imageItems) {
        imageItems.forEach(imageItem => {
            imageItem.addEventListener('click', (e) => {
                bookImage.src = imageItem.src;
                imageItems.forEach(imageItem => {
                    imageItem.style.border = 'none';
                    imageItem.style.opacity = 0.6;
                });
                imageItem.style.border = '1px solid var(--main-color)';
                imageItem.style.opacity = 1;
            });
        });
    }

    if (imageItems[0]) imageItems[0].click();
}

function start() {
    addToCart();
    changeImageProduct();
}

start();