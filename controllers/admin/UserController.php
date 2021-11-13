<?php

class UserController extends BaseController {

    public function __construct() {
        parent::__construct();
        $this->userId = $_SESSION['user']['user_id'];
    }

    public function index() {
        $users = $this->getUserModel()->getAll();
        $roles = $this->getUserModel()->getAllRoleByUserId($this->userId);
        return $this->view('admin.users.show', ['users' => $users, 'roles' => $roles]);
    }

    public function getAllUser() {
        $users = $this->getUserModel()->getAll();
        echo json_encode($users);
    }

    public function getAllRole() {
        $userId = $_GET['id'];
        $roles = $this->getUserModel()->getAllRole();
        $userRoles = $this->getUserModel()->getAllRoleByUserId($userId);
        $data = ['roles' => $roles, 'userRoles' => $userRoles];
        echo json_encode($data);
    }

    public function updateRole() {
        $userId = $_GET['id'];
        $this->getUserModel()->deleteRole($userId);
        foreach ($_POST as $roleId) {
            $data = [
                'user_id' => $userId,
                'role_id' => $roleId
            ];
            $this->getUserModel()->createRole($data);
        }
        echo json_encode(1);
    }

    public function createUser() {
        $email = $_POST['email'];
        $firstName = $_POST['first-name'];
        $lastName = $_POST['last-name'];
        // $password = $_POST['password'];
        $password = md5($_POST['password']);
        $user = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'password' => $password
        ];
        $this->getUserModel()->createUser($user);
        $users = $this->getUserModel()->getAll();
        echo json_encode($users);
    }

    public function deleteUser() {
        $userId = $_GET['id'];
        $this->getUserModel()->deleteUser($userId);
        $users = $this->getUserModel()->getAll();
        echo json_encode($users);
    }

    public function updateUser() {
        $userId = $_GET['id'];
        $firstName = $_POST['first-name'];
        $lastName = $_POST['last-name'];
        $email = $_POST['email'];
        // $password = $_POST['password'];
        $password = md5($_POST['password']);
        $user = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'password' => $password
        ];

        $this->getUserModel()->updateUser($userId, $user);
        $users = $this->getUserModel()->getAll();
        echo json_encode($users);
    }

    public function searchUser() {
        $str = $_GET['str'];
        $users = $this->getUserModel()->searchUser($str);
        echo json_encode($users);
    }
}
