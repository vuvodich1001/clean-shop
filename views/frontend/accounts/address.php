<?php $this->view('partitions.frontend.header') ?>
<div class="grid wide">
    <div class="row">
        <div class="col l-12">
            <div class="breadcrumb">
                <ul>
                    <li class="breadcrumb-item"><a href="">Home/</a></li>
                    <li class="breadcrumb-item">Address</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row account-container">
        <div class="col l-3">
            <?php $this->view('frontend.accounts.sidebar', ['info' => $info]) ?>
        </div>
        <div class="col l-9">
            <h3>Sổ địa chỉ</h3>
            <div class="account-body">
                <?php if (empty($address)) {
                } else {
                    foreach ($address as $address) {
                        $userName = ucfirst($address['first_name']) . ' ' . ucfirst($address['last_name']);
                        $shippingAddress = $address['line1'] . ', ' . $address['line2'] . ', ' . $address['city'];
                ?>
                        <div class="address-group">
                            <input type="radio" name="address" id="<?php echo $address['address_id'] ?>">
                            <label for="<?php echo $address['address_id'] ?>">
                                <span class="cus-name"><?php echo $userName ?></span>
                                <span class="cus-address"><?php echo $shippingAddress ?></span>, phone :<span><?php echo $address['phone'] ?></span>
                            </label>
                            <button class="btn-delete-address" address-id="<?php echo $address['address_id'] ?>"><i class="fas fa-times"></i></button>
                        </div>
                <?php }
                } ?>
                <div class="address-group">
                    <input type="radio" name="address" class="new-address" id="new-address-id">
                    <label for="new-address-id"><span class="cus-name">Thêm địa chỉ mới</span></label>
                    <div class="address-button">
                        <i class="address-button-left fas fa-chevron-left"></i>
                        <i class="address-button-down fas fa-chevron-down"></i>
                    </div>
                    <form action="account/createNewAddress" id="address-form" method="POST">
                        <div class="name-group">
                            <div class="form-group">
                                <label for="">Họ</label>
                                <input type="text" name="firstname" id="firstname" placeholder="Nguyen">
                            </div>
                            <div class="form-group">
                                <label for="">Tên</label>
                                <input type="text" name="lastname" id="lastname" placeholder="Vu">
                            </div>
                        </div>

                        <div class="name-group">
                            <div class="form-group">
                                <label for="">Địa chỉ</label>
                                <input type="text" name="address" id="address" placeholder="7/56/2, duong so 6">
                            </div>

                            <div class="form-group">
                                <label for="">Xã/ Phường</label>
                                <input type="text" name="ward" id="ward" placeholder="Long truong">
                            </div>
                        </div>
                        <div class="name-group">
                            <div class="form-group">
                                <label for="">Quận/ Huyện</label>
                                <input type="text" name="district" id="district" placeholder="TPHCM">
                            </div>
                            <div class="form-group">
                                <label for="">Tỉnh/ Thành phố</label>
                                <input type="text" name="city" id="city" placeholder="TPHCM">
                            </div>
                        </div>
                        <div class="name-group">
                            <div class="form-group">
                                <label for="">Số điện thoại</label>
                                <input type="text" name="phone" id="phone" placeholder="0123456789">
                            </div>
                            <div class="form-group">
                                <label for="">zipcode</label>
                                <input type="text" name="zipcode" id="zipcode" placeholder="1234">
                            </div>
                        </div>

                        <button class="btn active address-form-button">Tạo mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php $this->view('partitions.frontend.footer') ?>