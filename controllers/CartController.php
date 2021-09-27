<?php

class CartController extends BaseController {
    private $bookModel;
    
    public function __construct() {
        $this->loadModel('BookModel');
        $this->bookModel = new BookModel();
        session_start();
    }
    public function index() {
        $carts = '';
        isset($_SESSION['cart']) ? $carts = $_SESSION['cart'] : $carts;
        return empty($carts) ?  $this->view('frontend.carts.index') : $this->view('frontend.carts.index', ['carts' => $carts]);
    }

    public function addToCart() {
        $bookId = $_GET['id'];
        $book = $this->bookModel->getById($bookId);
        if(isset($_SESSION['cart'])) {
            $flag = false;
            foreach($_SESSION['cart'] as &$cart) {
                if($cart['book']['book_id'] == $bookId) {
                    $cart['quantity'] += 1;
                    $flag = true;
                }
            }

            if(!$flag) {
                array_push($_SESSION['cart'], ['book' => $book, 'quantity' => 1 ]);
            }
        }
        else {
            $_SESSION['cart'] = [];
            array_push($_SESSION['cart'], ['book' => $book, 'quantity' => 1 ]);
        }
    }

    public function increaseQuantity() {
        $bookId = $_GET['id'];
        foreach($_SESSION['cart'] as &$cart) {
            if($cart['book']['book_id'] == $bookId) {
                $cart['quantity'] += 1;
            }
        }
    }

    public function decreateQuantity() {
        $bookId = $_GET['id'];
        foreach($_SESSION['cart'] as &$cart) {
            if($cart['book']['book_id'] == $bookId) {
                $cart['quantity'] -= 1;
            }
        }
    }

    public function deleteCartItem() {
        $bookId = $_GET['id'];
        foreach($_SESSION['cart'] as $key => $cart) {
            if($cart['book']['book_id'] == $bookId) {
                unset($_SESSION['cart'][$key]);
            }
        }
    }
    
    public function removeCart() {
        session_destroy();
    }
    public function viewCart() {

    }
}