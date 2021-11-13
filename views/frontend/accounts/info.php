<?php $this->view('partitions.frontend.header') ?>
<div class="grid wide">
    <div class="row">
        <div class="col l-12">
            <div class="breadcrumb">
                <ul>
                    <li class="breadcrumb-item"><a href="">Home/</a></li>
                    <li class="breadcrumb-item"><a href=""></a>Info</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row account-container">
        <div class="col l-3">
            <?php $this->view('frontend.accounts.sidebar', ['info' => $info]) ?>
        </div>
        <div class="col l-9">
            <div class="account-info-person">
                <h3>Thông tin tài khoản</h3>
                <div class="row">
                    <div class="col l-7">
                        <form action="index.php?controller=account&action=updateInfo" id="form-info" method="POST">
                            <p class="info-title">Thông tin cá nhân</p>
                            <div class="form-group-info">
                                <label for="">Họ và tên</label>
                                <input type="text" name="" id="" disabled="disabled" value="<?php echo ucfirst($customer['first_name']) . ' ' . ucfirst($customer['last_name']) ?>">
                            </div>
                            <div class="form-group-info">
                                <label for="">Nickname</label>
                                <input type="text" name="nickname" id="nickname" value="<?php echo empty($customer['nickname']) ? '' : $customer['nickname'] ?>">
                            </div>
                            <div class="form-group-info">
                                <label for="">Ngày tháng năm sinh</label>
                                <input type="text" name="birthday" id="birthday" value="<?php echo empty($customer['birthday']) ? '' : $customer['birthday'] ?>" onfocus="this.type = 'date'">
                            </div>
                            <div class="form-group-info">
                                <label for="">Giới tính</label>
                                <input type="radio" name="gender" id="" value="nam" <?php if ($customer['gender'] == 'nam') echo 'checked' ?>>
                                <span>Nam</span>
                                <input type="radio" name="gender" id="" value="nu" <?php if ($customer['gender'] == 'nu') echo 'checked' ?>>
                                <span>Nữ</span>
                            </div>
                            <div class="form-group-button">
                                <button class="btn active">Lưu thay đổi</button>
                            </div>
                    </div>
                    <div class="col l-5">
                        <div class="more-info">
                            <p class="info-title">Số điện thoại và email</p>
                            <div class="info-wrap">
                                <div class="info-wrap-body">
                                    <i class="fas fa-phone-alt"></i>
                                    <div>
                                        <p>Số điện thoại</p>
                                        <p><?php echo empty($customer['phone']) ? 'Chưa có' : $customer['phone']; ?> </p>
                                    </div>
                                </div>

                                <div>
                                    <a href="account/info/update-phone" class="btn-update-info btn-account-action">Cập nhật</a>
                                </div>
                            </div>

                            <div class="info-wrap">
                                <div class="info-wrap-body">
                                    <i class="far fa-envelope"></i>
                                    <div>
                                        <p>Địa chỉ email</p>
                                        <p><?php echo $customer['email'] ?></p>
                                    </div>
                                </div>

                                <div>
                                    <a href="account/info/update-email" class="btn-update-info btn-account-action">Cập nhật</a>
                                </div>
                            </div>

                            <p class="info-title">Bảo mật</p>

                            <div class="info-wrap">
                                <div class="info-wrap-body">
                                    <i class="fas fa-lock"></i>
                                    <div>
                                        <p>Đổi mật khẩu</p>
                                    </div>
                                </div>
                                <div>
                                    <a href="account/info/change-password" class="btn-update-info btn-account-action">Cập nhật</a>
                                </div>
                            </div>

                            <p class="info-title">Liên kết mạng xã hội</p>
                            <div class="info-wrap">
                                <div class="info-wrap-body">
                                    <i class="fab fa-facebook"></i>
                                    <div>
                                        <p>Facebook</p>
                                    </div>
                                </div>
                                <div>
                                    <a href="index.php?controller=account&action=linkFacebook" class="btn-update-info btn-account-action">Liên kết</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<?php $this->view('partitions.frontend.footer') ?>