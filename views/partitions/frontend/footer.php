</main>
<footer>

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
<script src="./public/frontend/js/bookslider.js"></script>

<!-- slick slider and jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
    integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

// slider
let bookSlider = document.querySelector('.book-slider');
if (bookSlider) {
    console.log('test');
    $('.book-slider').slick({
        infinite: true,
        slidesToShow: 6,
        slidesToScroll: 6
    });
}
</script>
</body>


</html>