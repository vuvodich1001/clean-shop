<?php $this->view('partitions.frontend.header') ?>
<div class="grid wide">
    <div class="row account-container">
        <div class="col l-3">
            <?php $this->view('frontend.accounts.sidebar') ?>
        </div>
        <div class="col l-9">
            <h3>Nhận xét sản phẩm đã mua</h3>
            <div class="account-body">
                <div class="row">
                    <?php foreach ($books as $book) : ?>
                        <div class="col l-3">
                            <a href="index.php?controller=book&action=bookDetail&id=<?php echo $book['book_id'] ?>" class="item">
                                <img src="public/admin/uploads/<?php echo $book['main_image'] ?>" alt="image">
                                <div class="item-body">
                                    <h4 class="item-title"><?php echo $book['title'] ?></h4>
                                    <p class="item-price"><?php echo number_format($book['price'], 0, '.', '.') ?> VNĐ</p>
                                    <div class="item-rate">
                                        <div class="item-rate__heart">
                                            <i class="heart-icon far fa-heart"></i>
                                            <i class="heart-icon-fill fas fa-heart"></i>
                                        </div>
                                        <div class="item-rate__star">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                    </div>
                                    <p class="item-author"><?php echo $book['author'] ?></p>
                                </div>
                            </a>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->view('partitions.frontend.footer') ?>