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

    public function getAllVoucher() {
        $vouchers = $this->discountModel->getAll();
        echo json_encode($vouchers);
    }

    public function createVoucher() {
        $voucher = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'min_order' => $_POST['min'],
            'discount_type' => $_POST['type'],
            'code' => $_POST['code'],
            'discount_date' => $_POST['date'],
            'discount_expire' => $_POST['date-expire']
        ];
        $_POST['type'] == 'money' ? $voucher['discount_number'] = $_POST['cost'] : $voucher['discount_percent'] = $_POST['cost'];
        $this->discountModel->addVoucher($voucher);
        $vouchers = $this->discountModel->getAll();
        echo json_encode($vouchers);
    }

    public function deleteVoucher() {
        $id = $_GET['id'];
        $this->discountModel->deleteVoucher($id);
        $vouchers = $this->discountModel->getAll();
        echo json_encode($vouchers);
    }
}
