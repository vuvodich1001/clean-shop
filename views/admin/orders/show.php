<?php $this->view('partitions.admin.header', ['roles' => $roles]); ?>

<div class="action">
    <h2>Order</h2>
    <button class="btn btn-create"><i class="fas fa-plus-circle"></i> Create Order</button>
</div>
<div class="content">
    <h1>List Orders</h1>
    <table>
        <thead>
            <th>#</th>
            <th>Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Payment method</th>
            <th>Total</th>
            <th>Status</th>
            <th>Order_date</th>
            <th>Action</th>
        </thead>
        <tbody class="content-body">
            <?php
            foreach ($orders as $order) {
            ?>
                <tr>
                    <td><?php echo $order['order_id'] ?></td>
                    <td><?php echo $order['first_name'] . ' ' . $order['last_name'] ?></td>
                    <td><?php echo $order['line1'] . ', ' . $order['line2'] . ', ' . $order['city'] ?></td>
                    <td><?php echo $order['phone'] ?></td>
                    <td><?php echo $order['payment_method'] ?></td>
                    <td><?php echo number_format($order['total'], 0, '.', '.') ?>đ</td>
                    <td class="order-status-<?php echo $order['order_id'] ?>"><?php echo $order['status'] ?></td>
                    <td><?php echo date('d/m/Y', strtotime($order['order_date'])); ?></td>
                    <td>
                        <a href="" class="btn-detail-order" order-id="<?php echo $order['order_id'] ?>"><i class="fas fa-info-circle"></i></a>
                        <?php if ($order['status'] == 'Đang xử lí' || $order['status'] == 'Đã thanh toán') : ?>
                            <a href="" class="btn-success-status" order-id="<?php echo $order['order_id'] ?>"><i class="far fa-check-circle"></i></a>
                            <a href="" class="btn-shipping-status" order-id="<?php echo $order['order_id'] ?>"><i class="fas fa-shipping-fast"></i></a>
                        <?php elseif ($order['status'] == 'Đang giao hàng') : ?>
                            <a href="" class="btn-success-status" order-id="<?php echo $order['order_id'] ?>"><i class="far fa-check-circle"></i></a>
                        <?php endif ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div class="modal modal-overlay">
    <div class="modal-body modal-book">
        <h2>Order Detail</h2>
        <!-- <h1>Update user</h1> -->
        <table class="detail-table">
            <thead>
                <th>Title</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
            </thead>
            <tbody class="detail-body">

            </tbody>
        </table>
        <button class="btn btn-cancel">Close</button>
    </div>
</div>
<?php $this->view('partitions.admin.footer') ?>