<?php $this->view('partitions.frontend.header') ?>
<div class="grid wide">
    <div class="row">
        <div class="col l-12">
            <div class="breadcrumb">
                <ul>
                    <li class="breadcrumb-item"><a href="">Home/</a></li>
                    <li class="breadcrumb-item">Review</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row account-container">
        <div class="col l-3">
            <?php $this->view('frontend.accounts.sidebar', ['info' => $info]) ?>
        </div>
        <div class="col l-9">
            <h3>Nhận xét sản phẩm đã mua</h3>
            <div class="account-body no-minwidth">
                <div class="row">
                    <?php foreach ($books as $book) : ?>
                        <div class="col l-12">
                            <a href="index.php?controller=book&action=bookDetail&id=<?php echo $book['book_id'] ?>" class="favourite-item">
                                <div class="favourite-item-body">
                                    <img src="public/admin/uploads/<?php echo explode(',', $book['main_image'])[0] ?>" alt="image">
                                    <div class="favourite-item-rate">
                                        <h4 class="favourite-item-title"><?php echo $book['title'] ?></h4>
                                        <div class="favourite-item-rate__star">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <span> (<?php echo empty($book['review_quantity']) ? 0 : $book['review_quantity'] ?> nhận xét)</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- <p class="favourite-item-author"><?php echo $book['author'] ?></p> -->
                                <p class="favourite-item-price"><?php echo number_format($book['price'], 0, '.', '.') ?> ₫</p>
                                <!-- <p class="favourite-item-delete" book-id="<?php echo $book['book_id'] ?>"><i class="fas fa-times"></i></p> -->
                                <button class="btn-account-action btn-review" book-id="<?php echo $book['book_id'] ?>">Viết nhận xét</button>
                            </a>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->view('partitions.frontend.footer') ?>