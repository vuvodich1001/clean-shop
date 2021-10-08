    <?php $this->view('partitions.frontend.header'); ?>
    <div class="grid wide">
        <div class="row sm-gutter banner">
            <div class="col l-8 c-12">
                <div class="row sm-gutter slider">
                    <div class="col l-12">
                        <div class="slider-item slider-item-free-ship">
                            <div>
                                <h1>Mã giảm giá</h1>
                                <p>PreeShip trên mọi tỉnh thành</p>
                            </div>
                            <button class="btn-receive-coupon">Nhận ngay</button>
                        </div>
                    </div>

                    <div class="col l-12">
                        <div class="slider-item slider-item-voucher">
                            <div>
                                <h1>Đăng ký để nhận voucher</h1>
                                <p>Nhận voucher liền tay rước quà về nhà</p>
                            </div>
                            <button class="btn-register-voucher">Đăng ký ngay</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col l-4 c-12">
                <div class="banner-item">
                    <h1>Săn sale sập sàn</h1>
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
                    <div class="btn btn-new">
                        Mới nhất
                    </div>
                    <div class="btn btn-best-seller">
                        Bán chạy
                    </div>
                    <div class="btn btn-price">
                        Giá
                        <i class="btn-price-icon fas fa-chevron-down"></i>
                        <div class="price-sort">
                            <ul class="price-sort-list">
                                <li class="btn-price-down-up">Thấp - Cao</li>
                                <li class="btn-price-up-down">Cao - Thấp</li>
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
                                <a class="page-item-link" href=""><?php echo $i; ?></a>
                            </li>
                        <?php } ?>
                        <li><a href=""><i class="fas fa-angle-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php $this->view('partitions.frontend.footer'); ?>