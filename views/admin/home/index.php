<?php $this->view('partitions.admin.header', ['roles' => $roles, 'notifications' => $notifications]) ?>
<div class="card-box">
    <a href="customer" class="card">
        <div class="card-item">
            <div class="number"><?= $statistics['totalCustomer'] ?></div>
            <p class="card-number">Customers</p>
        </div>
        <i class="card-icon far fa-user"></i>
    </a>
    <a href="order" class="card">
        <div class="card-item">
            <div class="number"><?= $statistics['totalOrder'] ?></div>
            <p class="card-number">Sale orders</p>
        </div>
        <i class="card-icon fa fa-shopping-cart"></i>
    </a>
    <a href="review" class="card">
        <div class="card-item">
            <div class="number"><?= $statistics['totalReview'] ?></div>
            <p class="card-number">Comments</p>
        </div>
        <i class="card-icon far fa-comment"></i>
    </a>
    <a href="order" class="card">
        <div class="card-item">
            <div class="number"><?= number_format($statistics['revenue'], 0, '.', '.') ?>đ</div>
            <p class="card-number">Revenue</p>
        </div>
        <i class="card-icon fas fa-wallet"></i>
    </a>
</div>

<div class="content">
    <div class="table-control">
        <div class="action">
            <h2>Recent Orders</h2>
            <a href="order" class="btn">View All</a>
        </div>
        <table>
            <thead>
                <th>#</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Payment method</th>
                <th>Total</th>
                <th>Status</th>
                <th>Order date</th>
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
                        <td class="<?= $textColors[$order['status']] ?> order-status-<?php echo $order['order_id'] ?>"><?php echo $order['status'] ?></td>
                        <td><?php echo date('d/m/Y', strtotime($order['order_date'])); ?></td>
                        <td>
                            <a href="" class="btn-detail-order" order-id="<?php echo $order['order_id'] ?>"><i class="card-icon fas fa-info-circle"></i></a>
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
    <div class="table-control">
        <div class="action">
            <h2>Recent Reviews</h2>
            <a href="review" class="btn">View All</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Book</th>
                    <th>Headline</th>
                    <th>Rating</th>
                    <th>Review time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="content-body">
                <?php
                foreach ($reviews as $review) {
                ?>
                    <tr>
                        <td><?php echo $review['customer_id'] ?></td>
                        <td><?php echo $review['book_id'] ?></td>
                        <td><?php echo $review['headline'] ?></td>
                        <td><?php echo $review['rating'] ?> <i class="far fa-star"></i></td>
                        <td><?php echo date('d/m/Y', strtotime($review['review_time'])) ?></td>
                        <td>
                            <a href="" class="btn-delete-review" review-id="<?php echo $review['review_id'] ?>"><i class="fas fa-trash-alt"></i></a>
                            <a href="" class="btn-update-review" review-id="<?php echo $review['review_id'] ?>"><i class="fas fa-edit"></i></a>
                            <a href="" class="btn-change-status" review-id="<?php echo $review['review_id'] ?>"><i class="far fa-check-circle"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<div class="modal modal-overlay">
    <div class="modal-body modal-book">
        <h2>Order Detail</h2>
        <!-- <h1>Update user</h1> -->
        <table class="detail-table">
            <thead>
                <th>Title</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
            </thead>
            <tbody class="detail-body">

            </tbody>
        </table>
        <button class="btn btn-cancel btn-close-detail">Close</button>
    </div>
</div>
<?php $this->view('partitions.admin.footer') ?>