<?php

class UserController extends BaseController {
    private $usermodel;
    public function __construct() {
        $this->loadModel('UserModel');
        $this->userModel = new UserModel();
    }
    public function index() {
        $users = $this->userModel->getAll();
        return $this->view('admin.users.show', ['users' => $users]);
    }

    public function getAllUser() {
        $users = $this->userModel->getAll();
        echo json_encode($users);
    }

    public function createUser() {
        $username = $_POST['name'];
        $email = $_POST['email'];
        // $password = $_POST['password'];
        $password = md5($_POST['password']);
        $user = [
            'username' => $username,
            'email' => $email,
            'password' => $password
        ];
        $this->userModel->createUser($user);
        $users = $this->userModel->getAll();
        echo json_encode($users);
    }

    public function deleteUser() {
        $userId = $_GET['id'];
        $this->userModel->deleteUser($userId);
        $users = $this->userModel->getAll();
        echo json_encode($users);
    }

    public function updateUser() {
        $userId = $_GET['id'];
        $username = $_POST['name'];
        $email = $_POST['email'];
        // $password = $_POST['password'];
        $password = md5($_POST['password']);
        $user = [
            'username' => $username,
            'email' => $email,
            'password' => $password
        ];

        $this->userModel->updateUser($userId, $user);
        $users = $this->userModel->getAll();
        echo json_encode($users);
    }

    public function searchUser() {
        $str = $_GET['str'];
        $users = $this->userModel->searchUser($str);
        echo json_encode($users);
    }
}
