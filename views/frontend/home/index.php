    <?php $this->view('partitions.frontend.header'); ?>
    <div class="grid wide">
        <div class="row sm-gutter banner">
            <div class="col l-8 c-12">
                <div class="row sm-gutter slider">
                    <div class="col l-12">
                        <div class="slider-item slider-item-free-ship">
                            <div>
                                <h2>Mã giảm giá</h2>
                                <p>PreeShip trên mọi tỉnh thành</p>
                            </div>
                            <a class="btn-receive-coupon" href="discount">Nhận ngay</a>
                        </div>
                    </div>

                    <div class="col l-12">
                        <div class="slider-item slider-item-voucher">
                            <div>
                                <h2>Đăng ký để nhận voucher</h2>
                                <p>Nhận voucher liền tay rước quà về nhà</p>
                            </div>
                            <a class="btn-register-voucher btn-register">Đăng ký ngay</a>
                        </div>
                    </div>

                    <!-- <div classs="col l-12">
                        <div class="slider-item slider-item-share">
                            <div>
                                <h2>Chia sẻ với bạn bè</h2>
                                <p>Chia sẻ với bạn bè để nhận nhiều</p>
                            </div>
                            <button class="btn-register-voucher">Chia sẻ ngay</button>
                        </div>
                    </div> -->
                </div>
            </div>

            <div class="col l-4 m-0 c-0">
                <div class="banner-item">
                    <h2>Săn sale sập sàn</h2>
                </div>
            </div>
        </div>
        <div class="row container">
            <div class="col l-2 c-0">
                <?php
                $this->view('partitions.frontend.sidebar');
                ?>
            </div>

            <div class="col l-10">
                <div class="home-filter">
                    <span>Sắp xếp theo</span>
                    <div class="btn btn-new" value="new">
                        Mới nhất
                    </div>
                    <div class="btn btn-best-seller" value="best-seller">
                        Bán chạy
                    </div>
                    <div class="btn btn-price">
                        Giá
                        <i class="btn-price-icon fas fa-chevron-down"></i>
                        <div class="price-sort">
                            <ul class="price-sort-list">
                                <li class="btn-price-down-up" value="down-up">Thấp - Cao</li>
                                <li class="btn-price-up-down" value="up-down">Cao - Thấp</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="content">
                    <div class="row sm-gutter book">
                        <!-- list book -->
                        <!-- insert book here by javascript -->
                    </div>
                </div>

                <div class="pagination">
                    <ul>
                        <li><a href=""><i class="fas fa-angle-left"></i></a></li>
                        <?php for ($i = 1; $i <= $num; $i++) { ?>
                            <li>
                                <a class="page-item-link <?php echo $i == 1 ? 'page-item-active' : ''; ?>" href=""><?php echo $i; ?></a>
                            </li>
                        <?php } ?>
                        <li><a href=""><i class="fas fa-angle-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php $this->view('partitions.frontend.footer'); ?>