<?php

class HomeController extends BaseController {
    private $bookModel;

    public function index() {
        $this->loadModel('BookModel');
        $this->bookModel = new BookModel();
        $num = $this->bookModel->numPage(10);
        $this->view('frontend.home.index', ['num' => $num]);
    }
}
