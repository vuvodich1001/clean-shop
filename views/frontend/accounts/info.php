<?php $this->view('partitions.frontend.header') ?>
<div class="grid wide">
    <div class="row account-container">
        <div class="col l-3">
            <?php $this->view('frontend.accounts.sidebar') ?>
        </div>
        <div class="col l-9">
            <div class="account-info-person">
                <h3>Thông tin tài khoản</h3>
                <div class="row">
                    <div class="col l-7">
                        <form action="" id="form-info">
                            <p class="info-title">Thông tin cá nhân</p>
                            <div class="form-group-info">
                                <label for="">Họ và tên</label>
                                <input type="text" name="" id="" value="Nguyễn Công Vũ">
                            </div>
                            <div class="form-group-info">
                                <label for="">Nickname</label>
                                <input type="text" name="" id="" value="vuvodich1001">
                            </div>
                            <div class="form-group-info">
                                <label for="">Ngày tháng năm sinh</label>
                                <input type="text" name="" id="" value="01-12-2002" onfocus="this.type = 'date'">
                            </div>
                            <div class="form-group-info">
                                <label for="">Giới tính</label>
                                <input type="radio" name="gender" id="" value="nam" checked>
                                <span>Nam</span>
                                <input type="radio" name="gender" id="" value="nu">
                                <span>Nữ</span>
                            </div>
                            <div class="form-group-button">
                                <button class="btn active">Lưu thay đổi</button>
                            </div>
                    </div>
                    <div class="col l-5">
                        <div class="more-info">
                            <p class="info-title">Số điện thoại và email</p>
                            <div class="phone-info">
                                <div class="phone-wrap">
                                    <i class="fas fa-phone-alt"></i>
                                    <div>
                                        <p>Số điện thoại</p>
                                        <p>0123456789</p>
                                    </div>
                                </div>

                                <div>
                                    <button class="btn-update-info">Cập nhật</button>
                                </div>
                            </div>

                            <div class="email-info">
                                <div class="email-wrap">
                                    <i class="far fa-envelope"></i>
                                    <div>
                                        <p>Địa chỉ email</p>
                                        <p>vunguyen.311001@gmail.com</p>
                                    </div>
                                </div>

                                <div>
                                    <button class="btn-update-info">Cập nhật</button>
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