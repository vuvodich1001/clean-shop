<?php

class CustomerController extends BaseController {
    private $customerModel;
    public function __construct() {
        parent::__construct();
        $this->loadModel('CustomerModel');
        $this->customerModel = new CustomerModel();
        $this->userId = $_SESSION['user']['user_id'];
    }

    public function index() {
        $customers = $this->customerModel->getAll();
        $roles = $this->getUserModel()->getAllRoleByUserId($this->userId);
        return $this->view('admin.customers.show', ['customers' => $customers, 'roles' => $roles]);
    }
}
