<?php

class CustomerController extends BaseController {
    private $customerModel;
    public function __construct() {
        $this->loadModel('CustomerModel');
        $this->customerModel = new CustomerModel();
    }
    public function index() {
        $customers = $this->customerModel->getAll();
        return $this->view('admin.customers.show', ['customers' => $customers]);
    }
}
