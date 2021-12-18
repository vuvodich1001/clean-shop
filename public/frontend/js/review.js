let modal = document.querySelector('.modal-review');
let btnReviews = document.querySelectorAll('.btn-review');
let btnCloseReview = document.querySelector('.review-close');
let btnSendReview = document.querySelector('.btn-send-review');
let btnAddImage = document.querySelector('.btn-add-image');
const listImages = document.querySelector('#review-images');
function showReviewModal() {
    if (btnReviews) {
        btnReviews.forEach(btnReview => {
            btnReview.addEventListener('click', (e) => {
                e.preventDefault();
                modal.classList.add('modal-active');
                let bookId = btnReview.getAttribute('book-id');
                let reviewImg = document.querySelector('.review-img')
                let reviewTitle = document.querySelector('.review-title')
                let reviewAuthor = document.querySelector('.review-author')
                fetch(`index.php?controller=book&action=getById&book-id=${bookId}`)
                    .then(response => response.json())
                    .then(book => {
                        reviewImg.src = `./public/admin/uploads/${(book['main_image'].split(','))[0]}`;
                        reviewTitle.textContent = `Sách ${book['title']}`;
                        reviewAuthor.textContent = book['author'];
                        btnSendReview.setAttribute('book-id', book['book_id']);
                    })
            });
        })
    }

    if (btnCloseReview) {
        btnCloseReview.addEventListener('click', (e) => {
            modal.classList.remove('modal-active');
            let comment = document.querySelector('.review-comment textarea');
            let rating = document.querySelector('input[name="rate"]:checked');
            let photos = document.querySelector('#review-file');
            if (rating) {
                rating.checked = false;
            }
            photos.value = '';
            comment.value = '';
            listImages.innerHTML = '';
        })
    }
}

function review() {
    if (btnSendReview) {
        btnSendReview.addEventListener('click', (e) => {
            let rating = document.querySelector('input[name="rate"]:checked');
            let comment = document.querySelector('.review-comment textarea');
            let photos = document.querySelector('#review-file');
            let bookId = btnSendReview.getAttribute('book-id');
            let headLine = '';
            if (rating && comment) {

                switch (Number(rating.value)) {
                    case 1:
                        headLine = 'Rất không hài lòng';
                        break;
                    case 2:
                        headLine = 'Không hài lòng';
                        break;
                    case 3:
                        headLine = 'Bình thường';
                        break;
                    case 4:
                        headLine = 'Hài lòng';
                        break;
                    case 5:
                        headLine = 'Cực kì hài lòng';
                        break;
                }
                let formData = new FormData();
                formData.append('rating', rating.value);
                formData.append('comment', comment.value);
                formData.append('headLine', headLine);
                formData.append('bookId', bookId);
                for (let i = 0; i < photos.files.length; i++) {
                    formData.append('photos[]', photos.files[i]);
                }

                for (let [key, value] of formData) {
                    console.log(`${key} => ${value}`);
                }
                fetch('index.php?controller=review&action=createReview', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(result => {
                        if (result == 1) {
                            alert('Cảm ơn bạn đã đánh giá sản phẩm này <3');
                            btnCloseReview.click();
                        }
                    })
            }
            else {
                alert('Chưa đủ thông tin đánh giá! Mời bạn đánh giá lại')
            }
        });
    }
}

function displayImageAfterUploaded() {
    const reviewFile = document.querySelector('#review-file');
    if (reviewFile) {
        btnAddImage.addEventListener('click', (e) => {
            reviewFile.value = '';
            listImages.innerHTML = '';
        })
        reviewFile.addEventListener('change', (e) => {
            for (let i = 0; i < e.target.files.length; i++) {
                let image = document.createElement('img');
                image.src = URL.createObjectURL(e.target.files[i]);
                listImages.appendChild(image);
            }
        })
    }
}
function start() {
    showReviewModal();
    review();
    displayImageAfterUploaded();
}

start();