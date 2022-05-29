// const modal = document.querySelector('.modal');
// const btnCreate = document.querySelector('.btn-create');
// const btnCancel = document.querySelector('.btn-cancel');
const formVoucher = document.querySelector('#form-voucher');
const btnCreateVoucher = document.querySelector('.btn-create-voucher');
let voucherId;
function validateVoucher() {
  if (formVoucher) {
    Validator({
      form: '#form-voucher',
      rules: [
        isRequired('#name'),
        isRequired('#description'),
        isRequired('#cost'),
        isRequired('#min'),
        isRequired('#code'),
        isRequired('#date'),
        isRequired('#date-expire'),
      ],
      onSubmit(data) {
        if (formVoucher.getAttribute('name') == 'create') {
          fetchDataVoucher('post', {
            method: 'post',
            body: data,
          });
        } else {
          fetchDataVoucher(
            'put',
            {
              method: 'post',
              body: data,
            },
            voucherId
          );
        }
      },
    });
  }
}

function fetchDataVoucher(type, data = {}, id) {
  let url = '';
  switch (type) {
    case 'search':
      url = `index.php?controller=discount&action=searchVoucher&str=${id}`;
      break;
    case 'put':
      url = `index.php?controller=discount&action=updateVoucher&id=${id}`;
      break;
    case 'post':
      url = 'index.php?controller=discount&action=createVoucher';
      break;
    case 'delete':
      url = `index.php?controller=discount&action=deleteVoucher&id=${id}`;
      break;
  }
  fetch(url, data)
    .then((response) => response.json())
    .then((posts) => {
      // dataUsers = posts;
      if (posts.length != 0) {
        const contentBody = document.querySelector('.content-body');
        const categories = posts.map((voucher) => {
          return `
                    <tr>
                    <td>${voucher.discount_id}</td>
                    <td>${voucher.discount_percent * 100}%</td>
                    <td>${voucher.discount_number} đ</td>
                    <td>${voucher.name}</td>
                    <td>${voucher.description}</td>
                    <td>${voucher.min_order}đ</td>
                    <td>${voucher.code}</td>
                    <td>${voucher.discount_type}</td>
                    <td>${voucher.discount_date}</td>
                    <td>${voucher.discount_expire}</td>
                    <td><a href="" class="btn-delete-voucher" voucher-id="${
                      voucher.discount_id
                    }"><i class="fas fa-trash-alt"></i></a>
                        <a href="" class="btn-update-voucher" voucher-id="${
                          voucher.discount_id
                        }"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
                    `;
        });
        contentBody.innerHTML = categories.join('');
        modal.classList.remove('modal-active');
        formVoucher.reset();
        deleteVoucher();
        updateVoucher();
      }
    });
}

function createVoucher() {
  if (formVoucher) {
    btnCreate.addEventListener('click', (e) => {
      modal.classList.add('modal-active');
      btnCreateVoucher.textContent = 'Create';
      formVoucher.setAttribute('name', 'create');
      let code = generateRandomString(8);
      document.querySelector('#code').value = code;
    });

    btnCancel.addEventListener('click', (e) => {
      e.preventDefault();
      modal.classList.remove('modal-active');
      formVoucher.reset();
    });
  }
}

function generateRandomString(length = 8) {
  let characters =
    'abcdefghijklmnopqrstuvwxyzaskdhfhfABCDEFGHIJKLMNksadfOPQRSTUVWXYZ';
  let strlen = characters.length;
  let randomString = '';
  for (let i = 0; i < length; i++) {
    randomString += characters[Math.floor(Math.random() * strlen + 0)];
  }
  return randomString;
}

function deleteVoucher() {
  let btnDeleteCategories = document.querySelectorAll('.btn-delete-voucher');
  if (btnDeleteCategories) {
    btnDeleteCategories.forEach((btnDeleteVoucher) => {
      btnDeleteVoucher.addEventListener('click', (e) => {
        e.preventDefault();
        let check = confirm('Do you want to delete this voucher!');
        if (check) {
          let voucherId = btnDeleteVoucher.getAttribute('voucher-id');
          fetchDataVoucher('delete', {}, voucherId);
        }
      });
    });
  }
}

async function getAllVoucher() {
  const categories = await fetch(
    'index.php?controller=Voucher&action=getAllVoucher'
  )
    .then((response) => response.json())
    .then((posts) => {
      return posts;
    });
  return categories;
}

function updateVoucher() {
  let btnUpdateCategories = document.querySelectorAll('.btn-update-voucher');
  if (btnUpdateCategories) {
    btnUpdateCategories.forEach((btnUpdateVoucher) => {
      btnUpdateVoucher.addEventListener('click', (e) => {
        e.preventDefault();
        btnCreate.click();
        btnCreateVoucher.textContent = 'Update';
        formVoucher.setAttribute('name', 'update');
        voucherId = btnUpdateVoucher.getAttribute('voucher-id');
        console.log(voucherId);
        getAllVoucher().then((categories) => {
          categories.forEach((voucher) => {
            if (voucher.voucher_id == voucherId) {
              let name = document.querySelector('#name');
              name.value = voucher.name;
            }
          });
        });
      });
    });
  }
}

function searchVoucher() {
  // let btnSearch = document.querySelector('.btn-search');
  let name = document.querySelector('.action h2');
  let inputSearch = document.querySelector('#search');
  if (inputSearch && name) {
    inputSearch.addEventListener('input', (e) => {
      if (name.innerText.toLowerCase() == 'voucher') {
        fetchDataVoucher('search', {}, inputSearch.value);
      }
    });
  }
}
function start() {
  validateVoucher();
  createVoucher();
  deleteVoucher();
  updateVoucher();
  searchVoucher();
  let codeElement = document.querySelector('.code');
  if (codeElement) {
    codeElement.onclick = function () {
      let code = generateRandomString(8);
      document.querySelector('#code').value = code;
    };
  }
}

start();
