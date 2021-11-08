<?php

class SupplierController extends BaseController {
    private $supplierModel;
    public function __construct() {
        $this->loadModel('SupplierModel');
        $this->supplierModel = new SupplierModel();
    }

    public function index() {
        $suppliers = $this->supplierModel->getAll();
        return $this->view('admin.suppliers.show', ['suppliers' => $suppliers]);
    }
}
