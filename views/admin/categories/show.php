<?php $this->view('partitions.admin.header', ['roles' => $roles]); ?>
<div class="action">
    <h2>Category</h2>
    <button class="btn btn-create"><i class="fas fa-plus-circle"></i> Create Category</button>
</div>
<div class="content">
    <h1>List categories</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="content-body">
            <?php
            foreach ($categories as $category) {
            ?>
                <tr>
                    <td><?php echo $category['category_id'] ?></td>
                    <td><?php echo $category['name'] ?></td>
                    <td><a href="" class="btn-delete-category" category-id="<?php echo $category['category_id'] ?>">
                            <i class="fas fa-trash-alt"></i></a>
                        <a href="" class="btn-update-category" category-id="<?php echo $category['category_id'] ?>">
                            <i class="fas fa-edit"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div class="modal modal-overlay">
    <div class="modal-body">
        <h1>Category</h1>
        <form action="" method="POST" id="form-category" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="name" id="name">
            </div>

            <button class="btn btn-create-category">CREATE</button>
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