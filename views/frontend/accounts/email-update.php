<?php $this->view('partitions.frontend.header') ?>
<div class="grid wide">
    <div class="row">
        <div class="col l-12">
            <div class="breadcrumb">
                <ul>
                    <li class="breadcrumb-item"><a href="">Home/</a></li>
                    <li class="breadcrumb-item"><a href="account/info">Info/</a></li>
                    <li class="breadcrumb-item">Email Update</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row account-container">
        <div class="col l-3">
            <?php $this->view('frontend.accounts.sidebar', ['info' => $info]) ?>
        </div>
        <div class="col l-9">
            <h3>Cập nhật email</h3>
            <div class="account-body">
                <form action="index.php?controller=account&action=updateInfo" id="account-form" method="POST">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo $email ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                    </div>
                    <button class="btn active"> Lưu thay đổi</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->view('partitions.frontend.footer') ?>