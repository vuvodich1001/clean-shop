<?php
class BookController extends BaseController {

    private $bookModel;
    private $categoryModel;
    private $reviewModel;
    public function __construct() {
        parent::__construct();
        $this->loadModel('BookModel');
        $this->loadModel('CategoryModel');
        $this->loadModel('ReviewModel');
        $this->bookModel = new BookModel();
        $this->categoryModel = new CategoryModel();
        $this->userId = $_SESSION['user']['user_id'];
    }
    // admin
    public function index() {
        // $order = [
        // 'column' => 'book_id',
        // 'order' => 'desc'
        // ];
        $books = $this->bookModel->getAll(['*'], [], 100);
        $categories = $this->categoryModel->getAll();
        $roles = $this->getUserModel()->getAllRoleByUserId($this->userId);
        return $this->view('admin.books.show', ['books' => $books, 'categories' => $categories, 'roles' => $roles]);
    }

    public function getAllBook() {
        $books = $this->bookModel->getAll(['*'], [], 100);
        echo json_encode($books);
    }

    // upload 1 files
    // private function insertFile($selector) {
    //     $uploads_dir = $_SERVER['DOCUMENT_ROOT'] . '/mvc-php/public/admin/uploads/';
    //     $file_error = $_FILES[$selector]['error'];
    //     if ($file_error == UPLOAD_ERR_OK) {
    //         $tmp_name = $_FILES[$selector]['tmp_name'];
    //         $name = basename($_FILES[$selector]['name']);
    //         if (file_exists($uploads_dir . $name)) {
    //             // do nothing
    //         } else
    //             move_uploaded_file($tmp_name, $uploads_dir . $name);
    //     }
    // }
    // uploads lots of file
    private function insertFile($error, $tempName, $name) {
        $uploads_dir = $_SERVER['DOCUMENT_ROOT'] . '/clean-shop/public/admin/uploads/';
        if ($error == UPLOAD_ERR_OK) {
            $name = basename($name);
            if (!file_exists($uploads_dir . $name))
                move_uploaded_file($tempName, $uploads_dir . $name);
        }
    }

    public function createBook() {
        $title = $_POST['title'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $publishDate = $_POST['publish-date'];
        $subCategoryId = $_POST['subcategory'];
        $categoryId = $_POST['category'];
        $bookImages = [];
        if (isset($_FILES['images'])) {
            $images = $_FILES['images']['name'];
            for ($i = 0; $i < count($images); $i++) {
                $error = $_FILES['images']['error'][$i];
                $tempName = $_FILES['images']['tmp_name'][$i];
                $name = $_FILES['images']['name'][$i];
                $this->insertFile($error, $tempName, $name);
                $bookImages[] = $name;
            }
            $bookImages = implode(',', $bookImages);
        }
        $data = [
            'subcategory_id' => $subCategoryId,
            'category_id' => $categoryId,
            'title' => $title,
            'main_image' => $bookImages,
            'price' => $price,
            'description' => $description,
            'publish_date' => $publishDate,
        ];
        $this->bookModel->createBook($data);
        $books = $this->bookModel->getAll();
        // $categories = $this->categoryModel->getAll();
        // return $this->view('admin.books.show', ['books' => $books, 'categories' => $categories]);
        echo json_encode($books);
    }

    public function updateBook() {
        $id = $_GET['id'];
        // update book
        $categoryId = $_POST['category'];
        $subCategoryId = $_POST['subcategory'];
        $title = $_POST['title'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $publishDate = $_POST['publish-date'];
        $data = [
            'category_id' => $categoryId,
            'subcategory_id' => $subCategoryId,
            'title' => $title,
            'price' => $price,
            'description' => $description,
            'publish_date' => $publishDate,
        ];
        $this->bookModel->updateBook($id, $data);
        $books = $this->bookModel->getAll(['*'], [], 100);
        echo json_encode($books);
    }

    public function deleteBook() {
        $id = $_GET['id'];
        $uploads_dir = $_SERVER['DOCUMENT_ROOT'] . '/clean-shop/public/admin/uploads/';
        $image = $this->bookModel->getById($id)['main_image'];
        $this->bookModel->deleteBook($id);
        unlink($uploads_dir . $image);
        $books = $this->bookModel->getAll();
        // $categories = $this->categoryModel->getAll();
        // return $this->view('admin.books.show', ['books' => $books, 'categories' => $categories]);
        echo json_encode($books);
    }

    public function searchBook() {
        $name = $_GET['name'];
        $books = $this->bookModel->searchBook($name);
        echo json_encode($books);
    }
}
