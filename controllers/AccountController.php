<?php

class AccountController extends BaseController {
    public function redirectOrder() {
        return $this->view('frontend.accounts.order');
    }

    public function redirectInfo() {
        return $this->view('frontend.accounts.info');
    }

    public function redirectComment() {
        return $this->view('frontend.accounts.comment');
    }
}
