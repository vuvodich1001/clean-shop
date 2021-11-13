<?php

class AuthController extends BaseController {
    private $customerModel;
    public function __construct() {
        session_start();
        $this->loadModel('CustomerModel');
        $this->customerModel = new CustomerModel();
    }

    public function customerLogin() {
        $check = 0;
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        if ($this->customerModel->authenticate($username, $password) == 1) {
            $customer = $this->customerModel->getCustomerByUsernameAndPassword($username, $password);
            $_SESSION['customer'] = $customer;
            $check = 1;
        }
        echo json_encode($check);
    }

    public function customerLogout() {
        unset($_SESSION['customer']);
        header('Location:index.php');
    }
}
