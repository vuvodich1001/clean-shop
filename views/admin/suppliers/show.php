<?php $this->view('partitions.admin.header', ['roles' => $roles]); ?>

<div class="action">
    <h2>Supplier</h2>
    <button class="btn btn-create"><i class="fas fa-plus-circle"></i> Create Supplier</button>
</div>
<div class="content">
    <h1>List Suppliers</h1>
    <table>
        <thead>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Action</th>
        </thead>
        <tbody class="content-body">
            <?php
            foreach ($suppliers as $supplier) {
            ?>
                <tr>
                    <td><?php echo $supplier['supplier_id'] ?></td>
                    <td><?php echo $supplier['name'] ?></td>
                    <td><?php echo $supplier['email'] ?></td>
                    <td><?php echo $supplier['address'] ?></td>
                    <td><?php echo $supplier['phone'] ?></td>
                    <td><a href="" class="btn-delete-supplier" supplier-id="<?php echo $supplier['supplier_id'] ?>"><i class="fas fa-trash-alt"></i></a>
                        <a href="" class="btn-update-supplier" supplier-id="<?php echo $supplier['supplier_id'] ?>"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php $this->view('partitions.admin.footer') ?>