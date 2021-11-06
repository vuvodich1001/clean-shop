<?php $this->view('partitions.frontend.header') ?>
<div class="grid wide">
    <div class="row">
        <div class="col l-12">
            <div class="breadcrumb">
                <ul>
                    <li class="breadcrumb-item"><a href="index.php">Home/</a></li>
                    <li class="breadcrumb-item"><a href=""></a>Cart</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row container">
        <div class="col l-9">
            <div class="shopping-cart">
                <div class="shopping-cart-wrap">
                    <h2>Giỏ hàng của bạn</h2>
                    <!-- <button class="btn btn-delete-all active"><i class="far fa-trash-alt"></i> Tất cả</button> -->
                </div>
                <table>
                    <thead>
                        <th>No.</th>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th><i class="fas fa-trash-alt"></i></th>
                    </thead>

                    <tbody>
                        <?php
                        if (isset($carts)) {
                            foreach ($carts as $cart) {
                        ?>
                                <tr>
                                    <td class="cart-item-id" book-id="<?php echo $cart['book']['book_id'] ?>"><strong>#</strong><?php echo $cart['book']['book_id'] ?></td>
                                    <td><img src="./public/admin/uploads/<?php echo $cart['book']['main_image'] ?>" alt=""></td>
                                    <td><?php echo $cart['book']['title'] ?></td>
                                    <td class="cart-price"><?php echo number_format($cart['book']['price'], 0, '.', '.') ?>đ</td>
                                    <td class="cart-quantity-wrap"><button class="btn-minus"><i class="fas fa-minus"></i></button><span class="cart-quantity"><?php echo $cart['quantity'] ?>
                                        </span><button class="btn-add"><i class="fas fa-plus"></i></button></td>
                                    <td><button class="btn-delete"><i class="far fa-trash-alt"></i></button></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col l-3">
            <div class="shopping-cart-coupon">
                <p>Sử dụng phiếu quà tặng, giảm giá</p>
                <div class="coupon-wrap">
                    <input type="text" name="coupon-code" id="coupon-code" placeholder="Mã giảm giá">
                    <button class="btn-coupon"> Áp dụng</button>
                </div>
            </div>

            <div class="shopping-cart-checkout">
                <div class="checkout-wrap">
                    <span>Tạm tính</span>
                    <span class="checkout-temp">
                        <?php echo empty($total) ? 0 : number_format($total, 0, '.', '.'); ?>đ
                    </span>
                </div>
                <div class="checkout-wrap">
                    <span>Giảm giá</span>
                    <span class="checkout-coupon">
                        0đ
                    </span>
                </div>
            </div>

            <div class="shopping-cart-total">
                <div class="checkout-wrap">
                    <span>Tổng cộng</span>
                    <span class="checkout-total" value="<?php echo empty($total) ? 0 : $total ?>">
                        <?php echo empty($total) ? 0 : number_format($total, 0, '.', '.'); ?>đ
                    </span>
                </div>
            </div>
            <div class="shopping-cart-action">
                <?php if (isset($_SESSION['customer'])) {
                    echo '<a href="index.php?controller=cart&action=redirectCheckout" class="btn btn-buy active">Mua hàng</a>';
                } else {
                    echo '<a class="btn btn-login active">Đăng nhập ngay</a>';
                }
                ?>

            </div>
        </div>
    </div>
</div>
<?php $this->view('partitions.frontend.footer') ?>