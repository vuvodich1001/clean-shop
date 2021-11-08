<?php $this->view('partitions.admin.header'); ?>

<div class="action">
    <h2>Voucher</h2>
    <button class="btn btn-create"><i class="fas fa-plus-circle"></i> Create Voucher</button>
</div>
<div class="content">
    <h1>List Vouchers</h1>
    <table>
        <thead>
            <th>#</th>
            <th>Discount Percent</th>
            <th>Discount Money</th>
            <th>Name</th>
            <th>Description</th>
            <th>Min order</th>
            <th>Code</th>
            <th>Quantity</th>
            <th>Current use</th>
            <th>Discount type</th>
            <th>Discount date</th>
            <th>Discount expire</th>
            <th>Enable</th>
            <th>Action</th>
        </thead>
        <tbody class="content-body">
            <?php
            foreach ($vouchers as $voucher) {
            ?>
                <tr>
                    <td><?php echo $voucher['discount_id'] ?></td>
                    <td><?php echo $voucher['discount_percent'] ?></td>
                    <td><?php echo $voucher['discount_number'] ?></td>
                    <td><?php echo $voucher['name'] ?></td>
                    <td><?php echo $voucher['description'] ?></td>
                    <td><?php echo $voucher['min_order'] ?></td>
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