<?php

class CartController extends BaseController {
    private $bookModel;
    private $customerModel;
    public function __construct() {
        $this->loadModel('BookModel');
        $this->loadModel('CustomerModel');
        $this->bookModel = new BookModel();
        $this->customerModel = new CustomerModel();
        session_start();
    }
    public function index() {
        $carts = '';
        $total = 0;
        if (isset($_SESSION['cart'])) {
            $carts = $_SESSION['cart'];
            $total = array_reduce($_SESSION['cart'], function ($acc, $value) {
                return $acc + $value['book']['price'] * $value['quantity'];
            }, 0);
        }
        return empty($carts) ?  $this->view('frontend.carts.index') : $this->view('frontend.carts.index', ['carts' => $carts, 'total' => $total]);
    }

    public function addToCart() {
        $bookId = $_GET['id'];
        $book = $this->bookModel->getById($bookId);
        if (isset($_SESSION['cart'])) {
            $flag = false;
            foreach ($_SESSION['cart'] as &$cart) {
                if ($cart['book']['book_id'] == $bookId) {
                    $cart['quantity'] += 1;
                    $flag = true;
                }
            }

            if (!$flag) {
                array_push($_SESSION['cart'], ['book' => $book, 'quantity' => 1]);
            }
        } else {
            $_SESSION['cart'] = [];
            array_push($_SESSION['cart'], ['book' => $book, 'quantity' => 1]);
        }
    }

    public function increaseQuantity() {
        $bookId = $_GET['id'];
        foreach ($_SESSION['cart'] as &$cart) {
            if ($cart['book']['book_id'] == $bookId) {
                $cart['quantity'] += 1;
            }
        }
        $total = array_reduce($_SESSION['cart'], function ($acc, $value) {
            return $acc + $value['book']['price'] * $value['quantity'];
        }, 0);
        // remove voucher
        if (isset($_SESSION['voucher'])) unset($_SESSION['voucher']);
        echo json_encode($total);
    }

    public function decreaseQuantity() {
        $bookId = $_GET['id'];
        foreach ($_SESSION['cart'] as &$cart) {
            if ($cart['book']['book_id'] == $bookId) {
                $cart['quantity'] -= 1;
            }
        }
        $total = array_reduce($_SESSION['cart'], function ($acc, $value) {
            return $acc + $value['book']['price'] * $value['quantity'];
        }, 0);
        // remove voucher
        if (isset($_SESSION['voucher'])) unset($_SESSION['voucher']);
        echo json_encode($total);
    }

    public function deleteCartItem() {
        $bookId = $_GET['id'];
        foreach ($_SESSION['cart'] as $key => $cart) {
            if ($cart['book']['book_id'] == $bookId) {
                unset($_SESSION['cart'][$key]);
            }
        }
        $total = array_reduce($_SESSION['cart'], function ($acc, $value) {
            return $acc + $value['book']['price'] * $value['quantity'];
        }, 0);
        // remove voucher
        if (isset($_SESSION['voucher'])) unset($_SESSION['voucher']);
        echo json_encode($total);
    }

    public function redirectCheckout() {
        $subTotal = array_reduce($_SESSION['cart'], function ($acc, $value) {
            return $acc + $value['book']['price'] * $value['quantity'];
        }, 0);
        $coupon = $_SESSION['voucher'] ?? 0;
        $shippingFee = $subTotal * 0.05;
        $total = $subTotal + $subTotal * 0.05 - $coupon;
        // session order fee
        $_SESSION['order']['total'] = $total;
        $_SESSION['order']['shippingFee'] = $shippingFee;
        $_SESSION['order']['subtotal'] = $subTotal;
        $_SESSION['order']['discount'] = $coupon;
        $address = $this->customerModel->getCustomerAddressById($_SESSION['customer']['customer_id']);
        return $this->view('frontend.carts.checkout', [
            'carts' => $_SESSION['cart'],
            'total' => $total,
            'subTotal' => $subTotal,
            'address' => $address,
            'coupon' => $coupon,
            'shippingFee' => $shippingFee
        ]);
    }
    public function removeCart() {
        session_destroy();
    }
    public function viewCart() {
    }
}
