// const modal = document.querySelector('.modal');
// const btnCreate = document.querySelector('.btn-create');
// const btnCancel = document.querySelector('.btn-cancel');
const formCategory = document.querySelector('#form-category');
const btnCreateCategory = document.querySelector('.btn-create-category');
let categoryId;
function validateCategory() {
    if (formCategory) {
        Validator({
            form: '#form-category',
            rules: [
                isRequired('#name'),
            ],
            onSubmit(data) {
                if (formCategory.getAttribute('name') == 'create') {
                    fetchDataCategory('post', {
                        method: 'post',
                        body: data
                    });
                }
                else {
                    fetchDataCategory('put', {
                        method: 'post',
                        body: data
                    }, categoryId)

                }
            }
        })
    }
}

function fetchDataCategory(type, data = {}, id) {
    let url = '';
    switch (type) {
        case 'search':
            url = `index.php?controller=category&action=searchCategory&str=${id}`;
            break;
        case 'put':
            url = `index.php?controller=category&action=updateCategory&id=${id}`;
            break;
        case 'post':
            url = 'index.php?controller=category&action=createCategory';
            break;
        case 'delete':
            url = `index.php?controller=category&action=deleteCategory&id=${id}`;
            break;
    }
    fetch(url, data)
        .then(response => response.json())
        .then(posts => {
            // dataUsers = posts;
            if (posts.length != 0) {
                const contentBody = document.querySelector('.content-body');
                const categories = posts.map(category => {
                    return `
                    <tr>
                        <td>${category.category_id}</td>
                        <td>${category.name}</td>
                        <td><a class="btn-delete-category" category-id="${category.category_id}" href="#">
                                <i class="fas fa-trash-alt"></i></a>
                            <a class="btn-update-category" category-id="${category.category_id}" href="#">
                                <i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                    `;
                })
                contentBody.innerHTML = categories.join('');
                modal.classList.remove('modal-active');
                formCategory.reset();
                deleteCategory();
                updateCategory();
            }
        })
}

function createCategory() {
    if (formCategory) {
        btnCreate.addEventListener('click', e => {
            modal.classList.add('modal-active');
            btnCreateCategory.textContent = 'Create';
            formCategory.setAttribute('name', 'create');
        })

        btnCancel.addEventListener('click', e => {
            e.preventDefault();
            modal.classList.remove('modal-active');
            formCategory.reset();
        })
    }
}

function deleteCategory() {
    let btnDeleteCategories = document.querySelectorAll('.btn-delete-category');
    if (btnDeleteCategories) {
        btnDeleteCategories.forEach(btnDeleteCategory => {
            btnDeleteCategory.addEventListener('click', e => {
                e.preventDefault();
                let check = confirm('Do you want to delete this category!');
                if (check) {
                    let categoryId = btnDeleteCategory.getAttribute('category-id');
                    fetchDataCategory('delete', {}, categoryId);
                }
            })
        })
    }
}

async function getAllCategory() {
    const categories = await fetch('index.php?controller=Category&action=getAllCategory')
        .then(response => response.json())
        .then(posts => {
            return posts;
        });
    return categories;
}

function updateCategory() {
    let btnUpdateCategories = document.querySelectorAll('.btn-update-category');
    if (btnUpdateCategories) {
        btnUpdateCategories.forEach(btnUpdateCategory => {
            btnUpdateCategory.addEventListener('click', e => {
                e.preventDefault();
                btnCreate.click();
                btnCreateCategory.textContent = 'Update';
                formCategory.setAttribute('name', 'update');
                categoryId = btnUpdateCategory.getAttribute('category-id');
                console.log(categoryId);
                getAllCategory()
                    .then(categories => {
                        categories.forEach(category => {
                            if (category.category_id == categoryId) {
                                let name = document.querySelector('#name');
                                name.value = category.name;
                            }
                        })
                    })
            })
        })
    }
}

function searchCategory() {
    // let btnSearch = document.querySelector('.btn-search');
    let name = document.querySelector('.action h2');
    let inputSearch = document.querySelector('#search');
    if (inputSearch && name) {
        inputSearch.addEventListener('input', e => {
            if (name.innerText.toLowerCase() == 'category') {
                fetchDataCategory('search', {}, inputSearch.value);
            }
        })
    }
}
function start() {
    validateCategory();
    createCategory();
    deleteCategory();
    updateCategory();
    searchCategory();
}

start();