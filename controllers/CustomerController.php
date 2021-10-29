<?php
class CustomerController extends BaseController {
    private $customerModel;
    public function __construct() {
        $this->loadModel('CustomerModel');
        $this->customerModel = new CustomerModel();
    }
    public function registerCustomer() {
        $firstName = $_POST['first-name'];
        $lastName = $_POST['last-name'];
        $email = $_POST['email'];
        $password = md5($_POST['rpassword']);
        $data = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'password' => $password
        ];
        $this->customerModel->createCustomer($data);
        $customers = $this->customerModel->getAll();
        $check = 0;
        !empty($customers) ? $check = 1 : $check;
        echo json_encode($check);
    }
}
