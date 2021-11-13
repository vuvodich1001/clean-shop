<?php

class SupplierController extends BaseController {
    private $supplierModel;
    public function __construct() {
        parent::__construct();
        $this->loadModel('SupplierModel');
        $this->supplierModel = new SupplierModel();
        $this->userId = $_SESSION['user']['user_id'];
    }

    public function index() {
        $suppliers = $this->supplierModel->getAll();
        $roles = $this->getUserModel()->getAllRoleByUserId($this->userId);
        return $this->view('admin.suppliers.show', ['suppliers' => $suppliers, 'roles' => $roles]);
    }
}
