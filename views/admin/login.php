<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        :root {
            --white-color: #fff;
            --main-color: #ea4c89;
        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        form {
            width: 400px;
            padding: 30px;
            margin: 50px auto;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        form h3 {
            text-align: center;
            font-size: 25px;
        }

        .form-group {
            margin-top: 15px;
        }

        .form-group label {
            font-size: 17px;
            font-weight: 700;
        }

        .form-group input {
            flex: 1;
            width: 100%;
            padding: 5px 7px;
            font-size: 16px;
            border: 1px solid #ccc;
            outline: none;
        }

        .form-group input:focus {
            border: 1px solid #333;
        }

        .btn {
            margin-top: 20px;
            display: block;
            text-decoration: none;
            padding: 8px 15px;
            outline: none;
            border: none;
            background-color: var(--white-color);
            font-size: 17px;
            font-weight: 500;
            border-radius: 20px;
            cursor: pointer;
            transition: opacity linear 0.2s;
            min-width: 100px;
        }

        .btn.active {
            width: 100%;
            background-color: var(--main-color);
            color: var(--white-color);
        }

        .login-fail {
            margin-top: 10px;
            color: red;
            font-size: 16px;
            display: none;
        }

        .form-group.invalid input {
            border: 1px solid red;
        }

        .form-message {
            display: block;
            margin-top: 5px;
            color: red;
        }
    </style>
</head>

<body>
    <div class="app">
        <form action="index.php" id="form-login" method="POST">
            <h3>Admin Login</h3>
            <div class="form-group">
                <input type="text" name="username" id="username" placeholder="Tài Khoản">
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" autocomplete="off" placeholder="Mật khẩu">
            </div>
            <p class="login-fail">Tài khoản hoặc mật khẩu không chính xác</p>
            <button class="btn active btn-submit">Đăng nhập</button>
            <div class="btn-close-form"><i class="fas fa-times"></i></div>
        </form>
    </div>
    <script src="../public/admin/js/Validator.js"></script>
    <script>
        Validator({
            form: '#form-login',
            rules: [
                isRequired('#username'),
                isRequired('#password'),
                minLength('#password', 6)
            ],
            onSubmit(formData) {
                fetch('index.php?controller=auth&action=adminLogin', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(check => {
                        console.log(check);
                        if (check == 1) {
                            document.querySelector('#form-login').submit();
                        } else {
                            document.querySelector('.login-fail').style.display = 'block';
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        })
    </script>

</body>

</html>