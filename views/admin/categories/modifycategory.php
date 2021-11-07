<?php $this->view('partitions.admin.header'); ?>

<div class="grid wide">
    <div class="row container">
        <div class="content">
            <h1>Sửa thể loại</h1>
            <form action="admin.php?controller=category&action=updateCategory&id=<?php echo $category['category_id'] ?>" method="POST" id="form-category" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" value="<?php echo $category['name'] ?>" id="name">
                </div>

                <button class="btn btn-create">Update</button>
            </form>
        </div>
    </div>
</div>

<?php $this->view('partitions.admin.footer') ?>