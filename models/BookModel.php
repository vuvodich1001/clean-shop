<?php 

class BookModel extends BaseModel{
    const TABLE = 'book';
    public function getAll($select = ['*'], $orderBy = [], $limit = 15) {
        return $this->all(self::TABLE, $select, $orderBy, $limit);
    }

    public function getById($id) {
       return $this->find(self::TABLE, $id);
    }
    
    public function getCategoryNameById($id) {
        $sql = "select * from book b join category c on b.category_id = c.category_id where b.book_id = $id";
        $result = $this->query($sql);
        return mysqli_fetch_assoc($result)['name'];
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
        if($category == 'All') {
            $sql = "select * from book limit 10";
        }
        else{
            $sql = "select * from book b join category c on b.category_id = c.category_id where name='$category' limit 10";
        }
        $result = $this->query($sql);
        $data = [];
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function filterBook($sortby, $categoryName) {
        $sql = '';
        if($categoryName == 'All') {
            $sql = "select * from book order by $sortby limit 10";
        }
        else {
            $sql = "select * from book b join category c on b.category_id = c.category_id where c.name = '$categoryName' order by $sortby limit 10";
        }
        $result = $this->query($sql);
        $data = [];
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    public function numPage($limit) {
        $sql = "select * from book";
        $result = $this->query($sql);
        $num = ceil(mysqli_num_rows($result)/$limit);
        return $num;
    }

    public function pagination($page, $category)  {
        $num = $page*10 - 10;
        if($category == 'All') {
            $sql = "select * from book limit $num, 10";
        }
        else {
            $sql = "select * from book b join category c on b.category_id = c.category_id where c.name = '$category' limit $num, 10";
        }
        $result = $this->query($sql);
        $books = [];
        while($row = mysqli_fetch_assoc($result)) {
            $books[] = $row;
        }
        return $books;
    }

    public function searchBook($name) {
        $sql = "select * from book where title like '%$name%' limit 10";
        $result = $this->query($sql);
        $books = [];
        while($row = mysqli_fetch_assoc($result)) {
            $books[] = $row;
        }

        return $books;
    }
}  
?>