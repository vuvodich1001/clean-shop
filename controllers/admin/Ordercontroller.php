<?php

class OrderController extends BaseController {
    private $orderModel;
    public function __construct() {
        parent::__construct();
        $this->loadModel('OrderModel');
        $this->orderModel =  new OrderModel();
        $this->userId = $_SESSION['user']['user_id'];
    }

    public function index() {
        $orders = $this->orderModel->getAll(['*'], ['status desc', 'order_date desc'],  30);
        $roles = $this->getUserModel()->getAllRoleByUserId($this->userId);
        $textColors = [
            'Đang xử lí' => 'text-primary',
            'Đã thanh toán' => 'text-warning',
            'Giao hàng thành công' => 'text-success',
            'Đang giao hàng' => 'text-info',
            'Đã hủy' => 'text-danger'
        ];
        return $this->view('admin.orders.show', [
            'orders' => $orders,
            'roles' => $roles,
            'textColors' => $textColors
        ]);
    }

    public function orderDetail() {
        $id = $_GET['id'];
        $orders = $this->orderModel->getAllOrderDetailByOrderId($id);
        echo json_encode($orders);
    }

    public function changeStatusSuccess() {
        $orderId = $_GET['id'];
        $data = [
            'status' => 'Giao hàng thành công',
            'order_id' => $orderId
        ];
        $this->orderModel->changeStatus($data);
        echo json_encode(1);
    }

    public function changeStatusShipping() {
        $orderId = $_GET['id'];
        $data = [
            'status' => 'Đang giao hàng',
            'order_id' => $orderId
        ];
        $this->orderModel->changeStatus($data);
    }
}
