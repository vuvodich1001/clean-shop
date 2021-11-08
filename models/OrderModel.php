<?php
class OrderModel extends BaseModel {
    const TABLE_ORDER = 'book_order';
    const TABLE_ORDER_DETAIL = 'order_detail';
    const TABLE_CUSTOMER_ADDRESS = 'customer_address';

    public function getAll($select = ['*'], $orderBy = [], $limit = 15) {
        return $this->all(self::TABLE_ORDER, $select, $orderBy, $limit);
    }

    public function getOrderId($customerId) {
        $sql = "select * from book_order where customer_id = :customer_id order by order_date desc limit 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['customer_id' => $customerId]);
        return $stmt->fetch()['order_id'];
    }


    public function findById($orderId) {
        $sql = "select * from book_order where order_id = :order_id limit 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['order_id' => $orderId]);
        return $stmt->fetch();
    }

    public function createOrder($shippingAddress, $orderFee, $orderDetail, $customerId, $check) {
        $bookOrder = array_merge($shippingAddress, $orderFee);
        $this->create(self::TABLE_ORDER, $bookOrder);
        // check = 0 => not exists address before 
        if ($check == 0) $this->create(self::TABLE_CUSTOMER_ADDRESS, $shippingAddress);
        $orderId = $this->getOrderId($customerId);
        foreach ($orderDetail as $detail) {
            $detail['order_id'] = $orderId;
            $this->create(self::TABLE_ORDER_DETAIL, $detail);
        }
    }

    public function checkDuplicateAddress($address) {
        $placeHolders = implode(' and ', array_map(function ($value) {
            return $value . '=:' . $value;
        }, array_keys($address)));
        $sql = "select * from customer_address where $placeHolders";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($address);
        return $stmt->rowCount();
    }

    public function findCustomerAddress($addressId) {
        $sql = "select * from customer_address where address_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $addressId]);
        $address = $stmt->fetch();
        unset($address['address_id']);
        return $address;
    }

    public function getAllOrderByCustomerId($customerId) {
        $sql = "select * from book_order where customer_id = :customer_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['customer_id' => $customerId]);
        $orders = [];
        while ($row = $stmt->fetch()) {
            $orders[] = $row;
        }
        return $orders;
    }

    public function getAllOrderDetailByOrderId($orderId) {
        $sql = "select * from order_detail o join book b on o.book_id = b.book_id where order_id = :order_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['order_id' => $orderId]);
        $orderDetails = [];
        while ($row = $stmt->fetch()) {
            $orderDetails[] = $row;
        }
        return $orderDetails;
    }

    public function cancelOrder($id) {
        $sql = "update book_order set status='Đã hủy' where order_id = :order_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['order_id' => $id]);
    }
}
