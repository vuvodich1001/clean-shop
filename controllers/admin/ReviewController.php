<?php

class ReviewController extends BaseController {
    private $reviewModel;
    public function __construct() {
        parent::__construct();
        $this->loadModel('ReviewModel');
        $this->reviewModel = new ReviewModel();
        $this->userId = $_SESSION['user']['user_id'];
    }

    public function index() {
        $reviews = $this->reviewModel->getAll();
        $roles = $this->getUserModel()->getAllRoleByUserId($this->userId);
        return $this->view('admin.reviews.show', ['reviews' => $reviews, 'roles' => $roles]);
    }
}
