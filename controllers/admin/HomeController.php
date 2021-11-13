<?php
class HomeController extends BaseController {
    private $orderModel;
    private $reviewModel;
    public function __construct() {
        parent::__construct();
        $this->loadModel('OrderModel');
        $this->loadModel('ReviewModel');
        $this->orderModel = new OrderModel();
        $this->reviewModel = new ReviewModel();
        $this->userId = $_SESSION['user']['user_id'];
    }

    public function index() {
        $roles = $this->getUserModel()->getAllRoleByUserId($this->userId);
        $orders = $this->orderModel->getAll(['*'], ['order_date desc'], 5);
        $reviews = $this->reviewModel->getAll(['*'], ['review_time desc'], 5);
        return $this->view('admin.home.index', ['orders' => $orders, 'reviews' => $reviews, 'roles' => $roles]);
    }
}
