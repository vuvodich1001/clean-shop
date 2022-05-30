<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CleanShop</title>
    <!-- base url-->
    <base href="http://localhost/clean-shop/">
    <!-- font roboto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Work+Sans:wght@700&display=swap" rel="stylesheet">
    <!-- font -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <!-- slick slider -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css basic -->
    <link rel="stylesheet" href="./public/frontend/css/grid.css">
    <link rel="stylesheet" href="./public/frontend/css/base.css">
    <link rel="stylesheet" href="./public/frontend/css/style.css">
    <link rel="stylesheet" href="./public/frontend/css/responsive.css">
</head>

<body>
    <header>
        <div class="grid wide">
            <nav>
                <div class="nav-logo hide-on-mobile-tablet">
                    <!-- <a href="index.php"><img src="public/frontend/images/logo.png" alt=""></a> -->
                    <a href="">
                        <h1><img src="./public/frontend/images/4EClean.png" alt="" style="width: 180px; height: 180px; object-fit: cover;"></h1>
                    </a>
                </div>
                <div class="nav-search">
                    <div class="nav-search-wrap">
                        <input type="text" id="search" placeholder="Tìm sản phẩm bạn muốn mua">
                    </div>
                    <button class="btn-search"><i class="fas fa-search"></i></button>

                </div>

                <div class="nav-auth">
                    <div class="nav-auth-icon">
                        <i class="far fa-user-circle"></i>
                    </div>
                    <?php
                    if (session_status() === PHP_SESSION_NONE) session_start();
                    if (!isset($_SESSION['customer'])) { ?>
                        <div class="nav-auth-text">
                            <p>Đăng nhập/ Đăng ký</p>
                            <p class="account">Tài khoản<i class="account-icon fas fa-sort-down"></i></p>
                        </div>
                        <div class="nav-auth-body">
                            <a class="btn-auth btn-login">Đăng nhập</a>
                            <a class="btn-auth btn-register">Tạo tài khoản</a>
                        </div>
                    <?php } else {
                        $firstName = ucfirst($_SESSION['customer']['first_name']);
                        $lastName = ucfirst($_SESSION['customer']['last_name']);
                    ?>
                        <div class="nav-auth-text">
                            <p>Tài khoản</p>
                            <p class="account"> <?php echo $firstName . ' ' . $lastName ?> <i class="account-icon fas fa-sort-down"></i></p>
                        </div>
                        <div class="nav-auth-body">
                            <a href="account/order" class="btn-account">Đơn hàng của tôi</a>
                            <a href="account/info" class="btn-account">Tài khoản của tôi</a>
                            <a href="account/comment" class="btn-account">Nhận xét sản phẩm đã mua</a>
                            <a href="index.php?controller=auth&action=customerLogout" class="btn-account">Thoát tài khoản</a>
                        </div>
                    <?php } ?>
                </div>

                <div class="nav-cart">
                    <div class="nav-cart-icon">
                        <a href="cart"><i class="fas fa-shopping-cart"></i><span>Giỏ
                                hàng</span></a>
                    </div>
                    <div class="nav-cart-success">
                        <p><i class="nav-cart-success-icon fas fa-check-circle"></i> Thêm vào vào giỏ hàng thành công!
                        </p>
                        <a href="cart" class="btn btn-view-cart">Xem giỏ hàng và
                            thanh
                            toán</a>
                        <div class="cart-close">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                    <p class="nav-cart-quantity">
                        <?php
                        if (isset($_SESSION['cart'])) echo count($_SESSION['cart']);
                        else echo 0; ?>
                    </p>
                </div>
            </nav>
        </div>
    </header>

    <main>