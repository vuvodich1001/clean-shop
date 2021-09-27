<?php $this->view('partitions.frontend.header');?>
<div class="grid wide">
    <div class="row container">
        <div class="col l-3">
            <div class="book-detail-img">
                <img src="public/admin/uploads/<?php echo $book['image'];?>" alt="">
            </div>

            <div class="book-detail-share">
                <span>Chia sẻ: <a href="#"> <i class="fab fa-facebook"></i></a> <a href="#"><i
                            class="fab fa-instagram"></i></a> <a href="#"><i class="fab fa-twitter"></i></a> | Yêu
                    thích:
                    <i class="far fa-heart"></i></span>
            </div>
        </div>

        <div class="col l-9">
            <div class="book-detail-content">
                <p class="detail-author"><strong>Author: </strong><?php echo $book['author']; ?></p>
                <p class="detail-price"><strong>Price:</strong>
                    <?php echo number_format($book['price'], 0, '.', '.'); ?> VNĐ</p>
                <p class="detail-description"><strong>Description: </strong><?php echo $book['description']; ?></p>
                <div class="detail-quantity">
                    <strong> Quantity: </strong>
                    <button>+</button>
                    <span class="cur-quantity">1</span>
                    <button>-</button>
                </div>

                <button book-id="<?php echo $book['book_id']?>" class="btn btn-addtocart active">ADD TO
                    CART</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col l-12">
            <h2>Sản phẩm tương tự</h2>
        </div>
    </div>
    <div class="row book-slider">
        <?php foreach($bookRelates as $book) {?>
        <div class="col l-2">
            <a href="index.php?controller=book&action=bookDetail&id=<?php echo $book['book_id']?>" class="item">
                <img src="public/admin/uploads/<?php echo $book['image']?>" alt="">
                <div class="item-body">
                    <h4 class="item-title"><?php echo $book['title'] ?></h4>
                    <p class="item-price"><?php echo number_format($book['price'], 0, '.', '.')?> VNĐ</p>
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
                    <p class="item-author"><?php echo $book['author']?></p>
                </div>
            </a>
        </div>
        <?php } ?>
        <!-- <div class="slider-button">
            <span data-id="1" class="slider-button-left"><i class="fas fa-chevron-left"></i></span>
            <span data-id="2" class="slider-button-right"><i class="fas fa-chevron-right"></i></span>
        </div> -->
    </div>

    <div class="row comment">
        <div class="col l-12">
            <h2>Bình luận</h2>
        </div>
    </div>
</div>
<?php $this->view('partitions.frontend.footer');?>