<?php
class DiscountController extends BaseController {
    private $discountModel;
    public function __construct() {
        parent::__construct();
        $this->loadModel('DiscountModel');
        $this->discountModel = new DiscountModel();
        $this->userId = $_SESSION['user']['user_id'];
    }

    public function index() {
        $vouchers = $this->discountModel->getAll();
        $roles = $this->getUserModel()->getAllRoleByUserId($this->userId);
        return $this->view('admin.vouchers.show', ['vouchers' => $vouchers, 'roles' => $roles]);
    }
}
