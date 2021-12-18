<?php
class BookController extends BaseController {

    private $bookModel;
    private $reviewModel;
    public function __construct() {
        session_start();
        $this->loadModel('BookModel');
        $this->loadModel('ReviewModel');
        $this->bookModel = new BookModel();
        $this->reviewModel = new ReviewModel();
    }
    // frontend
    public function getByCategory() {
        $categoryName = $_GET['category'];
        $books = $this->bookModel->getByCategory($categoryName);
        echo json_encode($books);
    }

    public function getById() {
        $bookId = $_GET['book-id'];
        $book = $this->bookModel->getById($bookId);
        echo json_encode($book);
    }

    public function filterBook() {
        $sortby = $_GET['sortby'];
        $categoryName = $_GET['category'];
        $books = $this->bookModel->filterBook($sortby, $categoryName);
        echo json_encode($books);
    }

    public function bookDetail() {
        $bookId = $_GET['id'];
        $book = $this->bookModel->getById($bookId);
        $quantitySaled = $this->bookModel->countBookSaled($bookId);
        $categoryName  = $this->bookModel->getCategoryNameById($bookId);
        $bookRelates = $this->bookModel->getByCategory($categoryName, $bookId);
        $reviews = $this->reviewModel->getAllReviewByBookId($bookId);
        $statistics = $this->reviewModel->statisticReview($bookId);
        $totalReview = $this->reviewModel->totalReview($bookId);
        $this->view('frontend.home.detail', [
            'book' => $book,
            'bookRelates' => $bookRelates,
            'quantitySaled' => $quantitySaled,
            'reviews' => $reviews,
            'statistics' => $statistics,
            'totalReview' => $totalReview
        ]);
    }

    public function pagination() {
        $page = $_GET['page'];
        $category = $_GET['category'];
        $books =  $this->bookModel->pagination($page, $category);
        echo json_encode($books);
    }

    public function searchBook() {
        $name = $_GET['name'];
        $books = $this->bookModel->searchBook($name);
        echo json_encode($books);
    }

    public function addfavouriteBook() {
        $bookId = $_GET['book-id'];
        $customerId = 0;
        if (isset($_SESSION['customer'])) {
            $customerId = $_SESSION['customer']['customer_id'];
        } else {
            echo json_encode($customerId);
            return;
        }
        $data = [
            'customer_id' => $customerId,
            'book_id' => $bookId
        ];
        $this->bookModel->createfavouriteBook($data);
        echo json_encode(1);
    }

    public function removeFavouriteBook() {
        $bookId = $_GET['book-id'];
        $customerId = $_SESSION['customer']['customer_id'];
        $data = [
            'book_id' => $bookId,
            'customer_id' => $customerId
        ];
        $this->bookModel->deleteFavouriteBook($data);
    }
}
