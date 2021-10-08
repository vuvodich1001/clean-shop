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
                    <img src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/visa.svg" alt="">
                    <img src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/cash.svg" alt="">
                    <img src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/internet-banking.svg" alt="">
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
<div class="modal modal-overlay">
    <div class="auth-content">
        <form action="" id="form-login" method="">
            <h3>Thành viên đăng nhập</h3>
            <div class="form-group">
                <label for="">Username</label>
                <input type="text" name="username" id="username">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password" id="password" autocomplete="off">
            </div>

            <button class="btn btn-submit">Đăng nhập</button>
            <div class="btn-close-form"><i class="fas fa-times"></i></div>
        </form>

        <form action="" id="form-register" method="">
            <h3>Thành viên đăng ký</h3>
            <div class="form-group">
                <label for="">Username</label>
                <input type="text" name="username" id="name">
            </div>
            <div class="form-group">
                <label for="">email</label>
                <input type="email" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="">Phone</label>
                <input type="text" name="phone" id="phone">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="rpassword" id="rpassword" autocomplete="off">
            </div>

            <button class="btn btn-submit">Đăng ký</button>
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

<!-- slick slider and jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    Validator({
        form: '#form-login',
        rules: [
            isRequired('#username'),
            isRequired('#password'),
            minLength('#password', 6)
        ]
    })

    Validator({
        form: '#form-register',
        rules: [
            isRequired('#name'),
            isEmail('#email'),
            isRequired('#phone'),
            isRequired('#rpassword'),
            minLength('#rpassword', 6)
        ]
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