<?php $this->view('partitions.frontend.header') ?>
<div class="grid wide">
    <div class="row account-container">
        <div class="col l-3">
            <?php $this->view('frontend.accounts.sidebar', ['info' => $info]) ?>
        </div>
        <div class="col l-9">
            <div class="order-detail">
                <div class="detail-head">
                    <p class="detail-title">Chi tiết đơn hàng #1 - <strong><?php echo $order['status'] ?></strong></p>
                    <span class="order-date">Ngày đặt hàng: <?php echo $order['order_date'] ?></span>
                </div>

                <div class="detail-info">
                    <div class="row sm-gutter">
                        <div class="col l-4">
                            <p class="detail-title">Địa chỉ người nhận</p>
                            <div class="detail-group">
                                <h4><?php echo ucfirst($order['first_name']) . ' ' . ucfirst($order['last_name']) ?></h4>
                                <p>Địa chỉ: <?php echo $order['line1'] . ', ' . $order['line2'] . ', ' . $order['city'] . ', ' . $order['country'] ?></p>
                                <p>Điện thoại: <?php echo $order['phone'] ?></p>
                            </div>
                        </div>
                        <div class="col l-4">
                            <p class="detail-title">Hình thức giao hàng</p>
                            <div class="detail-group">
                                <p>Giao hàng tận nơi bởi bookstore</p>
                                <p>Phí vận chuyển: <?php echo number_format($order['shipping_fee'], 0, '.', '.') ?>đ</p>
                            </div>
                        </div>
                        <div class="col l-4">
                            <p class="detail-title">Hình thức thanh toán</p>
                            <div class="detail-group">
                                <?php
                                if ($order['payment_method'] == 'COD') {
                                    echo '<p>Thanh toán tiền mặt khi nhận hàng</p>';
                                } else {
                                    echo '<p>Đã thanh toán qua ví điện tử Paypal</p>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="detail-body">
                    <table class="order-table">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tạm tính</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($orderDetails as $orderDetail) : ?>
                                <tr>
                                    <td class="detail-img"><img src="./public/admin/uploads/<?php echo $orderDetail['main_image'] ?>" alt="">
                                        <div class="detail-action">
                                            <p>Sách <?php echo $orderDetail['title'] ?></p>
                                            <button class="btn-account-action btn-review" book-id="<?php echo $orderDetail['book_id'] ?>">Viết nhận xét</button>
                                            <a href="index.php?controller=book&action=bookDetail&id=<?php echo $orderDetail['book_id'] ?>" class="btn-account-action">Mua lại</a>
                                        </div>
                                    </td>
                                    <td><?php echo number_format($orderDetail['price'], 0, '.', '.') ?>đ</td>
                                    <td><?php echo $orderDetail['quantity'] ?></td>
                                    <td><?php echo number_format($orderDetail['subtotal'], 0, '.', '.') ?>đ</td>
                                </tr>
                            <?php endforeach ?>
                            <tr class="order-fee">
                                <td colspan="3" class="order-fee-title">Tạm tính</td>
                                <td><?php echo number_format($order['subtotal'], 0, '.', '.') ?>đ</td>
                            </tr>
                            <tr class="order-fee">
                                <td colspan="3" class="order-fee-title">Phí vận chuyển</td>
                                <td><?php echo number_format($order['shipping_fee'], 0, '.', '.') ?>đ</td>
                            </tr>
                            <tr class="order-fee">
                                <td colspan="3" class="order-fee-title">Giảm giá</td>
                                <td><?php echo number_format($order['discount'], 0, '.', '.') ?>đ</td>
                            </tr>
                            <tr class="order-fee">
                                <td colspan="3" class="order-fee-title">Tổng cộng</td>
                                <td class="order-fee-total"><?php echo number_format($order['total'], 0, '.', '.') ?>đ</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="detail-footer">
                    <table class="order-fee">

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->view('partitions.frontend.footer') ?>