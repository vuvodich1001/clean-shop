<?php $this->view('partitions.admin.header', ['roles' => $roles]); ?>

<div class="action">
    <h2>Voucher</h2>
    <button class="btn btn-create"><i class="fas fa-plus-circle"></i> Create Voucher</button>
</div>
<div class="content">
    <h1>List Vouchers</h1>
    <table>
        <thead>
            <th>#</th>
            <th>Percent</th>
            <th>Money</th>
            <th>Name</th>
            <th>Description</th>
            <th>Min</th>
            <th>Code</th>
            <th>Quantity</th>
            <th>Used</th>
            <th>Type</th>
            <th>Date</th>
            <th>Expire</th>
            <th>Enable</th>
            <th>Action</th>
        </thead>
        <tbody class="content-body">
            <?php
            foreach ($vouchers as $voucher) {
            ?>
                <tr>
                    <td><?php echo $voucher['discount_id'] ?></td>
                    <td><?php echo $voucher['discount_percent'] * 100 ?>%</td>
                    <td><?php echo number_format($voucher['discount_number'], 0, '.', '.') ?>đ</td>
                    <td><?php echo $voucher['name'] ?></td>
                    <td><?php echo $voucher['description'] ?></td>
                    <td><?php echo number_format($voucher['min_order'], 0, '.', '.') ?>đ</td>
                    <td><?php echo $voucher['code'] ?></td>
                    <td><?php echo $voucher['quantity'] ?></td>
                    <td><?php echo $voucher['current_use'] ?></td>
                    <td><?php echo $voucher['discount_type'] ?></td>
                    <td><?php echo $voucher['discount_date'] ?></td>
                    <td><?php echo $voucher['discount_expire'] ?></td>
                    <td><?php echo $voucher['enable'] ?></td>
                    <td><a href="" class="btn-delete-voucher" voucher-id="<?php echo $voucher['discount_id'] ?>"><i class="fas fa-trash-alt"></i></a>
                        <a href="" class="btn-update-voucher" voucher-id="<?php echo $voucher['discount_id'] ?>"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php $this->view('partitions.admin.footer') ?>