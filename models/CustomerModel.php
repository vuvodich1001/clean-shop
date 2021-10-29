<?php
class CustomerModel extends BaseModel {
    const TABLE = 'customer';
    public function authenticate($username, $password) {
        $sql = "select * from customer where email= '$username' and password = '$password'";
        $result = $this->query($sql);
        return mysqli_num_rows($result);
    }

    public function getCustomerByUsernameAndPassword($username, $password) {
        $sql = "select * from customer where email = '$username' and password = '$password' limit 1";
        $result = $this->query($sql);
        $customer = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $customer = $row;
        }
        return $customer;
    }

    public function getAll($select = ['*'], $orderBy = [], $limit = 15) {
        return $this->all(self::TABLE, $select, $orderBy, $limit);
    }

    public function createCustomer($data) {
        $this->create(self::TABLE, $data);
    }

    public function getCustomerAddressById($id) {
        $sql = "select * from customer_address where customer_id = $id";
        $result = $this->query($sql);
        $address = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $address[] = $row;
        }
        return $address;
    }
}
