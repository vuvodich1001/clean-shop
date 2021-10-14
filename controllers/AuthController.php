<?php

class AuthController extends BaseController {
    private $userModel;
    public function __construct() {
        session_start();
        $this->loadModel('UserModel');
        $this->userModel = new UserModel();
    }

    public function customerLogin() {
        $check = 0;
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        if ($this->userModel->authenticate($username, $password) == 1) {
            $_SESSION['customer'] = 1;
            $check = 1;
        }
        echo json_encode($check);
    }

    public function customerLogout() {
        unset($_SESSION['customer']);
        header('Location:index.php');
    }
    public function authAdmin() {
    }

    public function registerCustomer() {
    }
}
