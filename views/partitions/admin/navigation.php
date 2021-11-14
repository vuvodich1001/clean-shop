<nav>
    <div class="search">
        <input type="text" id="search" placeholder="Search...">
        <button class="btn-search"><i class="fas fa-search"></i></button>
    </div>

    <div class="personal">
        <div class="personal-item bell">
            <i class="far fa-bell"></i>
            <p class="bell-quantity"><?php echo isset($notifications) ? count(array_filter($notifications, fn ($value) => !empty($value))) : 0 ?></p>
            <div class="personal-notification">
                <ul class="personal-list">
                    <?php if (!empty($notifications['pendingOrders'])) : ?>
                        <li><a href="order"><i class="fas fa-shopping-cart"></i> Bạn có <?= count($notifications['pendingOrders']) ?> đơn hàng mới cần xử lí</a></li>
                    <?php endif ?>
                    <?php if (!empty($notifications['pendingReviews'])) : ?>
                        <li><a href="review"><i class="far fa-comment"></i> Bạn đã nhận <?= count($notifications['pendingReviews']) ?> đánh giá mới</a></li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
        <div class="personal-item setting"><i class="fas fa-cog"></i></div>
        <div class="personal-item "><strong><?php echo ucfirst($_SESSION['user']['first_name']) . ' ' .  ucfirst($_SESSION['user']['last_name']) ?></strong></div>
    </div>
</nav>