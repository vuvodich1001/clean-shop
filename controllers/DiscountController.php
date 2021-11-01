<?php
class DiscountController extends BaseController {
    private $discountModel;
    public function __construct() {
        session_start();
        $this->loadModel('DiscountModel');
        $this->discountModel = new DiscountModel();
    }
    public function index() {
        $vouchers = $this->discountModel->getAll();
        return $this->view('frontend.discounts.coupon', ['vouchers' => $vouchers]);
    }

    public function addVoucher() {
        $code = $_POST['code'];
        $total = $_POST['total'];
        $voucher = $this->discountModel->checkVoucher($code);
        // compare date here!!!
        $now = time();
        $expireDate = strtotime($voucher['discount_expire']);
        if (!empty($voucher) && $total >= $voucher['min_order'] && $now <= $expireDate) {
            $_SESSION['voucher'] = $voucher['discount_number'];
            echo json_encode($voucher['discount_number']);
        } else {
            echo json_encode(0);
        }
    }

    public function removeVoucher() {
        unset($_SESSION['voucher']);
    }
}
