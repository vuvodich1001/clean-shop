<?php

class OrderController extends BaseController {
    private $orderModel;
    public function __construct() {
        $this->loadModel('OrderModel');
        $this->orderModel =  new OrderModel();
    }

    public function index() {
        $orders = $this->orderModel->getAll();
        return $this->view('admin.orders.show', ['orders' => $orders]);
    }
}
