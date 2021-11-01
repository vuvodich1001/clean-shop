<?php

class AccountController extends BaseController {

    private $customerModel;
    private $bookModel;
    public function __construct() {
        session_start();
        $this->loadModel('CustomerModel');
        $this->loadModel('BookModel');
        $this->customerModel = new CustomerModel();
        $this->bookModel = new BookModel();
    }

    public function redirectOrder() {
        return $this->view('frontend.accounts.order');
    }

    public function redirectInfo() {
        $customerId = $_SESSION['customer']['customer_id'];
        $customer = $this->customerModel->getById($customerId);
        return $this->view('frontend.accounts.info', ['customer' => $customer]);
    }

    public function redirectComment() {
        return $this->view('frontend.accounts.comment');
    }

    public function redirectAddress() {
        $address = $this->customerModel->getCustomerAddressById($_SESSION['customer']['customer_id']);
        return $this->view('frontend.accounts.address', ['address' => $address]);
    }

    public function redirectFavourite() {
        $customerId = $_SESSION['customer']['customer_id'];
        $books = $this->bookModel->getAllFavouriteBookByCustomerId($customerId);
        return $this->view('frontend.accounts.favourite', ['books' => $books]);
    }
}
