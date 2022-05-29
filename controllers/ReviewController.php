<?php

class ReviewController  extends BaseController {
    private $reviewModel;
    private $customerId;
    public function __construct() {
        session_start();
        $this->loadModel('ReviewModel');
        $this->reviewModel = new ReviewModel();
        $this->customerId = $_SESSION['customer']['customer_id'];
    }

    private function insertFile($error, $tempName, $name) {
        $uploads_dir = $_SERVER['DOCUMENT_ROOT'] . '/clean-shop/public/frontend/review-images/';
        if ($error == UPLOAD_ERR_OK) {
            $name = basename($name);
            if (!file_exists($uploads_dir . $name))
                move_uploaded_file($tempName, $uploads_dir . $name);
        }
    }

    public function createReview() {
        $headLine = $_POST['headLine'];
        $comment = $_POST['comment'];
        $rating = $_POST['rating'];
        $bookId = $_POST['bookId'];
        $photoNames = [];
        if (isset($_FILES['photos'])) {
            $photos = $_FILES['photos']['name'];
            for ($i = 0; $i < count($photos); $i++) {
                $error = $_FILES['photos']['error'][$i];
                $tempName = $_FILES['photos']['tmp_name'][$i];
                $name = $_FILES['photos']['name'][$i];
                $this->insertFile($error, $tempName, $name);
                $photoNames[] = $name;
            }
            $photoNames = implode(',', $photoNames);
        }
        $data = [
            'book_id' => $bookId,
            'customer_id' => $this->customerId,
            'headline' => $headLine,
            'rating' => $rating,
            'image' => empty($photoNames) ? '' : $photoNames,
            'comment' => $comment
        ];

        $this->reviewModel->createReview($data);

        echo json_encode(1);
    }
}
