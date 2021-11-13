<?php

class CategoryController extends BaseController {
    private $categoryModel;
    public function __construct() {
        parent::__construct();
        $this->loadModel('CategoryModel');
        $this->categoryModel = new CategoryModel();
        $this->userId = $_SESSION['user']['user_id'];
    }

    public function index() {
        $categories = $this->categoryModel->getAll();
        $roles = $this->getUserModel()->getAllRoleByUserId($this->userId);
        return $this->view('admin.categories.show', ['categories' => $categories, 'roles' => $roles]);
    }

    public function getAllCategory() {
        $categories = $this->categoryModel->getAll();
        echo json_encode($categories);
    }

    public function searchCategory() {
        $str = $_GET['str'];
        $categories = $this->categoryModel->searchCategory($str);
        echo json_encode($categories);
    }
    public function createCategory() {
        $name = $_POST['name'];
        $data = [
            'name' => $name
        ];

        $this->categoryModel->createCategory($data);
        $categories = $this->categoryModel->getAll();
        echo json_encode($categories);
        // return $this->view('admin.categories.show', ['categories' => $categories]);
    }

    public function deleteCategory() {
        $id = $_GET['id'];
        $this->categoryModel->deleteCategory($id);
        $categories = $this->categoryModel->getAll();
        // return $this->view('admin.categories.show', ['categories' => $categories]);
        echo json_encode($categories);
    }
    // modify category
    public function directCategory() {
        $id = $_GET['id'];
        $category = $this->categoryModel->findById($id);
        return $this->view('admin.categories.modifycategory', ['category' => $category]);
    }

    public function updateCategory() {
        $id = $_GET['id'];
        $name = $_POST['name'];
        $data = [
            'name' => $name
        ];
        $this->categoryModel->updateCategory($id, $data);
        $categories = $this->categoryModel->getAll();
        // return $this->view('admin.categories.show', ['categories' => $categories]);
        echo json_encode($categories);
    }
}
