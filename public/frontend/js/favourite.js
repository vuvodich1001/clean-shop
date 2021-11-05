let btnDeleteFavourites = document.querySelectorAll('.favourite-item-delete');
function removeFavouriteBook() {
    if (btnDeleteFavourites) {
        btnDeleteFavourites.forEach(btnDeleteFavourite => {
            btnDeleteFavourite.addEventListener('click', (e) => {
                e.preventDefault();
                let bookId = btnDeleteFavourite.getAttribute('book-id');
                console.log(bookId);
                fetch(`index.php?controller=book&action=removeFavouriteBook&book-id=${bookId}`);
                btnDeleteFavourite.parentElement.remove();
            })
        });
    }
}

function start() {
    removeFavouriteBook();
}

start();