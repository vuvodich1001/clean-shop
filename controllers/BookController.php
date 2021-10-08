<?php
class BookController extends BaseController {

    private $bookModel;
    private $categoryModel;
    public function __construct() {
        $this->loadModel('BookModel');
        $this->loadModel('CategoryModel');
        $this->bookModel = new BookModel();
        $this->categoryModel = new CategoryModel();
    }

    // admin
    public function index() {
        // $order = [
        //     'column' => 'book_id',
        //     'order' => 'desc'
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
            'author' =>  $author,
            'image' => $image,
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
            'author' =>  $author,
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

    // frontend
    public function getByCategory() {
        $categoryName = $_GET['category'];
        $books = $this->bookModel->getByCategory($categoryName);
        echo json_encode($books);
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
        $categoryName  = $this->bookModel->getCategoryNameById($bookId);
        $bookRelates = $this->bookModel->getByCategory($categoryName);
        $this->view('frontend.home.detail', ['book' => $book, 'bookRelates' => $bookRelates]);
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
}
