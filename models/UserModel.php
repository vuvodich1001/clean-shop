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
        $sql = "select * from user where username like '%$str%'";
        $result = $this->query($sql);
        $users = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
        return $users;
    }

    public function authenticate($username, $password) {
        $sql = "select * from user where username = '$username' and password = '$password'";
        $result = $this->query($sql);
        return mysqli_num_rows($result);
    }
}
