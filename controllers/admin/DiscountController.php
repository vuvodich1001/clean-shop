<?php
class DiscountController extends BaseController {
    private $discountModel;
    public function __construct() {
        $this->loadModel('DiscountModel');
        $this->discountModel = new DiscountModel();
    }

    public function index() {
        $vouchers = $this->discountModel->getAll();
        return $this->view('admin.vouchers.show', ['vouchers' => $vouchers]);
    }
}
