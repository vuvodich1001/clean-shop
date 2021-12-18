<?php $this->view('partitions.frontend.header') ?>
<div class="grid wide">
    <div class="row">
        <div class="col l-12">
            <div class="breadcrumb">
                <ul>
                    <li class="breadcrumb-item"><a href="">Home/</a></li>
                    <li class="breadcrumb-item">Orders</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row account-container">
        <div class="col l-3">
            <?php $this->view('frontend.accounts.sidebar', ['info' => $info]) ?>
        </div>
        <div class="col l-9">
            <h3>Đơn hàng của tôi</h3>
            <div class="account-body">
                <table class="order-table">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Ngày mua</th>
                            <th>Thanh toán</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái đơn hàng</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($orders as $order) : ?>
                            <tr>
                                <td class="order-code"><a href="account/order/<?php echo $order['order_id'] ?>">#<?php echo $order['order_id'] ?></a></td>
                                <td><?php $time = strtotime($order['order_date']);
                                    echo date('d/m/Y', $time); ?></td>
                                <td><?php echo $order['payment_method'] ?></td>
                                <td><?php echo number_format($order['total'], 0, '.', '.') ?> ₫</td>
                                <td><?php echo $order['status'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $this->view('partitions.frontend.footer') ?>