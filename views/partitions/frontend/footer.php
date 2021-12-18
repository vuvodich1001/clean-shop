</main>
<footer>
    <div class="grid wide">
        <div class="row footer-content">
            <div class="col l-2-4">
                <h4>Hỗ trợ khách hàng</h4>
                <ul>
                    <li><a href="">Hotline: 0123456789</a></li>
                    <li><a href="">Câu hỏi thường gặp</a></li>
                    <li><a href="">Gửi yêu cầu hỗ trợ</a></li>
                    <li><a href="">Phương thức vận chuyển</a></li>
                </ul>
            </div>
            <div class="col l-2-4">
                <h4>Về BookStore</h4>
                <ul>
                    <li><a href="">Giới thiệu bookstore</a></li>
                    <li><a href="">Chính sách bảo mật</a></li>
                    <li><a href="">Điều khoản sử dụng</a></li>
                    <li><a href="">Chính sách giao hàng</a></li>
                </ul>
            </div>
            <div class="col l-2-4">
                <h4>Hợp tác và liên kết</h4>
                <ul>
                    <li><a href="">Hợp tác UIT</a></li>
                    <li><a href="">Bán hàng cùng bookstore</a></li>
                </ul>
            </div>
            <div class="col l-2-4">
                <h4>Phương thức thanh toán</h4>
                <div class="payment">
                    <i class="fab fa-cc-paypal"></i>
                    <p>COD</p>
                    <!-- <img src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/visa.svg" alt=""> -->
                    <!-- <img src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/cash.svg" alt="">
                    <img src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/internet-banking.svg" alt=""> -->
                </div>
            </div>
            <div class="col l-2-4">
                <h4>Kết nối với chúng tôi</h4>
                <div class="link-us">
                    <a href=""><i class="icon-facebook fab fa-facebook"></i></a>
                    <a href=""><i class="icon-youtube fab fa-youtube"></i></a>
                    <a href=""><i class="icon-mail fas fa-envelope"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="modal modal-overlay modal-auth">
    <div class=" auth-content">
        <form action="index.php" id="form-login" method="POST">
            <h3>Thành viên đăng nhập</h3>
            <div class=" form-group">
                <input type="text" name="username" id="username" placeholder="Tài Khoản">
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" autocomplete="off" placeholder="Mật khẩu">
            </div>
            <p class="login-fail">Tài khoản hoặc mật khẩu không chính xác</p>
            <button class="btn btn-submit">Đăng nhập</button>
            <div class="form-link">
                <p>Or use a social network</p>
                <div class="form-link-icon">
                    <a href=""><i class="fab fa-twitter"></i></a>
                    <a href=""><i class="fab fa-facebook"></i></a>
                    <a href=""><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
            <div class="form-footer">
                <p>Don't have an account? <a href="">Sign up</a></p>
            </div>
            <div class="btn-close-form"><i class="fas fa-times"></i></div>
        </form>

        <form action="" id="form-register" method="">
            <h3>Thành viên đăng ký</h3>
            <div class="name-group">
                <div class="form-group">
                    <input type="text" name="first-name" id="first-name" placeholder="Họ">
                </div>
                <div class="form-group">
                    <input type="text" name="last-name" id="last-name" placeholder="Tên">
                </div>
            </div>
            <div class="form-group">
                <input type="email" name="email" id="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" name="rpassword" id="rpassword" placeholder="Mật khẩu">
            </div>
            <div class="form-group">
                <input type="password" name="crpassword" id="crpassword" autocomplete="off" placeholder="Nhập lại mật khẩu">
            </div>
            <button class="btn btn-submit">Đăng ký</button>
            <div class="form-link">
                <p>Or use a social network</p>
                <div class="form-link-icon">
                    <a href=""><i class="fab fa-twitter"></i></a>
                    <a href=""><i class="fab fa-facebook"></i></a>
                    <a href=""><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
            <div class="form-footer">
                <p>Have an account? <a href="">Sign in</a></p>
            </div>
            <div class="btn-close-form"><i class="fas fa-times"></i></div>
        </form>
    </div>
</div>

<script src="./public/frontend/js/main.js"></script>
<script src="./public/frontend/js/cart.js"></script>
<script src="./public/frontend/js/productdetail.js"></script>
<script src="./public/frontend/js/authenticate.js"></script>
<script src="./public/admin/js/Validator.js"></script>
<script src="./public/frontend/js/checkout.js"></script>
<script src="./public/frontend/js/bookslider.js"></script>
<script src="./public/frontend/js/account.js"></script>
<script src="./public/frontend/js/voucher.js"></script>
<script src="./public/frontend/js/favourite.js"></script>
<script src="./public/frontend/js/review.js"></script>

<!-- slick slider and jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // validator for form login and register
    Validator({
        form: '#form-login',
        rules: [
            isRequired('#username'),
            isRequired('#password'),
            minLength('#password', 6)
        ],
        onSubmit(formData) {
            fetch('index.php?controller=auth&action=customerLogin', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(check => {
                    if (check == 1) {
                        document.querySelector('#form-login').submit();
                    } else {
                        document.querySelector('.login-fail').style.display = 'block';
                    }
                })
        }
    })

    Validator({
        form: '#form-register',
        rules: [
            isRequired('#first-name'),
            isRequired('#last-name'),
            isRequired('#email'),
            isEmail('#email'),
            isRequired('#rpassword'),
            minLength('#rpassword', 6),
            isRequired('#crpassword'),
            minLength('#crpassword', 6),
            isConfirmed('#crpassword', () => {
                return document.querySelector('#rpassword').value;
            })
        ],
        onSubmit(formData) {
            fetch('index.php?controller=customer&action=registerCustomer', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(check => {
                    if (check == 1) {
                        let btnCloses = document.querySelectorAll('.btn-close-form');
                        btnCloses.forEach(btnClose => {
                            btnClose.click();
                        });
                        alert('Bạn đã đăng ký thành công!');
                    } else {
                        alert('Đăng kí thất bại !!!')
                    }

                })
        }
    })

    // book-slider
    let bookSlider = document.querySelector('.book-slider');
    if (bookSlider) {
        $('.book-slider').slick({
            infinite: true,
            slidesToShow: 6,
            slidesToScroll: 6
        });
    }

    // more-img
    // let moreImg = document.querySelector('.more-img');
    // if (moreImg) {
    //     $('.more-img').slick({
    //         infinite: true,
    //         slidesToShow: 4,
    //         slidesToScroll: 4
    //     });
    // }
    // banner-slider
    if ($('.slider')) {
        $('.slider').slick({
            dots: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 5000,
        });
    }
</script>
</body>


</html>