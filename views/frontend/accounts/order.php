<?php $this->view('partitions.frontend.header') ?>
<div class="grid wide">
    <div class="row account-container">
        <div class="col l-3">
            <?php $this->view('frontend.accounts.sidebar') ?>
        </div>
        <div class="col l-9">
            <h3>Đơn hàng của tôi</h3>
            <div class="account-body">
                <table>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Ngày mua</th>
                        <th>Sản phẩm</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái đơn hàng</th>
                    </tr>

                    <tr>
                        <td><a href="">123456</a></td>
                        <td>Ngày mua</td>
                        <td>Sản phẩm</td>
                        <td>Tổng tiền</td>
                        <td>Trạng thái đơn hàng</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $this->view('partitions.frontend.footer') ?>