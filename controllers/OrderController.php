<?php
class OrderController extends BaseController {
    private $orderModel;

    public function __construct() {
        session_start();
        $this->loadModel('OrderModel');
        $this->orderModel = new OrderModel();
    }

    public function createOrder() {
    }
    public function createOrderWithNewAddress() {
        // customerId
        $customerId = $_SESSION['customer']['customer_id'];

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
        // order fee
        // data from $_SESSION['order']
        $total = $_SESSION['order']['total'];
        $shippingFee = $_SESSION['order']['shippingFee'];
        $subtotal = $_SESSION['order']['subtotal'];

        $orderFee = [
            'total' => $total,
            'subtotal' => $subtotal,
            'shipping_fee' => $shippingFee,
            'payment_method' => 'COD',
            'discount' => 0,
            'status' => 'dang xu li'
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
        $this->orderModel->createOrder($shippingAddress, $orderFee, $orderDetail, $customerId);
        unset($_SESSION['order']);
        unset($_SESSION['cart']);

        $combined = array_merge($shippingAddress, $orderFee, $orderDetail);
        echo json_encode($combined);
    }
}
