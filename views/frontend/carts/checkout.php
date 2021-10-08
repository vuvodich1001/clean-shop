<?php $this->view('partitions.frontend.header') ?>
<div class="grid wide">
    <div class="row checkout">
        <div class="col l-8">
            <a href="index.php?controller=cart" class="cart-back"><i class="fas fa-angle-left"></i> Back to cart</a>
            <h2>Địa chỉ giao hàng</h2>
            <div class="shipping-address">
                <div class="address-group">
                    <input type="radio" name="address" id="">
                    <span class="cus-name">Vu Nguyen</span>
                    <span class="cus-address">7/56/2, đường số 6, phường long trường, quận 9</span>
                    ,phone:<span>0123456789</span>
                </div>
                <div class="address-group">
                    <input type="radio" name="address" id="">
                    <span class="cus-name">Mai Ngon</span>
                    <span class="cus-address">số 7, đường 42, phường bình trưng đông, quận 2</span>
                    ,phone :<span>0123456789</span>
                </div>
                <div class="address-group">
                    <input type="radio" name="address" id="">
                    <span class="new-address">Thêm địa chỉ mới</span>
                    <form action="" id="address-form">
                        <div class="name-group">
                            <div class="form-group">
                                <label for="">Họ</label>
                                <input type="text" name="" id="" placeholder="Nguyen">
                            </div>
                            <div class="form-group">
                                <label for="">Tên</label>
                                <input type="text" name="" id="" placeholder="Vu">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Địa chỉ</label>
                            <input type="text" name="" id="" placeholder="7/56/2, duong so 6, phuong long truong">
                        </div>

                        <div class="cus-group">
                            <div class="form-group">
                                <label for="">Số điện thoại</label>
                                <input type="text" name="" id="" placeholder="0123456789">
                            </div>
                            <div class="form-group">
                                <label for="">Tỉnh/ Thành phố</label>
                                <input type="text" name="" id="" placeholder="TPHCM">
                            </div>
                            <div class="form-group">
                                <label for="">zipcode</label>
                                <input type="text" name="" id="" placeholder="1234">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <h2>Mã giảm giá</h2>
            <div class="order-discount">
                <input type="text" placeholder="Nhập mã giảm giá">
            </div>
            <h2>Phương thức thanh toán</h2>
            <div class="payment-method">
                <div class="payment-group">
                    <input type="radio" name="payment" id="">
                    Thanh toán qua ví điện tử - VNPAY
                </div>
                <div class="payment-group">
                    <input type="radio" name="payment" id="">
                    Thanh toán khi nhận hàng
                </div>
            </div>

            <button class="btn active">Đặt hàng</button>
        </div>

        <div class="col l-4">
            <div class="your-order">
                <p>Your Order</p>
                <div class="order-list">
                    <?php foreach ($carts as $cart) { ?>
                        <div class="order-item">
                            <img src="./public/admin/uploads/<?php echo $cart['book']['image'] ?>" alt="">
                            <div class="order-group">
                                <p class="order-title"><?php echo $cart['book']['title'] ?></p>
                                <p class="order-author"><?php echo  $cart['book']['author'] ?></p>
                                <span class="order-price"><?php echo number_format($cart['book']['price'], 0, '.', '.') ?>đ</span> x <span class="order-quantity">0<?php echo $cart['quantity'] ?></span>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="order-ship">
                    <div class="delivery">
                        <span>Delivery</span>
                        <span class="delivery-cost">
                            <?php echo number_format($total * 0.05, 0, '.', '.') ?>đ
                        </span>
                    </div>

                    <div class="discount">
                        <span>Discount</span>
                        <span class="discount-cost">
                            -<?php echo number_format(20000, 0, '.', '.') ?>đ
                        </span>
                    </div>
                </div>

                <div class="order-total">
                    <span>Total</span>
                    <span class="order-total"><?php echo number_format($total, 0, '.', '.'); ?>đ</span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->view('partitions.frontend.footer') ?>