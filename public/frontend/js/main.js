let subcategory = '';
let filterName = document.querySelector('.filter-name');
function fetchData(type, val, str) {
  switch (type) {
    case 'get':
      url = `index.php?controller=book&action=getByCategory&category=${val}`;
      break;
    case 'filter':
      url = `index.php?controller=book&action=filterBook&category=${val}&sortby=${str}`;
      break;
    case 'pagination':
      url = `index.php?controller=book&action=pagination&category=${val}&page=${str}`;
      break;
    case 'paginationSubCategory':
      url = `index.php?controller=book&action=paginationSubCategory&subcategory=${val}&page=${str}`;
      break;
    case 'search':
      url = `index.php?controller=book&action=searchBook&name=${val}`;
      break;
    case 'subcategory':
      url = `index.php?controller=book&action=getBySubCategory&alias=${val}`;
      break;
  }
  fetch(url)
    .then((response) => response.json())
    .then((posts) => {
      if (posts.length !== 0) {
        const books = posts.map((book) => {
          let ratingView = '';
          book.rating ? book.rating : (book.rating = 0);
          for (let i = 1; i <= book.rating; i++) {
            ratingView += '<i class="fas fa-star"></i> ';
          }
          for (let i = 1; i <= 5 - book.rating; i++) {
            ratingView += '<i class="far fa-star"></i> ';
          }

          let bookPrice = book.price
            .toString()
            .replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
          let image = book.main_image.split(',')[0];
          return `
                <div class="col l-2-4 m-4 c-6">
                    <a href="product/detail/${book['book_id']}" class="item">
                        <img src="public/admin/uploads/${image}" alt="">
                        <div class="item-body">
                            <p class="item-title">${book.title}</p>
                            <div class="item-group">
                                <p class="item-price">${bookPrice} ₫</p>
                                <p class="item-sale"> Đã bán ${
                                  book.sale_quantity == null
                                    ? 0
                                    : book.sale_quantity
                                }</p>
                            </div>
                            <div class="item-rate">
                                <div class="item-rate__heart" book-id=${
                                  book['book_id']
                                }>
                                    <i class="heart-icon far fa-heart"></i>
                                    <i class="heart-icon-fill fas fa-heart"></i>
                                </div>
                                <div class="item-rate__star">
                                    ${ratingView}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                `;
        });
        document.querySelector('.book').innerHTML = books.join('');
        heartIconChange();
      } else {
        document.querySelector(
          '.book'
        ).innerHTML = `<p style="margin-top: 20px;font-size: 22px; width: 100%; color: var(--main-color); font-weight: bold;text-align: center;">
                                                            OOPS !!! Không tìm thấy sản phẩm nào !!!<p>`;
      }
    });
}

function removeFilterActive() {
  let btns = document.querySelectorAll('.home-filter .btn');
  btns.forEach((btn) => {
    if (btn.matches('.active')) {
      btn.classList.remove('active');
    }
  });
}

// Get book by category
function sideBarAction() {
  let sidebarItems = document.querySelectorAll('.sidebar-item');
  let pageItems = document.querySelectorAll('.page-item-link');
  function removeAllActive(sidebarItems) {
    sidebarItems.forEach((sidebarItem) => {
      sidebarItem.classList.remove('active');
    });
  }
  function activePageItem() {
    pageItems.forEach((pageItem, key) => {
      if (key == 0) pageItem.classList.add('page-item-active');
      else pageItem.classList.remove('page-item-active');
    });
  }
  sidebarItems.forEach((sidebarItem) => {
    sidebarItem.onclick = function (e) {
      removeAllActive(sidebarItems);
      removeFilterActive();
      activePageItem();
      this.classList.add('active');
      let val = this.children[0].getAttribute('category-name');
      filterName.innerText = e.target.textContent;
      subcategory = '';
      fetchData('get', val);
    };
  });
}

// getProductBySubCategory
function getProductBySubCatgory() {
  let popupItems = document.querySelectorAll('.sidebar-popup-item');
  console.log(popupItems);
  if (popupItems) {
    Array.from(popupItems).forEach((popupItem) => {
      popupItem.onclick = function (e) {
        e.stopPropagation();
        let alias = popupItem.getAttribute('subcategeory-name');
        filterName.innerText = e.target.textContent;
        subcategory = alias;
        fetchData('subcategory', alias);
      };
    });
  }
}

function findSideBarItemActive() {
  let sidebarItems = document.querySelectorAll('.sidebar-item');
  let sidebarItemActive = Array.from(sidebarItems).find((sidebarItem) => {
    return sidebarItem.matches('.active');
  });
  return sidebarItemActive;
}

// filter book => new, sort, best seller
function filterProduct() {
  let btnPopular = document.querySelector('.btn-popular');
  let btnNew = document.querySelector('.btn-new');
  let btnBestSeller = document.querySelector('.btn-best-seller');
  let btnPriceDownUp = document.querySelector('.btn-price-down-up');
  let btnPriceUpDown = document.querySelector('.btn-price-up-down');

  function filterBook(e) {
    removeFilterActive();
    let str = '';
    let val = e.target.getAttribute('value');
    let btnPrice = document.querySelector('.home-filter .btn-price');
    let categoryName =
      findSideBarItemActive().firstElementChild.getAttribute('category-name');
    switch (val) {
      case 'new':
        str = 'create_date desc';
        e.target.classList.add('active');
        break;
      case 'down-up':
        str = 'price asc';
        btnPrice.classList.add('active');
        break;
      case 'up-down':
        str = 'price desc';
        btnPrice.classList.add('active');
        break;
      case 'best-seller':
        str = 'rating desc';
        e.target.classList.add('active');
      default:
        break;
    }
    console.log(str);
    fetchData('filter', categoryName, str);
  }

  if (btnNew) {
    btnNew.addEventListener('click', filterBook);
  }

  if (btnPriceDownUp) {
    btnPriceDownUp.addEventListener('click', filterBook);
  }

  if (btnPriceUpDown) {
    btnPriceUpDown.addEventListener('click', filterBook);
  }

  if (btnBestSeller) {
    btnBestSeller.addEventListener('click', filterBook);
  }
}
// Heart icon change and add favourite book into db
function heartIconChange() {
  let heartIcons = document.querySelectorAll('.item-rate__heart');
  if (heartIcons) {
    heartIcons.forEach((heartIcon) => {
      heartIcon.onclick = function (e) {
        e.preventDefault();
        let bookId = this.getAttribute('book-id');
        fetch(
          `index.php?controller=book&action=addFavouriteBook&book-id=${bookId}`
        )
          .then((response) => response.json())
          .then((result) => {
            if (result == 0) {
              alert('Đăng nhập để thêm vào mục sản phẩm yêu thích');
            } else {
              this.classList.toggle('heart-active');
            }
          });
      };
    });
  }
}

// Page
function pagination() {
  let pageItems = document.querySelectorAll('.page-item-link');
  if (pageItems) {
    pageItems.forEach((pageItem) => {
      pageItem.addEventListener('click', (e) => {
        e.preventDefault();
        pageItems.forEach((pageItem) => {
          pageItem.classList.remove('page-item-active');
        });
        pageItem.classList.add('page-item-active');
        let str = e.target.innerText;
        let categoryName =
          findSideBarItemActive().firstElementChild.getAttribute(
            'category-name'
          );
        if (subcategory) {
          fetchData('paginationSubCategory', subcategory, str);
        } else fetchData('pagination', categoryName, str);
      });
    });
  }
}
// Search
function searchBook() {
  let btnSearch = document.querySelector('.btn-search');
  let inputSearch = document.querySelector('#search');
  if (btnSearch) {
    btnSearch.addEventListener('click', (e) => {
      let val = inputSearch.value;
      fetchData('search', val);
    });
  }
}

function start() {
  sideBarAction();
  let sidebarFirst = document.querySelector('.sidebar-item:first-child');
  if (sidebarFirst) sidebarFirst.click();
  filterProduct();
  pagination();
  searchBook();
  getProductBySubCatgory();
}

start();
