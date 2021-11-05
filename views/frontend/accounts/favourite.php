<?php $this->view('partitions.frontend.header') ?>
<div class="grid wide">
    <div class="row account-container">
        <div class="col l-3">
            <?php $this->view('frontend.accounts.sidebar', ['info' => $info]) ?>
        </div>
        <div class="col l-9">
            <h3>Sản phẩm yêu thích</h3>
            <div class="account-body">
                <div class="row">
                    <?php foreach ($books as $book) : ?>
                        <div class="col l-12">
                            <a href="index.php?controller=book&action=bookDetail&id=<?php echo $book['book_id'] ?>" class="favourite-item">
                                <div class="favourite-item-body">
                                    <img src="public/admin/uploads/<?php echo $book['main_image'] ?>" alt="image">
                                    <div class="favourite-item-rate">
                                        <h4 class="favourite-item-title"><?php echo $book['title'] ?></h4>
                                        <div class="favourite-item-rate__star">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <span> (3 nhận xét)</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- <p class="favourite-item-author"><?php echo $book['author'] ?></p> -->
                                <p class="favourite-item-price"><?php echo number_format($book['price'], 0, '.', '.') ?>đ</p>
                                <p class="favourite-item-delete" book-id="<?php echo $book['book_id'] ?>"><i class="fas fa-times"></i></p>
                            </a>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->view('partitions.frontend.footer') ?>