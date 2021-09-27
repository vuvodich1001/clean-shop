<?php 

class AdminController extends BaseController {
    public function index() {
        $this->view('admin.index');

        print("Hello World!");
    }
}