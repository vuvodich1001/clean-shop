const formBook = document.querySelector('#form-book');;
const btnCreateBook = document.querySelector('.btn-create-book');
const modalBody = document.querySelector('.modal-body');
let bookId;
function validateBook() {
    if (formBook) {
        Validator({
            form: '#form-book',
            rules: [
                isRequired('#title'),
                isRequired('#author'),
                isRequired('#price'),
                isRequired('#description'),
            ],
            onSubmit(data) {
                if (formBook.getAttribute('name') == 'create') {
                    fetchDataBook('post', {
                        method: 'post',
                        body: data
                    });
                }
                else {
                    fetchDataBook('put', {
                        method: 'post',
                        body: data
                    }, bookId)

                }
            }
        })
    }
}

function fetchDataBook(type, data = {}, id) {
    let url = '';
    switch (type) {
        case 'search':
            url = `index.php?controller=book&action=searchBook&name=${id}`;
            break;
        case 'put':
            url = `index.php?controller=book&action=updateBook&id=${id}`;
            break;
        case 'post':
            url = 'index.php?controller=book&action=createBook';
            break;
        case 'delete':
            url = `index.php?controller=book&action=deleteBook&id=${id}`;
            break;
    }
    fetch(url, data)
        .then(response => response.json())
        .then(posts => {
            // dataBooks = posts;
            const contentBody = document.querySelector('.content-body');
            const books = posts.map(book => {
                return `
                <tr>
                    <td>${book.book_id}</td>
                    <td>${book.title}</td>
                    <td>${book.author}</td>
                    <td>${book.price}</td>
                    <td><img src="public/admin/uploads/${book.main_image}" alt=""></td>
                    <td>
                        <p>${book.description}</p>
                    </td>
                    <td>${book.create_date}</td>
                    <td><a class="btn-delete-book" book-id="${book.book_id}" href=""><i class="fas fa-trash-alt"></i></a>
                        <a class="btn-update-book" book-id="${book.book_id}" href=""><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
                `;
            })
            contentBody.innerHTML = books.join('');
            modal.classList.remove('modal-active');
            formBook.reset();
            deleteBook();
            updateBook();
        })
}

function createBook() {
    if (formBook) {
        modalBody.style.top = '-50px';
        btnCreate.addEventListener('click', e => {
            modal.classList.add('modal-active');
            btnCreateBook.textContent = 'Create';
            formBook.setAttribute('name', 'create');
        })

        btnCancel.addEventListener('click', e => {
            e.preventDefault();
            modal.classList.remove('modal-active');
            formBook.reset();
        })
    }
}

function deleteBook() {
    let btnDeleteBooks = document.querySelectorAll('.btn-delete-book');
    if (btnDeleteBooks) {
        btnDeleteBooks.forEach(btnDeleteBook => {
            btnDeleteBook.addEventListener('click', e => {
                e.preventDefault();
                let check = confirm('Do you want to delete this book!');
                if (check) {
                    let bookId = btnDeleteBook.getAttribute('book-id');
                    fetchDataBook('delete', {}, bookId);
                }
            })
        })
    }
}

async function getAllBook() {
    const books = await fetch('index.php?controller=book&action=getAllBook')
        .then(response => response.json())
        .then(posts => {
            return posts;
        });
    return books;
}

function updateBook() {
    let btnUpdateBooks = document.querySelectorAll('.btn-update-book');
    if (btnUpdateBooks) {
        btnUpdateBooks.forEach(btnUpdateBook => {
            btnUpdateBook.addEventListener('click', e => {
                e.preventDefault();
                btnCreate.click();
                btnCreateBook.textContent = 'Update';
                formBook.setAttribute('name', 'update');
                bookId = btnUpdateBook.getAttribute('book-id');
                getAllBook()
                    .then(books => {
                        books.forEach(book => {
                            if (book.book_id == bookId) {
                                let categories = document.querySelectorAll('option');
                                let title = document.querySelector('#title');
                                let author = document.querySelector('#author');
                                let price = document.querySelector('#price');
                                let description = document.querySelector('#description');
                                categories.forEach(category => {
                                    if (category.value == book.category_id) {
                                        console.log(book.category_id);
                                        category.selected = true;
                                    }
                                })
                                title.value = book.title;
                                author.value = book.author;
                                price.value = book.price;
                                description.value = book.description;
                            }
                        })
                    })
            })
        })
    }
}

function searchBook() {
    // let btnSearch = document.querySelector('.btn-search');
    let name = document.querySelector('.action h2');
    let inputSearch = document.querySelector('#search');
    if (inputSearch && name) {
        console.log(name);
        inputSearch.addEventListener('input', e => {
            if (name.innerText.toLowerCase() == 'book') {
                fetchDataBook('search', {}, inputSearch.value);
            }
        })
    }
}
function start() {
    validateBook();
    createBook();
    deleteBook();
    updateBook();
    searchBook();
}

start();