const modal = document.querySelector('.modal');
const formUser = document.querySelector('#form-user');
const btnCreate = document.querySelector('.btn-create');
const btnCancel = document.querySelector('.btn-cancel');
const btnCreateUser = document.querySelector('.btn-create-user');
// privilege
const modalPrivilege = document.querySelector('.modal-privilege');
const btnPrivilegeUsers = document.querySelectorAll('.btn-privilege-user');
const formPrivilege = document.querySelector('#form-privilege');
let userId;
function validateUser() {
    if (formUser) {
        Validator({
            form: '#form-user',
            rules: [
                isRequired('#first-name'),
                isRequired('#last-name'),
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
            console.log(posts);
            if (Array.isArray(posts) && posts.length != 0) {
                const contentBody = document.querySelector('.content-body');
                const users = posts.map(user => {
                    return `
                <tr>
                    <td>${user.user_id}</td>
                    <td>${user.first_name} ${user.last_name}</td>
                    <td>${user.email}</td>
                    <td>${user.password}</td>
                    <td>${user.create_date}</td>
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
            }
            else {
                confirm("loi khong the tao user");
            }
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
                                let firstName = document.querySelector('#first-name');
                                let lastName = document.querySelector('#last-name');
                                let email = document.querySelector('#email');
                                let password = document.querySelector('#password');
                                firstName.value = user.first_name;
                                lastName.value = user.last_name;
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

function changePrivileges() {
    let btnCancelPrivilege = document.querySelector('.btn-cancel-privilege');
    if (btnPrivilegeUsers) {
        btnPrivilegeUsers.forEach(btnPrivilegeUser => {
            btnPrivilegeUser.addEventListener('click', (e) => {
                modalPrivilege.classList.add('modal-active');
                let userId = btnPrivilegeUser.getAttribute('user-id');
                formPrivilege.setAttribute('user-id', userId);
                fetch(`index.php?controller=user&action=getAllRole&id=${userId}`)
                    .then(response => response.json())
                    .then(results => {
                        let roles = results.roles;
                        let userRoles = results.userRoles;
                        let roleGroup = document.querySelector('.role-group');
                        const datas = roles.map(role => {
                            let check = userRoles.some(userRole => {
                                return userRole.name == role.name;
                            });
                            return `<div class="form-group"> 
                                        <label for="">${role.description}</label>
                                        <input type="checkbox" name="${role.name}" value =${role.role_id} id="${role.name}" ${check ? 'checked' : ''}>
                                    </div>`;

                        })

                        roleGroup.innerHTML = datas.join('')
                    })
            })
        })
    }

    if (btnCancelPrivilege) {
        btnCancelPrivilege.addEventListener('click', (e) => {
            e.preventDefault();
            modalPrivilege.classList.remove('modal-active');
        })
    }

    if (formPrivilege) {
        formPrivilege.addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = new FormData(formPrivilege);
            let userId = formPrivilege.getAttribute('user-id');
            for (let [key, value] of formData.entries()) {
                console.log(`${key} => ${value}`);
            }
            fetch(`index.php?controller=user&action=updateRole&id=${userId}`, {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(results => {
                    if (results == 1) {
                        btnCancelPrivilege.click();
                    }
                })
        })
    }

}

function start() {
    validateUser();
    createUser();
    deleteUser();
    updateUser();
    searchUser();
    changePrivileges();
}

start();