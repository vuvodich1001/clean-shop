<?php $this->view('partitions.frontend.header') ?>
<div class="grid wide">
    <div class="row">
        <div class="col l-12">
            <div class="breadcrumb">
                <ul>
                    <li class="breadcrumb-item"><a href="">Home/</a></li>
                    <li class="breadcrumb-item"><a href="account/info">Info/</a></li>
                    <li class="breadcrumb-item">Phone Update</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row account-container">
        <div class="col l-3">
            <?php $this->view('frontend.accounts.sidebar', ['info' => $info]) ?>
        </div>
        <div class="col l-9">
            <h3>Cập nhật số điện thoại</h3>
            <div class="account-body">
                <form action="index.php?controller=account&action=updateInfo" id="account-form" method="POST">
                    <div class="form-group">
                        <label for="">Số điện thoại</label>
                        <input type="text" name="phone" id="phone" value="<?php echo $phone ?>" required>
                    </div>
                    <button class="btn active"> Lưu thay đổi</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->view('partitions.frontend.footer') ?>