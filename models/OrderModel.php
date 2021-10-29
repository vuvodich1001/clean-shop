<?php
class OrderModel extends BaseModel {
    const TABLE_ORDER = 'book_order';
    const TABLE_ORDER_DETAIL = 'order_detail';
    const TABLE_CUSTOMER_ADDRESS = 'customer_address';

    public function gerOrderId($customerId) {
        $sql = "select * from book_order where customer_id = $customerId order by order_date desc limit 1";
        $result = $this->query($sql);
        $orderId = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $orderId = $row['order_id'];
        }
        return $orderId;
    }

    public function createOrder($shippingAddress, $orderFee, $orderDetail, $customerId) {
        $bookOrder = array_merge($shippingAddress, $orderFee);
        $this->create(self::TABLE_ORDER, $bookOrder);
        $this->create(self::TABLE_CUSTOMER_ADDRESS, $shippingAddress);
        $orderId = $this->gerOrderId($customerId);
        foreach ($orderDetail as $detail) {
            $detail['order_id'] = $orderId;
            $this->create(self::TABLE_ORDER_DETAIL, $detail);
        }
    }
}
