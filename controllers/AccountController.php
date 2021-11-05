<?php

class AccountController extends BaseController {

    private $customerModel;
    private $bookModel;
    private $orderModel;
    private $info;
    private $customerId;
    public function __construct() {
        session_start();
        $this->loadModel('CustomerModel');
        $this->loadModel('BookModel');
        $this->loadModel('OrderModel');
        $this->customerModel = new CustomerModel();
        $this->bookModel = new BookModel();
        $this->orderModel = new OrderModel();
        $this->info = $this->customerModel->getById($_SESSION['customer']['customer_id']);
        $this->customerId = $_SESSION['customer']['customer_id'];
    }

    public function redirectOrder() {
        $orders = $this->orderModel->getAllOrderByCustomerId($this->customerId);
        return $this->view('frontend.accounts.order', ['orders' => $orders, 'info' => $this->info]);
    }

    public function redirectInfo() {
        $customer = $this->customerModel->getById($this->customerId);
        return $this->view('frontend.accounts.info', ['customer' => $customer, 'info' => $this->info]);
    }

    public function redirectComment() {
        $books = $this->bookModel->getAllBookByCustomerId($this->customerId);
        return $this->view('frontend.accounts.comment', ['books' => $books, 'info' => $this->info]);
    }

    public function redirectAddress() {
        $address = $this->customerModel->getCustomerAddressById($this->customerId);
        return $this->view('frontend.accounts.address', ['address' => $address, 'info' => $this->info]);
    }

    public function redirectFavourite() {
        $books = $this->bookModel->getAllFavouriteBookByCustomerId($this->customerId);
        return $this->view('frontend.accounts.favourite', ['books' => $books, 'info' => $this->info]);
    }

    public function orderDetail() {
        $orderId = $_GET['order-id'];
        $order = $this->orderModel->findById($orderId);
        $orderDetails = $this->orderModel->getAllOrderDetailByOrderId($orderId);
        return $this->view('frontend.accounts.order-detail', ['order' => $order, 'orderDetails' => $orderDetails, 'info' => $this->info]);
    }
}
