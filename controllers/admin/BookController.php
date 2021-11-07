<?php
class BookController extends BaseController {

    private $bookModel;
    private $categoryModel;
    private $reviewModel;
    public function __construct() {
        session_start();
        $this->loadModel('BookModel');
        $this->loadModel('CategoryModel');
        $this->loadModel('ReviewModel');
        $this->bookModel = new BookModel();
        $this->categoryModel = new CategoryModel();
    }

    // admin
    public function index() {
        // $order = [
        // 'column' => 'book_id',
        // 'order' => 'desc'
        // ];
        $books = $this->bookModel->getAll();
        $categories = $this->categoryModel->getAll();
        return $this->view('admin.books.show', ['books' => $books, 'categories' => $categories]);
    }

    public function getAllBook() {
        $books = $this->bookModel->getAll();
        echo json_encode($books);
    }

    private function insertFile($selector) {
        $uploads_dir = $_SERVER['DOCUMENT_ROOT'] . '/mvc-php/public/admin/uploads/';
        $file_error = $_FILES[$selector]['error'];
        if ($file_error == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES[$selector]['tmp_name'];
            $name = basename($_FILES[$selector]['name']);
            if (file_exists($uploads_dir . $name)) {
                // do nothing
            } else
                move_uploaded_file($tmp_name, $uploads_dir . $name);
        }
    }

    public function createBook() {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $price = $_POST['price'];
        $image = basename($_FILES['image']['name']);
        $description = $_POST['description'];
        $categoryId = $_POST['category'];
        $this->insertFile('image');
        $data = [
            'category_id' => $categoryId,
            'title' => $title,
            'author' => $author,
            'main_image' => $image,
            'price' => $price,
            'description' => $description
        ];
        $this->bookModel->createBook($data);
        $books = $this->bookModel->getAll();
        // $categories = $this->categoryModel->getAll();
        // return $this->view('admin.books.show', ['books' => $books, 'categories' => $categories]);
        echo json_encode($books);
    }

    public function updateBook() {
        $id = $_GET['id'];
        $categoryId = $_POST['category'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $data = [
            'category_id' => $categoryId,
            'title' => $title,
            'author' => $author,
            'price' => $price,
            'description' => $description
        ];
        $this->bookModel->updateBook($id, $data);
        $books = $this->bookModel->getAll();
        echo json_encode($books);
    }

    public function deleteBook() {
        $id = $_GET['id'];
        $uploads_dir = $_SERVER['DOCUMENT_ROOT'] . '/mvc-php/public/admin/uploads/';
        $image = $this->bookModel->getById($id)['image'];
        $this->bookModel->deleteBook($id);
        unlink($uploads_dir . $image);
        $books = $this->bookModel->getAll();
        // $categories = $this->categoryModel->getAll();
        // return $this->view('admin.books.show', ['books' => $books, 'categories' => $categories]);
        echo json_encode($books);
    }

    public function show() {
        $this->view('frontend.Books.show');
    }
}
