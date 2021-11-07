<?php
class OrderController extends BaseController {
    private $orderModel;

    public function __construct() {
        session_start();
        $this->loadModel('OrderModel');
        $this->orderModel = new OrderModel();
    }


    public function createOrder() {
        // customerId
        $customerId = $_SESSION['customer']['customer_id'];

        // shipping address
        $shippingAddress = [];
        // check = 0 => not exists address before
        $check = 0;
        if (isset($_GET['addressId'])) {
            $addressId = $_GET['addressId'];
            $shippingAddress = $this->orderModel->findCustomerAddress($addressId);
            $check = 1;
        } else {
            // order
            // data from formdata
            $firstName = $_POST['firstname'];
            $lastName = $_POST['lastname'];
            $address = $_POST['address'];
            $ward = $_POST['ward'];
            $district = $_POST['district'];
            $city = $_POST['city'];
            $phone = $_POST['phone'];
            $zipcode = $_POST['zipcode'];

            $shippingAddress = [
                'customer_id' => $customerId,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'line1' => $address,
                'line2' => $ward . ', ' . $district,
                'city' => $city,
                'phone' => $phone,
                'zipcode' => $zipcode,
                'country' => 'VN',
            ];
            if ($this->orderModel->checkDuplicateAddress($shippingAddress) >= 1) {
                echo json_encode(1);
                return;
            }
        }

        // order fee
        // data from $_SESSION['order']
        $total = $_SESSION['order']['total'];
        $shippingFee = $_SESSION['order']['shippingFee'];
        $subtotal = $_SESSION['order']['subtotal'];
        $discount = $_SESSION['order']['discount'];
        $paymentMethod = strtoupper($_GET['payment']);
        $orderFee = [
            'total' => $total,
            'subtotal' => $subtotal,
            'shipping_fee' => $shippingFee,
            'payment_method' => $paymentMethod,
            'discount' => $discount,
            'status' => $paymentMethod == 'COD' ? 'Đang xử lí' : 'Đã thanh toán'
        ];

        // order detail
        $orderDetail = [];
        foreach ($_SESSION['cart'] as $cart) {
            $orderDetail[] = [
                'book_id' => $cart['book']['book_id'],
                'quantity' => $cart['quantity'],
                'subtotal' => $cart['book']['price'] * $cart['quantity']
            ];
        }
        $this->orderModel->createOrder($shippingAddress, $orderFee, $orderDetail, $customerId, $check);
        unset($_SESSION['order']);
        unset($_SESSION['cart']);
        unset($_SESSION['voucher']);

        $combined = array_merge($shippingAddress, $orderFee, $orderDetail);
        echo json_encode($combined);
    }
}
