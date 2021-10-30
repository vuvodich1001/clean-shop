<?php

class BookModel extends BaseModel {
    const TABLE = 'book';
    public function getAll($select = ['*'], $orderBy = [], $limit = 15) {
        return $this->all(self::TABLE, $select, $orderBy, $limit);
    }

    public function getById($id) {
        return $this->find(self::TABLE, $id);
    }

    public function getCategoryNameById($id) {
        $sql = "select * from book b join category c on b.category_id = c.category_id where b.book_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch()['name'];
    }

    public function createBook($data) {
        return $this->create(self::TABLE, $data);
    }

    public function updateBook($id, $data) {
        return $this->update(self::TABLE, $id, $data);
    }

    public function deleteBook($id) {
        return $this->destroy(self::TABLE, $id);
    }

    public function getByCategory($category) {
        $sql = '';
        $stmt = '';
        if ($category == 'All') {
            $sql = "select * from book limit 10";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
        } else {
            $sql = "select * from book b join category c on b.category_id = c.category_id where name=:name limit 10";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['name' => $category]);
        }
        $data = [];
        while ($row = $stmt->fetch()) {
            $data[] = $row;
        }
        return $data;
    }

    public function filterBook($sortby, $categoryName) {
        $sql = '';
        $stmt = '';
        if ($categoryName == 'All') {
            $sql = "select * from book order by $sortby limit 10";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
        } else {
            $sql = "select * from book b join category c on b.category_id = c.category_id where c.name = :name order by :sortby limit 10";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['name' => $categoryName, 'sortby' => $sortby]);
        }
        $data = [];
        while ($row = $stmt->fetch()) {
            $data[] = $row;
        }
        return $data;
    }

    public function numPage($limit) {
        $sql = "select * from book";
        $result = $this->db->query($sql);
        $num = ceil($result->rowCount() / $limit);
        return $num;
    }

    public function pagination($page, $category) {
        $num = $page * 10 - 10;
        if ($category == 'All') {
            $sql = "select * from book limit $num, 10";
        } else {
            $sql = "select * from book b join category c on b.category_id = c.category_id where c.name = :category limit :num, 10";
        }
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['name' => $category, 'page' => $page]);
        $books = [];
        while ($row = $stmt->fetch()) {
            $books[] = $row;
        }
        return $books;
    }

    public function searchBook($name) {
        $sql = "select * from book where title like :name limit 10";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['name' => '%' . $name . '%']);
        $books = [];
        while ($row = $stmt->fetch()) {
            $books[] = $row;
        }
        return $books;
    }
}
