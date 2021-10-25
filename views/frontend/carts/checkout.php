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
                                <label for="">Tỉnh/ Thành phố</label>
                                <input type="text" name="" id="" placeholder="TPHCM">
                            </div>
                            <div class="form-group">
                                <label for="">Số điện thoại</label>
                                <input type="text" name="" id="" placeholder="0123456789">
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
                    Thanh toán qua Paypal
                    <div id="paypal-button">

                    </div>
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
                <p>Đơn hàng của bạn</p>
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
                        <span>Vận chuyển</span>
                        <span class="delivery-cost">
                            <?php echo number_format($total * 0.05, 0, '.', '.') ?>đ
                        </span>
                    </div>

                    <div class="discount">
                        <span>Giảm giá</span>
                        <span class="discount-cost">
                            -<?php echo number_format(20000, 0, '.', '.') ?>đ
                        </span>
                    </div>
                </div>

                <div class="order-total">
                    <span>Tổng</span>
                    <span class="order-total"><?php echo number_format($total, 0, '.', '.'); ?>đ</span>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
    <?php if ($total > 0) : ?>
        paypal.Button.render({
                // Configure environment
                env: 'sandbox',
                client: {
                    sandbox: 'AR0u7adFeGxIi6UCxILLq1fVwPccRQtcwY2NmGbCZzGoA1Z7-oz1zgBw_nO-N_rSwo1_9Wq9OJR4WP03',
                    // production: 'demo_production_client_id'
                },
                // Customize button (optional)
                locale: 'en_VN',
                style: {
                    size: 'medium',
                    color: 'gold',
                    shape: 'pill',
                    label: 'pay'
                },

                // Enable Pay Now checkout flow (optional)
                commit: true,
                // Set up a payment
                payment: function(data, actions) {
                    return actions.payment.create({
                        transactions: [{
                            amount: {
                                total: <?php echo $total * 0.000044; ?>,
                                currency: 'USD',
                                details: {
                                    subtotal: <?php echo $total * 0.000044; ?>,
                                    tax: '0.00',
                                    shipping: '0.00',
                                    handling_fee: '0.00',
                                    shipping_discount: '0.00',
                                    insurance: '0.00'
                                }
                            },
                            description: 'The payment transaction description.',
                            custom: '90048630024435',
                            // insert unique invoice
                            invoice_number: '12345',
                            // payer: {
                            //     payment_method: 'paypal', 
                            //     status: 'VERIFIED',
                            //     payer_info: {
                            //         email: 'test@gmail.com',

                            //     }
                            // },
                            payment_options: {
                                allowed_payment_method: 'INSTANT_FUNDING_SOURCE'
                            },
                            item_list: {
                                items: [
                                    <?php
                                    foreach ($_SESSION['cart'] as $cart) {
                                        $name = $cart['book']['title'];
                                        $description = $cart['book']['author'];
                                        $quantity = $cart['quantity'];
                                        $price = $cart['book']['price'] * 0.000044;
                                        echo "{
                                            name: '$name',
                                            description: '$description',
                                            quantity: $quantity,
                                            price: $price,
                                            currency: 'USD'
                                        },";
                                    }
                                    ?>
                                ],
                                shipping_address: {
                                    recipient_name: 'vu nguyen',
                                    line1: '7/56/2, long truong',
                                    line2: 'thu duc',
                                    city: 'hcmc',
                                    country_code: 'VN',
                                    postal_code: '12345',
                                    phone: '0123456789',

                                }
                            }
                        }],
                        note_to_payer: `Quy đổi: 1 VND = 0.000044 USD, Liên hệ với chúng tôi nếu bạn có bất kì thắc mắc nào!`,
                    });
                },
                // Execute the payment
                onAuthorize: function(data, actions) {
                    return actions.payment.execute().then(function() {
                        // Show a confirmation message to the buyer
                        window.alert('Cảm ơn bạn đã mua hàng!');
                    });
                }
            },
            '#paypal-button');
    <?php endif ?>
</script>
<?php $this->view('partitions.frontend.footer') ?>