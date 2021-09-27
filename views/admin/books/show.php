<?php $this->view('partitions.admin.header'); ?>

<div class="grid wide">
    <div class="row container">
        <div class="col l-4">

            <h1>Thêm sách</h1>
            <form action="index.php?controller=book&action=createBook" method="POST" id="form-book"
                enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Category: </label>
                    <select name="category" id="" class="">
                        <?php
                   
                    foreach($categories as $category){
                ?>
                        <option value="<?php echo $category['name']?>"><?php echo $category['name']?></option>
                        <?php 
                    }
                ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="title" id="title">
                </div>

                <div class="form-group">
                    <label for="">Author</label>
                    <input type="text" name="author" id="author">
                </div>

                <div class="form-group">
                    <label for="">Price</label>
                    <input type="text" name="price" id="price">
                </div>

                <div class="form-group">
                    <label for="">Image</label>
                    <input type="file" name="image" id="image">
                </div>

                <div class="form-group">
                    <label for="">Description</label>
                    <!-- <textarea type="text" name="description" id="description"> -->
                    <textarea name="description" id="description" cols="50" rows="10"></textarea>
                </div>

                <button class="btn btn-create">CREATE</button>
            </form>
        </div>
        <div class="col l-8">
            <h1>Danh sách cuốn sách</h1>
            <table>
                <thead>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>create_date</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php 
              foreach($books as $book){
            ?>
                    <tr>
                        <td><?php echo $book['book_id']?></td>
                        <td><?php echo $book['title']?></td>
                        <td><?php echo $book['author']?></td>
                        <td><?php echo $book['price']?></td>
                        <td><img src="public/admin/uploads/<?php echo $book['image']?>" alt=""></td>
                        <td><?php echo $book['description']?></td>
                        <td><?php echo $book['create_date']?></td>
                        <td><a
                                href="index.php?controller=book&action=deleteBook&id=<?php echo $book['book_id']?>">delete</a>
                            <a href="index.php?controller=book&action=updateBook&id=<?php echo $book['book_id']?>">
                                update</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->view('partitions.admin.footer')?>