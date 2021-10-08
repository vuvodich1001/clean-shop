const modal = document.querySelector('.modal');
const formUser = document.querySelector('#form-user');
const btnCreate = document.querySelector('.btn-create');
const btnCancel = document.querySelector('.btn-cancel');
const btnCreateUser = document.querySelector('.btn-create-user');
let userId;
function validateUser() {
    if (formUser) {
        Validator({
            form: '#form-user',
            rules: [
                isRequired('#name'),
                isEmail('#email'),
                isRequired('#password')
            ],
            onSubmit(data) {
                if (formUser.getAttribute('name') == 'create') {
                    fetchDataUser('post', {
                        method: 'post',
                        body: data
                    });
                }
                else {
                    fetchDataUser('put', {
                        method: 'post',
                        body: data
                    }, userId)

                }
            }
        })
    }
}

function fetchDataUser(type, data = {}, id) {
    let url = '';
    switch (type) {
        case 'search':
            url = `index.php?controller=user&action=searchUser&str=${id}`;
            break;
        case 'put':
            url = `index.php?controller=user&action=updateUser&id=${id}`;
            break;
        case 'post':
            url = 'index.php?controller=user&action=createUser';
            break;
        case 'delete':
            url = `index.php?controller=user&action=deleteUser&id=${id}`;
            break;
    }
    fetch(url, data)
        .then(response => response.json())
        .then(posts => {
            // dataUsers = posts;
            const contentBody = document.querySelector('.content-body');
            const users = posts.map(user => {
                return `
                <tr>
                    <td>${user.user_id}</td>
                    <td>${user.username}</td>
                    <td>${user.email}</td>
                    <td>${user.password}</td>
                    <td><a class="btn-delete-user" user-id="${user.user_id}" href="#">
                            <i class="fas fa-trash-alt"></i></a>
                        <a class="btn-update-user" user-id="${user.user_id}" href="#">
                            <i class="fas fa-edit"></i></a>
                    </td>
                </tr>
                `;
            })
            contentBody.innerHTML = users.join('');
            modal.classList.remove('modal-active');
            formUser.reset();
            deleteUser();
            updateUser();
        })
}

function createUser() {
    if (formUser) {
        btnCreate.addEventListener('click', e => {
            modal.classList.add('modal-active');
            btnCreateUser.textContent = 'Create';
            formUser.setAttribute('name', 'create');
        })

        btnCancel.addEventListener('click', e => {
            e.preventDefault();
            modal.classList.remove('modal-active');
            formUser.reset();
        })
    }
}

function deleteUser() {
    let btnDeleteUsers = document.querySelectorAll('.btn-delete-user');
    if (btnDeleteUsers) {
        btnDeleteUsers.forEach(btnDeleteUser => {
            btnDeleteUser.addEventListener('click', e => {
                e.preventDefault();
                let check = confirm('Do you want to delete this user!');
                if (check) {
                    let userId = btnDeleteUser.getAttribute('user-id');
                    fetchDataUser('delete', {}, userId);
                }
            })
        })
    }
}

async function getAllUser() {
    const users = await fetch('index.php?controller=user&action=getAllUser')
        .then(response => response.json())
        .then(posts => {
            return posts;
        });
    return users;
}

function updateUser() {
    let btnUpdateUsers = document.querySelectorAll('.btn-update-user');
    if (btnUpdateUsers) {
        btnUpdateUsers.forEach(btnUpdateUser => {
            btnUpdateUser.addEventListener('click', e => {
                e.preventDefault();
                btnCreate.click();
                btnCreateUser.textContent = 'Update';
                formUser.setAttribute('name', 'update');
                userId = btnUpdateUser.getAttribute('user-id');
                getAllUser()
                    .then(users => {
                        users.forEach(user => {
                            if (user.user_id == userId) {
                                let username = document.querySelector('#name');
                                let email = document.querySelector('#email');
                                let password = document.querySelector('#password');
                                username.value = user.username;
                                email.value = user.email;
                                password.value = user.password;
                            }
                        })
                    })
            })
        })
    }
}

function searchUser() {
    // let btnSearch = document.querySelector('.btn-search');
    let name = document.querySelector('.action h2');
    let inputSearch = document.querySelector('#search');
    if (inputSearch && name) {
        console.log(name);
        inputSearch.addEventListener('input', e => {
            if (name.innerText.toLowerCase() == 'user') {
                fetchDataUser('search', {}, inputSearch.value);
            }
        })
    }
}
function start() {
    validateUser();
    createUser();
    deleteUser();
    updateUser();
    searchUser();
}

start();