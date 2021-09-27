<?php $this->view('partitions.admin.header'); ?>

<div class="grid wide">
    <div class="row container">
        <div class="col l-4">

            <h1>Thêm thể loại</h1>
            <form action="index.php?controller=category&action=createCategory" method="POST" id="form-category"
                enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" id="name">
                </div>

                <button class="btn btn-create">CREATE</button>
            </form>
        </div>
        <div class="col l-8">
            <h1>Danh sách thể loại</h1>
            <table>
                <thead>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php 
              foreach($categories as $category){
            ?>
                    <tr>
                        <td><?php echo $category['category_id']?></td>
                        <td><?php echo $category['name']?></td>
                        <td><a
                                href="index.php?controller=category&action=deleteCategory&id=<?php echo $category['category_id']?>">delete</a>
                            <a
                                href="index.php?controller=category&action=directCategory&id=<?php echo $category['category_id']?>">
                                modify</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->view('partitions.admin.footer')?>