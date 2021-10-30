<?php

class UserModel extends BaseModel {
    const TABLE = 'user';
    public function getAll($select = ['*'], $orderBy = [], $limit = 15) {
        return $this->all(self::TABLE, $select = ['*'], $orderBy = [], $limit = 15);
    }

    public function createUser($data) {
        $this->create(self::TABLE, $data);
    }
    public function findById($id) {
        return $this->find(self::TABLE, $id);
    }

    public function deleteUser($id) {
        $this->destroy(self::TABLE, $id);
    }

    public function updateUser($id, $data) {
        $this->update(self::TABLE, $id, $data);
    }

    public function searchUser($str) {
        $sql = "select * from user where username like :str";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['str' => $str]);
        $users = [];
        while ($row = $stmt->fetch()) {
            $users[] = $row;
        }
        return $users;
    }

    public function authenticate($username, $password) {
        $sql = "select * from user where email = :username and password = :password";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['username' => $username, 'password' => $password]);
        return $stmt->rowCount();
    }
}
