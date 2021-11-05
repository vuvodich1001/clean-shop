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
            $discount = 0;
            if ($voucher['discount_type'] == 'money') {
                $discount = $voucher['discount_number'];
            } else {
                $discount = $voucher['discount_percent'] * $total;
            }
            $_SESSION['voucher'] = $discount;
            echo json_encode($discount);
        } else {
            echo json_encode(0);
        }
    }

    public function removeVoucher() {
        unset($_SESSION['voucher']);
    }
}
