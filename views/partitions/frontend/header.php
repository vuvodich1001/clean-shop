<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookStore</title>
    <!-- font -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- slick slider -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css basic -->
    <link rel="stylesheet" href="./public/frontend/css/grid.css">
    <link rel="stylesheet" href="./public/frontend/css/base.css">
    <link rel="stylesheet" href="./public/frontend/css/style.css">
</head>

<body>
    <header>
        <div class="grid wide">
            <nav>
                <div class="nav-logo">
                    <a href="index.php"><img src="public/frontend/images/logo.png" alt=""></a>
                </div>
                <div class="nav-search">
                    <div class="nav-search-wrap">
                        <input type="text" id="search" placeholder="Tìm sách bạn muốn mua">
                    </div>
                    <button class="btn-search"><i class="fas fa-search"></i></button>

                </div>

                <div class="nav-auth">
                    <div class="nav-auth-icon">
                        <i class="far fa-user-circle"></i>
                    </div>
                    <?php
                    if (session_status() === PHP_SESSION_NONE) session_start();
                    if (!isset($_SESSION['customer'])) {
                        echo '<div class="nav-auth-text">
                                <p>Đăng nhập/ Đăng ký</p>
                                <p class="account">Tài khoản<i class="account-icon fas fa-sort-down"></i></p>
                            </div>
                            <div class="nav-auth-body">
                                <a class="btn-auth btn-login">Đăng nhập</a>
                                <a class="btn-auth btn-register">Tạo tài khoản</a>
                            </div>';
                    } else {
                        echo '<div class="nav-auth-text">
                                <p>Tài khoản</p>
                                <p class="account">Nguyễn Công Vũ<i class="account-icon fas fa-sort-down"></i></p>
                            </div>
                            <div class="nav-auth-body">
                                <a href="" class="btn-account">Đơn hàng của tôi</a>
                                <a href="" class="btn-account">Tài khoản của tôi</a>
                                <a href="" class="btn-account">Nhận xét sản phẩm đã mua</a>
                                <a href="index.php?controller=auth&action=customerLogout" class="btn-account">Thoát tài khoản</a>
                            </div>';
                    }

                    ?>
                </div>

                <div class="nav-cart">
                    <div class="nav-cart-icon">
                        <a href="index.php?controller=cart"><i class="fas fa-shopping-cart"></i><span>Giỏ
                                hàng</span></a>
                    </div>
                    <div class="nav-cart-success">
                        <p><i class="nav-cart-success-icon fas fa-check-circle"></i> Thêm vào vào giỏ hàng thành công!
                        </p>
                        <a href="index.php?controller=cart" class="btn btn-view-cart">Xem giỏ hàng và
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