<?php

class UserModel extends BaseModel {
    const TABLE = 'user';
    const TABLE_ROLE = 'have_role';
    public function getAll($select = ['*'], $orderBy = [], $limit = 15) {
        return $this->all(self::TABLE, $select = ['*'], $orderBy = [], $limit = 15);
    }

    public function getAllRoleByUserId($userId) {
        $sql = "select * from user u, have_role h, role r
                where u.user_id = h.user_id and h.role_id = r.role_id and u.user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        $roles = [];
        while ($row = $stmt->fetch()) {
            $roles[] = $row;
        }
        return $roles;
    }

    public function getAllRole() {
        $sql = "select * from role";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $roles = [];
        while ($row = $stmt->fetch()) {
            $roles[] = $row;
        }
        return $roles;
    }

    public function checkPrivilege($userId, $controller) {
        $roles = array_map(function ($role) {
            return $role['name'];
        }, $this->getAllRoleByUserId($userId));
        array_push($roles, 'auth', 'home');
        return in_array($controller, $roles) ? true : false;
    }

    public function createRole($data) {
        $this->create(self::TABLE_ROLE, $data);
    }

    public function deleteRole($id) {
        $sql = "delete from have_role where user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $id]);
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

    public function authenticate($username, $password) {
        $sql = "select * from user where email= :username and password = :password";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['username' => $username, 'password' => $password]);
        return $stmt->rowCount();
    }

    public function getUserByUsernameAndPassword($username, $password) {
        $sql = "select * from user where email = :username and password = :password limit 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['username' => $username, 'password' => $password]);
        $user = [];
        while ($row = $stmt->fetch()) {
            $user = $row;
        }
        return $user;
    }
    public function searchUser($str) {
        $sql = "select * from user where first_name like :str or last_name like :str";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['str' => '%' . $str . '%']);
        $users = [];
        while ($row = $stmt->fetch()) {
            $users[] = $row;
        }
        return $users;
    }
}
