<?php $this->view('partitions.frontend.header') ?>
<div class="grid wide">
    <div class="row">
        <div class="col l-12">
            <div class="breadcrumb">
                <ul>
                    <li class="breadcrumb-item"><a href="">Home/</a></li>
                    <li class="breadcrumb-item">Voucher</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row container">
        <div class="col l-12">
            <h1>Mã Giảm Giá - Săn sale sập sàn</h1>
        </div>
        <?php foreach ($vouchers as $voucher) : ?>
            <div class="col l-3">
                <div class="voucher-item">
                    <h2 class="voucher-item__name"><?php echo $voucher['name'] ?></h2>
                    <p class="voucher-item__title"><?php echo $voucher['description'] ?></p>
                    <p class="voucher-item__expire">Hạn sử dụng: <?php echo $voucher['discount_expire'] ?></p>
                    <p class="voucher-item__body">Áp dụng cho tất cả sản phẩm</p>
                    <p class="voucher-item__code"><?php echo $voucher['code'] ?></p>
                    <button class="voucher-item__button">Copy</button>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>
<?php $this->view('partitions.frontend.footer') ?>