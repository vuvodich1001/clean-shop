<?php $this->view('partitions.admin.header') ?>
<div class="action">
    <h2>User</h2>
    <button class="btn btn-create"><i class="fas fa-plus-circle"></i> Create User</button>
</div>

<div class="content">
    <h1>List users</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="content-body">
            <?php
            foreach ($users as $user) {
            ?>
                <tr>
                    <td><?php echo $user['user_id'] ?></td>
                    <td><?php echo $user['username'] ?></td>
                    <td><?php echo $user['email'] ?></td>
                    <td><?php echo $user['password'] ?></td>
                    <td><a class="btn-delete-user" user-id="<?php echo $user['user_id'] ?>" href="#">
                            <i class="fas fa-trash-alt"></i></a>
                        <a class="btn-update-user" user-id="<?php echo $user['user_id'] ?>" href="#">
                            <i class="fas fa-edit"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div class="modal modal-overlay">
    <div class="modal-body">
        <h1>User</h1>
        <!-- <h1>Update user</h1> -->
        <form action="" method="POST" id="form-user" enctype="multipart/form-data" name="create">
            <div class="form-group">
                <label for="">Username</label>
                <input type="text" name="name" id="name">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="text" name="password" id="password" autocomplete="off">
            </div>
            <button class="btn btn-create-user">Create</button>
            <button class="btn btn-cancel">Cancel</button>
        </form>
    </div>
</div>
<div class="pagination">
    <ul>
        <li><a href=""><i class="fas fa-angle-left"></i></a></li>
        <li class="active"><a href="">1</a></li>
        <li><a href="">2</a></li>
        <li><a href=""><i class="fas fa-angle-right"></i></a></li>
    </ul>
</div>
<?php $this->view('partitions.admin.footer') ?>