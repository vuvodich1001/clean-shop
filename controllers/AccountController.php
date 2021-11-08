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

    public function updatePhone() {
        $customer = $this->customerModel->getById($this->customerId);
        return $this->view('frontend.accounts.phone-update', ['phone' => $customer['phone'], 'info' => $this->info]);
    }

    public function updateEmail() {
        $customer = $this->customerModel->getById($this->customerId);
        return $this->view('frontend.accounts.email-update', ['email' => $customer['email'], 'info' => $this->info]);
    }

    public function changePassword() {
        return $this->view('frontend.accounts.password-change', ['info' => $this->info]);
    }

    public function updateInfo() {
        if (array_key_exists('password', $_POST)) {
            $_POST['password'] = md5($_POST['password']);
        }
        $this->customerModel->updateInfo($this->customerId, $_POST);
        $this->redirectInfo();
    }

    public function createNewAddress() {
        $customerId = $this->customerId;
        $firstName = $_POST['firstname'];
        $lastName = $_POST['lastname'];
        $address = $_POST['address'];
        $ward = $_POST['ward'];
        $district = $_POST['district'];
        $city = $_POST['city'];
        $phone = $_POST['phone'];
        $zipcode = $_POST['zipcode'];

        $data = [
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
        $this->customerModel->createNewCustomerAddress($data);
        $this->redirectAddress();
    }

    public function deleteAddress() {
        $id = $_GET['id'];
        $this->customerModel->deleteAddress($id);
    }

    public function cancelOrder() {
        $id = $_GET['id'];
        $this->orderModel->cancelOrder($id);
    }
}
