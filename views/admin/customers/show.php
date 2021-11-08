<?php $this->view('partitions.admin.header'); ?>

<div class="action">
    <h2>Customer</h2>
    <button class="btn btn-create"><i class="fas fa-plus-circle"></i> Create Customer</button>
</div>
<div class="content">
    <h1>List Customers</h1>
    <table>
        <thead>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Gender</th>
            <th>register_date</th>
            <th>Action</th>
        </thead>
        <tbody class="content-body">
            <?php
            foreach ($customers as $customer) {
            ?>
                <tr>
                    <td><?php echo $customer['customer_id'] ?></td>
                    <td><?php echo $customer['first_name'] . ' ' . $customer['last_name'] ?></td>
                    <td><?php echo $customer['email'] ?></td>
                    <td><?php echo $customer['phone'] ?></td>
                    <td><?php echo $customer['gender'] ?></td>
                    <td><?php echo date('d/m/Y', strtotime($customer['register_date'])); ?></td>
                    <td><a href="" class="btn-delete-customer" customer-id="<?php echo $customer['customer_id'] ?>"><i class="fas fa-trash-alt"></i></a>
                        <a href="" class="btn-update-customer" customer-id="<?php echo $customer['customer_id'] ?>"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php $this->view('partitions.admin.footer') ?>