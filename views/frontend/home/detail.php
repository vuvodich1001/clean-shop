<?php $this->view('partitions.frontend.header'); ?>

<div class="grid wide">
    <div class="row">
        <div class="col l-12">
            <div class="breadcrumb">
                <ul>
                    <li class="breadcrumb-item"><a href="index.php">Home/</a></li>
                    <li class="breadcrumb-item"><a href=""></a>Book Detail</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row container container-detail">
        <div class="col l-4">
            <div class="row sm-gutter">
                <div class="col l-12">
                    <div class="book-detail-img">
                        <img src="public/admin/uploads/<?php echo $book['main_image']; ?>" alt="">
                    </div>
                </div>
                <div class="col l-12">
                    <div class="row sm-gutter more-img">
                        <div class="col l-3">
                            <div class="book-detail-img-item">
                                <img src="public/admin/uploads/<?php echo $book['main_image']; ?>" alt="">
                            </div>
                        </div>
                        <div class="col l-3">
                            <div class="book-detail-img-item">
                                <img src="public/admin/uploads/bitcoin.jpg" alt="">
                            </div>
                        </div>
                        <div class="col l-3">
                            <div class="book-detail-img-item">
                                <img src="public/admin/uploads/c++.jpg" alt="">
                            </div>
                        </div>
                        <div class="col l-3">
                            <div class="book-detail-img-item">
                                <img src="public/admin/uploads/learnpythonquickly.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col l-12">
                    <div id="fb-root"></div>
                    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0" nonce="PY5SNmaw"></script>

                    <div class="fb-share-button" data-href="https://www.facebook.com/profile.php?id=100011530591672" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.facebook.com%2Fprofile.php%3Fid%3D100011530591672&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
                    <div class="book-detail-share">
                        <span>Chia sẻ: <a href="#"><i class="fab fa-instagram"></i></a> <a href="#"><i class="fab fa-twitter"></i></a> | Yêu
                            thích:
                            <i class="far fa-heart"></i></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col l-3">
            <div class="book-detail-content">
                <p class="detail-author"><strong>Tác giả: </strong><?php echo $book['author']; ?></p>
                <p class="detail-price"><strong>Giá:</strong>
                    <?php echo number_format($book['price'], 0, '.', '.'); ?>đ</p>
                <!-- <p class="detail-description"><strong>Description: </strong><?php echo $book['description']; ?></p> -->
                <div class="detail-quantity">
                    <strong> Số lượng: </strong>
                    <button><i class="fas fa-plus"></i></button>
                    <span class="cur-quantity">1</span>
                    <button><i class="fas fa-minus"></i></button>
                </div>
                <button book-id="<?php echo $book['book_id'] ?>" class="btn btn-addtocart active"><i class="fas fa-plus-circle"></i> Thêm vào giỏ hàng</button>
            </div>
        </div>

        <div class="col l-4">
            <h3>Thông tin chi tiết</h3>
            <table class="detail-table">
                <tr>
                    <td>Kích thước</td>
                    <td><?php echo $book['width'] . ' x ' . $book['height'] ?> cm</td>
                </tr>
                <tr>
                    <td>Số trang</td>
                    <td><?php echo $book['page'] ?></td>
                </tr>
                <tr>
                    <td>Nhà xuất bản</td>
                    <td><?php echo $book['publisher'] ?></td>
                </tr>
                <tr>
                    <td>Ngày xuất bản</td>
                    <td><?php echo $book['publish_date'] ? date('d/m/Y', strtotime($book['publish_date'])) : '' ?></td>
                </tr>
            </table>
        </div>

    </div>
    <div class="row relate-title">
        <div class="col l-12 book-description">
            <h2>Mô tả sản phẩm</h2>
            <div><?php echo $book['description'] ?></div>
        </div>
    </div>
    <div class="row relate-title">
        <div class="col l-12">
            <h2>Sản phẩm tương tự</h2>
        </div>
    </div>
    <div class="row book-slider">
        <?php foreach ($bookRelates as $book) { ?>
            <div class="col l-2 m-3">
                <a href="http://localhost/mvc-php/book/detail/<?php echo $book['book_id'] ?>" class="item">
                    <img src="public/admin/uploads/<?php echo $book['main_image'] ?>" alt="">
                    <div class="item-body">
                        <h4 class="item-title"><?php echo $book['title'] ?></h4>
                        <p class="item-price"><?php echo number_format($book['price'], 0, '.', '.') ?> VNĐ</p>
                        <div class="item-rate">
                            <div class="item-rate__heart">
                                <i class="heart-icon far fa-heart"></i>
                                <i class="heart-icon-fill fas fa-heart"></i>
                            </div>
                            <div class="item-rate__star">
                                <?php for ($i = 1; $i <= $book['rating']; $i++) { ?>
                                    <i class="fas fa-star"></i>
                                <?php } ?>
                                <?php for ($i = 1; $i <= 5 - $book['rating']; $i++) { ?>
                                    <i class="far fa-star"></i>
                                <?php } ?>
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
                <div class="col l-4 m-12">
                    <div class="rating-summary">
                        <div class="rating-summary-head">
                            <h1><?php
                                $total = array_reduce($statistics, fn ($acc, $value) => $acc + $value['rating'] * $value['quantity'], 0);
                                echo empty($totalReview) ? 0 : round($total / $totalReview, 1);
                                ?></h1>
                            <div class="rating-summary-total">
                                <div class="rating-star">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <p><?php echo $totalReview ?> nhận xét</p>
                            </div>
                        </div>
                        <div class="rating-summary-body">

                            <?php for ($i = 5; $i >= 1; $i--) { ?>
                                <div class="rating-summary-group">
                                    <div class="rating-star">
                                        <?php for ($j = 1; $j <= $i; $j++) { ?>
                                            <i class="fas fa-star"></i>
                                        <?php } ?>
                                        <?php for ($j = 1; $j <= 5 - $i; $j++) { ?>
                                            <i class="far fa-star"></i>
                                        <?php } ?>
                                    </div>
                                    <span>
                                        <?php
                                        $check = 0;
                                        foreach ($statistics as $statistic) {
                                            if ($statistic['rating'] == $i) {
                                                echo '<input type="range" disabled min=0 max=' . $totalReview . ' value="' . $statistic['quantity'] . '">';
                                                echo $statistic['quantity'];
                                                $check = 1;
                                            }
                                        }
                                        if (!$check) {
                                            echo '<input type="range" disabled value=0 min=0>';
                                            echo 0;
                                        }
                                        ?>
                                    </span>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="col l-8 m-12">
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

            <?php
            const DAY = 60 * 60 * 24;
            const MONTH = DAY * 30;
            const YEAR = DAY * 365;
            ?>
            <?php foreach ($reviews as $review) : ?>
                <div class="row comment-body">
                    <div class="col l-4 m-12">
                        <div class="comment-detail-head">
                            <div class="customer-image"><?php echo substr($review['first_name'], 0, 1) . '' . substr($review['last_name'], 0, 1) ?></div>
                            <div class="customer-name">
                                <h4><?php echo ucfirst($review['first_name']) . ' ' . ucfirst($review['last_name']) ?></h4>
                                <?php
                                $diff = abs(strtotime(time()) - strtotime($review['register_date']));
                                $years = floor($diff / (YEAR));
                                echo '<p>Đã tham gia vào ' . date('d/m/Y', strtotime($review['register_date']));
                                ?>
                            </div>
                        </div>
                        <div class="comment-detail-body">
                            <p><i class="far fa-comment-alt"></i> Đã viết: <span class="number-comment"><?php echo $review['total_review'] ?></span><span> đánh giá</span></p>
                            <p><i class="far fa-thumbs-up"></i> Đã nhận: <span class="number-like"><?php echo $review['total_review'] - 1 ?></span><span> lượt cảm ơn</span></p>
                        </div>
                    </div>
                    <div class="col l-8 m-12">
                        <div class="comment-detail-content">
                            <div class="content-head">
                                <div class="rating-star">
                                    <?php for ($i = 1; $i <= $review['rating']; $i++) { ?>
                                        <i class="fas fa-star"></i>
                                    <?php } ?>
                                    <?php for ($i = 1; $i <= 5 - $review['rating']; $i++) { ?>
                                        <i class="far fa-star"></i>
                                    <?php } ?>
                                </div>
                                <span class="content-message"><?php echo $review['headline'] ?></span>
                            </div>
                            <p class="content-verify"><i class="fas fa-check-circle"></i> Đã mua hàng</p>
                            <div class="content-img">
                                <?php
                                if (!empty($review['image'])) {
                                    $images = explode(',', $review['image']);
                                    foreach ($images as $image) {
                                        echo '<img src="public/frontend/review-images/' . $image . '" alt="">';
                                    }
                                }
                                ?>
                            </div>
                            <p class="content-comment">
                                <?php echo $review['comment'] ?>
                            </p>
                            <p class="content-date">Đánh giá vào <span class="content-time"><?php echo date('d/m/Y', strtotime($review['review_time'])) ?></span></p>
                            <div class="content-button">
                                <button class="btn"><i class="far fa-thumbs-up"></i> Hữu ích</button>
                                <button class="btn">Bình luận </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>

<?php $this->view('partitions.frontend.footer'); ?>