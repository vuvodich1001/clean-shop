<div class="account-wrap">
    <div class="account-avatar customer-image">
        <?php echo substr($info['first_name'], 0, 1) . '' . substr($info['last_name'], 0, 1) ?>
    </div>
    <div class="account-info">
        <span>Tài khoản của</span>
        <p><?php echo ucfirst($info['first_name']) . ' ' . ucfirst($info['last_name']) ?></p>
    </div>
</div>

<ul class="account-list">
    <li class="account-item"><a href="account/info"><i class="account-icon fas fa-user-alt"></i>Thông tin tài khoản</a></li>
    <li class="account-item"><a href="account/order"><i class="account-icon fas fa-tasks"></i>Quản lí đơn hàng</a></li>
    <li class="account-item"><a href="account/address"><i class="account-icon fas fa-address-card"></i></i>Sổ địa chỉ</a></li>
    <li class="account-item"><a href="account/comment"><i class="account-icon fas fa-eye"></i>Nhận xét sản phẩm đã mua</a></li>
    <li class="account-item"><a href="account/favourite"><i class="account-icon fas fa-heart"></i>Sản phẩm yêu thích</a></li>
</ul>

<div class="modal modal-overlay modal-review">
    <div class="review-content">
        <div class="review-head">
            <img class="review-img" src="./public/admin/uploads/cleancode.jpg" alt="">
            <div class="review-info">
                <p class="review-title">Sách lập trình java - UIT</p>
                <p class="review-author">Vũ Nguyễn</p>
            </div>
        </div>
        <div class="review-body">
            <h3>Vui lòng đánh giá</h3>
            <div class="review-rating">
                <input type="radio" name="rate" id="rate1" value="5">
                <label for="rate1" class="star"></label>
                <input type="radio" name="rate" id="rate2" value="4">
                <label for="rate2" class="star"></label>
                <input type="radio" name="rate" id="rate3" value="3">
                <label for="rate3" class="star"></label>
                <input type="radio" name="rate" id="rate4" value="2">
                <label for="rate4" class="star"></label>
                <input type="radio" name="rate" id="rate5" value="1">
                <label for="rate5" class="star"></label>
            </div>
        </div>

        <div class="review-comment">
            <textarea name="" id="" cols="50" rows="10" placeholder="Chia sẻ thêm thông tin về sản phẩm"></textarea>
        </div>

        <div id="review-images"></div>
        <input type="file" name="photos[]" id="review-file" placeholder="" multiple>

        <div class="review-action">
            <label for="review-file" class="btn-account-action btn-add-image"><i class="fas fa-camera"></i> Thêm ảnh</label>
            <label class="btn-account-action btn-send-review">Gửi đánh giá</label>
        </div>
        <p class="review-close">
            <i class="fas fa-times"></i>
        </p>
    </div>
</div>