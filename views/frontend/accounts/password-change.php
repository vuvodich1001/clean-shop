<?php $this->view('partitions.frontend.header') ?>
<div class="grid wide">
    <div class="row">
        <div class="col l-12">
            <div class="breadcrumb">
                <ul>
                    <li class="breadcrumb-item"><a href="">Home/</a></li>
                    <li class="breadcrumb-item"><a href="account/info">Info/</a></li>
                    <li class="breadcrumb-item">Change Password</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row account-container">
        <div class="col l-3">
            <?php $this->view('frontend.accounts.sidebar', ['info' => $info]) ?>
        </div>
        <div class="col l-9">
            <h3>Đổi mật khẩu</h3>
            <div class="account-body">
                <form action="index.php?controller=account&action=updateInfo" id="account-form" method="POST">
                    <div class="form-group">
                        <label for="">Mật khẩu hiện tại</label>
                        <input type="password" name="" id="old-password" placeholder="Nhập mật khẩu hiện tại" required>
                    </div>
                    <div class="form-group">
                        <label for="">Mật khẩu mới</label>
                        <input type="password" name="password" id="password" placeholder="Nhập mật khẩu mới" required>
                    </div>
                    <div class="form-group">
                        <label for="">Nhập lại mật khẩu mới</label>
                        <input type="password" name="" id="rnew-password" placeholder="Nhập lại mật khẩu mới" required>
                    </div>
                    <button class="btn active"> Lưu thay đổi</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->view('partitions.frontend.footer') ?>