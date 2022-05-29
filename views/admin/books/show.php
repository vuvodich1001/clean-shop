<?php $this->view('partitions.admin.header', ['roles' => $roles]); ?>

<div class="action">
    <h2>Product</h2>
    <button class="btn btn-create"><i class="fas fa-plus-circle"></i> Create Product</button>
</div>
<div class="content">
    <h1>List products</h1>
    <table>
        <thead>
            <th>#</th>
            <th>Title</th>
            <th>Price</th>
            <th>Image</th>
            <th>Description</th>
            <th>Product_date</th>
            <th>create_date</th>
            <th>Action</th>
        </thead>
        <tbody class="content-body">
            <?php
            foreach ($books as $book) {
            ?>
                <tr>
                    <td><?php echo $book['book_id'] ?></td>
                    <td><?php echo $book['title'] ?></td>
                    <td><?php echo number_format($book['price'], 0, '.', '.') ?>đ</td>
                    <td><img src="../public/admin/uploads/<?php echo explode(',', $book['main_image'])[0]; ?>" alt=""></td>
                    <td>
                        <div><?php echo $book['description'] ?></div>
                    </td>
                    <td><?php echo date('d/m/Y', strtotime($book['publish_date'])) ?></td>
                    <td><?php echo date('d/m/Y', strtotime($book['create_date'])) ?></td>
                    <td><a href="" class="btn-delete-book" book-id="<?php echo $book['book_id'] ?>"><i class="fas fa-trash-alt"></i></a>
                        <a href="" class="btn-update-book" book-id="<?php echo $book['book_id'] ?>"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div class="modal modal-overlay">
    <div class="modal-body modal-book">
        <h1>Product</h1>
        <form action="admin.php?controller=book&action=createBook" method="POST" id="form-book" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Category: </label>
                <select name="category" id="#category" class="">
                    <?php

                    foreach ($categories as $category) {
                    ?>
                        <option value="<?php echo $category['category_id'] ?>"><?php echo $category['name'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="title" id="title">
            </div>

            <div class="name-group book-info">
                <div class="form-group">
                    <label for="">Price</label>
                    <input type="text" name="price" id="price">
                </div>

                <div class="form-group">
                    <label for="">Product Date</label>
                    <input type="date" name="publish-date" id="publish-date">
                </div>

                <div class="form-group">
                    <label for="">Image</label>
                    <input type="file" name="images[]" id="image" multiple>
                </div>
            </div>

            <div class="form-group">
                <label for="">Description</label>
                <!-- <textarea type="text" name="description" id="description"> -->
                <textarea name="description" id="description" cols="50" rows="10"></textarea>
            </div>

            <button class="btn btn-create-book">Create</button>
            <button class="btn btn-cancel">Cancel</button>
        </form>
    </div>
</div>
<div class="pagination">

</div>
<?php $this->view('partitions.admin.footer') ?>