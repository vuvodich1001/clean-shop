<?php

class CategoryModel extends BaseModel {
    const TABLE = 'category';
    public function getAll($select = ['*'], $orderBy = [], $limit = 15) {
        return $this->all(self::TABLE, $select = ['*'], $orderBy = [], $limit = 15);
    }

    public function createCategory($data) {
        $this->create(self::TABLE, $data);
    }
    public function findById($id) {
        return $this->find(self::TABLE, $id);
    }

    public function deleteCategory($id) {
        $this->destroy(self::TABLE, $id);
    }

    public function updateCategory($id, $data) {
        $this->update(self::TABLE, $id, $data);
    }

    public function findIndexByCategoryName($category) {
        $sql = "select * from category where name = '$category'";
        $result = $this->query($sql);
        $row = mysqli_fetch_assoc($result);
        return $row['category_id'];
    }
}