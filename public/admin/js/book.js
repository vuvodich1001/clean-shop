const formBook = document.querySelector('#form-book');
const btnCreateBook = document.querySelector('.btn-create-book');
const modalBody = document.querySelector('.modal-body');
let bookId;
function validateBook() {
  if (formBook) {
    Validator({
      form: '#form-book',
      rules: [
        isRequired('#title'),
        // isRequired('#author'),
        isRequired('#price'),
        // isRequired('#description'),
      ],
      onSubmit(data) {
        data.append('description', CKEDITOR.instances['description'].getData());
        if (formBook.getAttribute('name') == 'create') {
          fetchDataBook('post', {
            method: 'post',
            body: data,
          });
        } else {
          fetchDataBook(
            'put',
            {
              method: 'post',
              body: data,
            },
            bookId
          );
        }
      },
    });
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
    .then((response) => response.json())
    .then((posts) => {
      // dataBooks = posts;
      console.log(posts);
      const contentBody = document.querySelector('.content-body');
      const books = posts.map((book) => {
        let dateTime = book.create_date;
        let wanted = '';
        if (dateTime) {
          let parts = dateTime.split(/[- :]/);
          wanted = `${parts[0]}-${parts[1]}-${parts[2]}`;
        }
        let image = book.main_image.split(',')[0];
        return `
                <tr>
                    <td>${book.book_id}</td>
                    <td>${book.title}</td>
                    <td>${book.price}</td>
                    <td><img src="../public/admin/uploads/${image}" alt=""></td>
                    <td>
                        <div>${book.description}</div>
                    </td>
                    <td>${book.publish_date}</td>
                    <td>${wanted}</td>
                    <td><a class="btn-delete-book" book-id="${book.book_id}" href=""><i class="fas fa-trash-alt"></i></a>
                        <a class="btn-update-book" book-id="${book.book_id}" href=""><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
                `;
      });
      contentBody.innerHTML = books.join('');
      modal.classList.remove('modal-active');
      formBook.reset();
      deleteBook();
      updateBook();
    });
}

function createBook() {
  if (formBook) {
    modalBody.style.top = '-50px';
    btnCreate.addEventListener('click', (e) => {
      modal.classList.add('modal-active');
      btnCreateBook.textContent = 'Create';
      formBook.setAttribute('name', 'create');
    });

    btnCancel.addEventListener('click', (e) => {
      e.preventDefault();
      modal.classList.remove('modal-active');
      formBook.reset();
      CKEDITOR.instances['description'].setData('');
    });
  }
}

function deleteBook() {
  let btnDeleteBooks = document.querySelectorAll('.btn-delete-book');
  if (btnDeleteBooks) {
    btnDeleteBooks.forEach((btnDeleteBook) => {
      btnDeleteBook.addEventListener('click', (e) => {
        e.preventDefault();
        let check = confirm('Do you want to delete this book!');
        if (check) {
          let bookId = btnDeleteBook.getAttribute('book-id');
          fetchDataBook('delete', {}, bookId);
        }
      });
    });
  }
}

async function getAllBook() {
  const books = await fetch('index.php?controller=book&action=getAllBook')
    .then((response) => response.json())
    .then((posts) => {
      return posts;
    });
  return books;
}

function updateBook() {
  let btnUpdateBooks = document.querySelectorAll('.btn-update-book');
  if (btnUpdateBooks) {
    btnUpdateBooks.forEach((btnUpdateBook) => {
      btnUpdateBook.addEventListener('click', (e) => {
        e.preventDefault();
        btnCreate.click();
        btnCreateBook.textContent = 'Update';
        formBook.setAttribute('name', 'update');
        bookId = btnUpdateBook.getAttribute('book-id');
        getAllBook().then((books) => {
          books.forEach((book) => {
            if (book.book_id == bookId) {
              let categories = document.querySelectorAll('option');
              let title = document.querySelector('#title');
              let price = document.querySelector('#price');
              let publishDate = document.querySelector('#publish-date');
              categories.forEach((category) => {
                if (category.value == book.category_id) {
                  category.selected = true;
                }
              });
              title.value = book.title;
              price.value = book.price;
              publishDate.value = book.publish_date;
              CKEDITOR.instances['description'].setData(book.description);
            }
          });
        });
      });
    });
  }
}

function searchBook() {
  // let btnSearch = document.querySelector('.btn-search');
  let name = document.querySelector('.action h2');
  let inputSearch = document.querySelector('#search');
  if (inputSearch && name) {
    console.log(name);
    inputSearch.addEventListener('input', (e) => {
      if (name.innerText.toLowerCase() == 'book') {
        fetchDataBook('search', {}, inputSearch.value);
      }
    });
  }
}

function showSubCategory() {
  let category = document.querySelector('#category');
  let subcategory = document.querySelector('#subcategory');
  if (category) {
    category.onchange = function (e) {
      let categoryId = e.target.value;
      fetch(
        `index.php?controller=category&action=getAllSubCategoryById&id=${categoryId}`
      )
        .then((res) => res.json())
        .then((results) => {
          const temp = results.map((result) => {
            return `<option value="${result.subcategory_id}">${result.name}</option>`;
          });
          subcategory.innerHTML = temp.join('');
        });
    };
  }
}

function start() {
  validateBook();
  createBook();
  deleteBook();
  updateBook();
  searchBook();
  showSubCategory();
}

start();
