<?php
class CustomerModel extends BaseModel {
    const TABLE = 'customer';
    public function authenticate($username, $password) {
        $sql = "select * from customer where email= :username and password = :password";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['username' => $username, 'password' => $password]);
        return $stmt->rowCount();
    }

    public function getCustomerByUsernameAndPassword($username, $password) {
        $sql = "select * from customer where email = :username and password = :password limit 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['username' => $username, 'password' => $password]);
        $customer = [];
        while ($row = $stmt->fetch()) {
            $customer = $row;
        }
        return $customer;
    }

    public function getAll($select = ['*'], $orderBy = [], $limit = 15) {
        return $this->all(self::TABLE, $select, $orderBy, $limit);
    }

    public function getById($customerId) {
        return $this->find(self::TABLE, $customerId);
    }

    public function createCustomer($data) {
        $this->create(self::TABLE, $data);
    }

    public function getCustomerAddressById($id) {
        $sql = "select * from customer_address where customer_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        $address = [];
        while ($row = $stmt->fetch()) {
            $address[] = $row;
        }
        return $address;
    }
}
