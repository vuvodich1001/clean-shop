<?php $this->view('partitions.frontend.header') ?>
<div class="grid wide">
    <div class="row container">
        <div class="col l-12">
            <div class="shopping-cart">
                <h1>Giỏ hàng của bạn</h1>
                <table>
                    <thead>
                        <th>No.</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        <?php
                    if(isset($carts)){
                    foreach($carts as $cart){
                ?>
                        <tr>
                            <td class="cart-item-id"><?php echo $cart['book']['book_id']?></td>
                            <td><?php echo $cart['book']['title']?></td>
                            <td><img src="./public/admin/uploads/<?php echo $cart['book']['image']?>" alt=""></td>
                            <td><?php echo number_format($cart['book']['price'], 0, '.', '.')?> VNĐ</td>
                            <td><button class="btn-minus">-</button><span
                                    class="cart-quantity"><?php echo $cart['quantity']?></span><button
                                    class="btn-add">+</button></td>
                            <td><button class="btn-delete">Xóa</button></td>
                        </tr>
                        <?php 
                    }
                }
                ?>
                    </tbody>
                </table>
                <button class="btn btn-delete-all active">Xóa tất cả</button>
                <button class="btn btn-buy active">Mua</button>
            </div>
        </div>
    </div>
</div>
<?php $this->view('partitions.frontend.footer') ?>