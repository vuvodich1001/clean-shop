<?php

class AuthController extends BaseController {

    public function __construct() {
        parent::__construct();
    }
    public function redirectLogin() {
        return $this->view('admin.login');
    }

    public function adminLogin() {
        $check = 0;
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        if ($this->getUserModel()->authenticate($username, $password) == 1) {
            $user = $this->getUserModel()->getUserByUsernameAndPassword($username, $password);
            $_SESSION['user'] = $user;
            $check = 1;
        }
        echo json_encode($check);
    }

    public function adminLogout() {
        session_destroy();
        header('location://localhost/mvc-php/admin');
    }
}
