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
            <th>Type</th>
            <th>Date</th>
            <th>Expire</th>
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
                    <td><?php echo $voucher['discount_type'] ?></td>
                    <td><?php echo $voucher['discount_date'] ?></td>
                    <td><?php echo $voucher['discount_expire'] ?></td>
                    <td><a href="" class="btn-delete-voucher" voucher-id="<?php echo $voucher['discount_id'] ?>"><i class="fas fa-trash-alt"></i></a>
                        <a href="" class="btn-update-voucher" voucher-id="<?php echo $voucher['discount_id'] ?>"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div class="modal modal-overlay">
    <div class="modal-body">
        <h1>Voucher</h1>
        <form action="" method="POST" id="form-voucher" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="name" id="name">
            </div>
            <div class="form-group">
                <label for="">Description</label>
                <input type="text" name="description" id="description">
            </div>
            <div class="form-group">
                <label for="">Type: </label>
                <select name="type" id="type">
                    <option value="money">Money</option>
                    <option value="percent">Percent</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Cost</label>
                <input type="text" name="cost" id="cost">
            </div>
            <div class="name-group">
                <div class="form-group">
                    <label for="">Min</label>
                    <input type="text" name="min" id="min">
                </div>
                <div class="form-group">
                    <label for="" class="code" style="cursor:pointer"><i class="fas fa-sync-alt"></i></label>
                    <input type="text" name="code" id="code">
                </div>
            </div>

            <div class="form-group">
                <label for="">Date</label>
                <input type="datetime-local" name="date" id="date">
            </div>
            <div class="form-group">
                <label for="">Expire Date</label>
                <input type="datetime-local" name="date-expire" id="date-expire">
            </div>
            <button class="btn btn-create-voucher">CREATE</button>
            <button class="btn btn-cancel">Cancel</button>
        </form>
    </div>
</div>
<?php $this->view('partitions.admin.footer') ?>