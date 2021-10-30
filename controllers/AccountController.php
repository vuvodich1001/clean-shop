<?php

class AccountController extends BaseController {

    private $customerModel;

    public function __construct() {
        session_start();
        $this->loadModel('CustomerModel');
        $this->customerModel = new CustomerModel();
    }

    public function redirectOrder() {
        return $this->view('frontend.accounts.order');
    }

    public function redirectInfo() {
        return $this->view('frontend.accounts.info');
    }

    public function redirectComment() {
        return $this->view('frontend.accounts.comment');
    }

    public function redirectAddress() {
        $address = $this->customerModel->getCustomerAddressById($_SESSION['customer']['customer_id']);
        return $this->view('frontend.accounts.address', ['address' => $address]);
    }
}
