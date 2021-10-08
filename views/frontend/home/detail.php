<?php $this->view('partitions.frontend.header'); ?>

<div class="grid wide">
    <div class="row container container-detail">
        <div class="col l-3">
            <div class="book-detail-img">
                <img src="public/admin/uploads/<?php echo $book['image']; ?>" alt="">
            </div>

            <div class="book-detail-share">
                <span>Chia sẻ: <a href="#"> <i class="fab fa-facebook"></i></a> <a href="#"><i class="fab fa-instagram"></i></a> <a href="#"><i class="fab fa-twitter"></i></a> | Yêu
                    thích:
                    <i class="far fa-heart"></i></span>
            </div>
        </div>

        <div class="col l-9">
            <div class="book-detail-content">
                <p class="detail-author"><strong>Tác giả: </strong><?php echo $book['author']; ?></p>
                <p class="detail-price"><strong>Giá:</strong>
                    <?php echo number_format($book['price'], 0, '.', '.'); ?>đ</p>
                <!-- <p class="detail-description"><strong>Description: </strong><?php echo $book['description']; ?></p> -->
                <div class="detail-quantity">
                    <strong> Số lượng: </strong>
                    <button>+</button>
                    <span class="cur-quantity">1</span>
                    <button>-</button>
                </div>

                <button book-id="<?php echo $book['book_id'] ?>" class="btn btn-addtocart active"><i class="fas fa-plus-circle"></i> Thêm vào giỏ hàng</button>
            </div>
        </div>

        <div class="col l-12 book-description">
            <h2>Mô tả sản phẩm</h2>
            <p><?php echo $book['description'] ?></p>
        </div>
    </div>
    <div class="row relate-title">
        <div class="col l-12">
            <h2>Sản phẩm tương tự</h2>
        </div>
    </div>
    <div class="row book-slider">
        <?php foreach ($bookRelates as $book) { ?>
            <div class="col l-2">
                <a href="index.php?controller=book&action=bookDetail&id=<?php echo $book['book_id'] ?>" class="item">
                    <img src="public/admin/uploads/<?php echo $book['image'] ?>" alt="">
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
        <?php } ?>
        <!-- <div class="slider-button">
            <span data-id="1" class="slider-button-left"><i class="fas fa-chevron-left"></i></span>
            <span data-id="2" class="slider-button-right"><i class="fas fa-chevron-right"></i></span>
        </div> -->
    </div>

    <div class="row comment">
        <div class="col l-12">
            <h2>Đánh Giá - Nhận Xét Từ Khách Hàng</h2>
            <div class="row comment-body">
                <div class="col l-4">
                    <div class="rating-summary">
                        <div class="rating-summary-head">
                            <h1>4.7</h1>
                            <div class="rating-summary-total">
                                <div class="rating-star">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <p>100 nhận xét</p>
                            </div>
                        </div>
                        <div class="rating-summary-body">
                            <div class="rating-summary-group">
                                <div class="rating-star">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <input type="range">
                                <span>100</span>
                            </div>
                            <div class="rating-summary-group">
                                <div class="rating-star">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <input type="range">
                                <span>100</span>
                            </div>
                            <div class="rating-summary-group">
                                <div class="rating-star">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <input type="range">
                                <span>100</span>
                            </div>
                            <div class="rating-summary-group">
                                <div class="rating-star">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <input type="range">
                                <span>100</span>
                            </div>
                            <div class="rating-summary-group">
                                <div class="rating-star">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <input type="range">
                                <span>100</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col l-8">
                    <span>Lọc xem theo: </span>
                    <button class="btn-filter btn-filter-new">Mới nhất</button>
                    <button class="btn-filter btn-filter-image">Có hình ảnh</button>
                    <button class="btn-filter btn-filter-buy">Đã mua hàng</button>
                    <button class="btn-filter btn-filter-star">5 <i class="fas fa-star"></i></button>
                    <button class="btn-filter btn-filter-star">4 <i class="fas fa-star"></i></button>
                    <button class="btn-filter btn-filter-star">3 <i class="fas fa-star"></i></button>
                    <button class="btn-filter btn-filter-star">2 <i class="fas fa-star"></i></button>
                    <button class="btn-filter btn-filter-star">1 <i class="fas fa-star"></i></button>
                </div>

            </div>

            <div class="row comment-body">
                <div class="col l-4">
                    <div class="comment-detail-head">
                        <div class="customer-image">NA</div>
                        <div class="customer-name">
                            <h4>Nguyễn Văn A</h4>
                            <p>Đã tham gia 1 năm trước</p>
                        </div>
                    </div>
                    <div class="comment-detail-body">
                        <p><i class="far fa-comment-alt"></i> Đã viết: <span class="number-comment">2</span><span> đánh giá</span></p>
                        <p><i class="far fa-thumbs-up"></i> Đã nhận: <span class="number-like">3</span><span> lượt cảm ơn</span></p>
                    </div>
                </div>
                <div class="col l-8">
                    <div class="comment-detail-content">
                        <div class="content-head">
                            <div class="rating-star">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="content-message">Cực kì hài lòng</span>
                        </div>
                        <p class="content-verify"><i class="fas fa-check-circle"></i> Đã mua hàng</p>
                        <p class="content-comment">
                            Tôi rất thích dùng sản phẩm này! Sẽ ủng hộ shop lần sau.
                        </p>
                        <p class="content-date">Đánh giá vào <span class="content-time">3/10/2021</span></p>
                        <div class="content-button">
                            <button class="btn"><i class="far fa-thumbs-up"></i> Hữu ích</button>
                            <button class="btn">Bình luận </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row comment-body">
                <div class="col l-4">
                    <div class="comment-detail-head">
                        <div class="customer-image">NB</div>
                        <div class="customer-name">
                            <h4>Nguyễn Văn B</h4>
                            <p>Đã tham gia 2 năm trước</p>
                        </div>
                    </div>
                    <div class="comment-detail-body">
                        <p><i class="far fa-comment-alt"></i> Đã viết: <span class="number-comment">2</span><span> đánh giá</span></p>
                        <p><i class="far fa-thumbs-up"></i> Đã nhận: <span class="number-like">3</span><span> lượt cảm ơn</span></p>
                    </div>
                </div>
                <div class="col l-8">
                    <div class="comment-detail-content">
                        <div class="content-head">
                            <div class="rating-star">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="content-message">Cực kì hài lòng</span>
                        </div>
                        <p class="content-verify"><i class="fas fa-check-circle"></i> Đã mua hàng</p>
                        <p class="content-comment">
                            Tôi rất thích dùng sản phẩm này! Sẽ ủng hộ shop lần sau.
                        </p>
                        <p class="content-date">Đánh giá vào <span class="content-time">3/10/2021</span></p>
                        <div class="content-button">
                            <button class="btn"><i class="far fa-thumbs-up"></i> Hữu ích</button>
                            <button class="btn">Bình luận </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->view('partitions.frontend.footer'); ?>