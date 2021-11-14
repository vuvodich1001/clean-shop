<?php
class HomeController extends BaseController {
    private $orderModel;
    private $reviewModel;
    private $customerModel;
    public function __construct() {
        parent::__construct();
        $this->loadModel('OrderModel');
        $this->loadModel('ReviewModel');
        $this->loadModel('CustomerModel');
        $this->orderModel = new OrderModel();
        $this->reviewModel = new ReviewModel();
        $this->customerModel = new CustomerModel();
        $this->userId = $_SESSION['user']['user_id'];
    }

    public function index() {
        $roles = $this->getUserModel()->getAllRoleByUserId($this->userId);
        $orders = $this->orderModel->getAll(['*'], ['order_date desc'], 5);
        $reviews = $this->reviewModel->getAll(['*'], ['review_time desc'], 5);
        $totalCustomer = count($this->customerModel->getAll(['*'], [], 50));
        $totalReview = count($this->reviewModel->getAll(['*'], [], 50));
        $totalOrder = count($this->orderModel->getAll(['*'], [], 50));
        $revenue = $this->orderModel->revenue();
        $statistics = [
            'totalCustomer' => $totalCustomer,
            'totalReview' => $totalReview,
            'totalOrder' => $totalOrder,
            'revenue' => $revenue
        ];

        $pendingOrders = array_filter($this->orderModel->getAll(), fn ($order) => $order['status'] == 'Đang xử lí' ? true : false);
        $pendingReviews = array_filter($this->reviewModel->getAll(), function ($review) {
            $dayReview = date('d', strtotime($review['review_time']));
            $dayNow = date('d', time());
            return $dayReview == $dayNow ? true : false;
        });

        $notifications = [
            'pendingOrders' => $pendingOrders,
            'pendingReviews' => $pendingReviews
        ];

        $textColors = [
            'Đang xử lí' => 'text-primary',
            'Đã thanh toán' => 'text-warning',
            'Giao hàng thành công' => 'text-success',
            'Đang giao hàng' => 'text-info',
            'Đã hủy' => 'text-danger'
        ];

        return $this->view('admin.home.index', [
            'orders' => $orders,
            'reviews' => $reviews,
            'roles' => $roles,
            'statistics' => $statistics,
            'notifications' => $notifications,
            'textColors' => $textColors
        ]);
    }
}
