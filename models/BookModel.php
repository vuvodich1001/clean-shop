<?php

// use function PHPSTORM_META\sql_injection_subst;

class BookModel extends BaseModel {
    const TABLE = 'book';
    const TABLE_FAVOURITE = 'favourite_book';
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

    public function getByCategory($category, $bookId = 0) {
        $sql = '';
        $stmt = '';
        if ($category == 'All') {
            $sql = "select b.*, round(avg(rating), 0) as rating, sum(quantity) as sale_quantity
                from book b 
                left join order_detail o on b.book_id = o.book_id 
                left join book_order bo on bo.order_id = o.order_id 
                left join review r on b.book_id = r.book_id 
                group by b.book_id 
                limit 10";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
        } else {
            $sql = "select b.*, round(avg(rating), 0) as rating, sum(quantity) as sale_quantity
                    from book b 
                    join category c on b.category_id = c.category_id
                    left join order_detail o on b.book_id = o.book_id 
                    left join book_order bo on bo.order_id = o.order_id 
                    left join review r on b.book_id = r.book_id 
                    where c.name = :name and b.book_id != :book_id
                    group by b.book_id 
                    limit 10;";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['name' => $category, 'book_id' => $bookId]);
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
            $sql = "select b.*, round(avg(rating), 0) as rating, sum(quantity) as sale_quantity
                    from book b 
                    left join order_detail o on b.book_id = o.book_id 
                    left join book_order bo on bo.order_id = o.order_id 
                    left join review r on b.book_id = r.book_id 
                    group by b.book_id  
                    order by $sortby 
                    limit 10";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
        } else {
            $sql = "select b.*, round(avg(rating), 0) as rating, sum(quantity) as sale_quantity
                    from book b 
                    join category c on b.category_id = c.category_id 
                    left join order_detail o on b.book_id = o.book_id 
                    left join book_order bo on bo.order_id = o.order_id 
                    left join review r on b.book_id = r.book_id 
                    where c.name = :name 
                    group by b.book_id 
                    order by $sortby
                    limit 10";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['name' => $categoryName]);
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
        $stmt = '';
        if ($category == 'All') {
            $sql = "select b.*, round(avg(rating), 0) as rating, sum(quantity) as sale_quantity
                    from book b
                    left join order_detail o on b.book_id = o.book_id 
                    left join book_order bo on bo.order_id = o.order_id 
                    left join review r on b.book_id = r.book_id 
                    group by b.book_id  
                    limit :num, 10";
            // bug of pdo
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':num', $num, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            $sql = "select b.*, round(avg(rating), 0) as rating, sum(quantity) as sale_quantity
                    from book b 
                    join category c on b.category_id = c.category_id
                    left join order_detail o on b.book_id = o.book_id 
                    left join book_order bo on bo.order_id = o.order_id 
                    left join review r on b.book_id = r.book_id 
                    where c.name = :name 
                    group by b.book_id  
                    limit :num, 10";
            // bug of pdo
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':name', $category, PDO::PARAM_STR);
            $stmt->bindParam(':num', $num, PDO::PARAM_INT);
            $stmt->execute();
        }
        $books = [];
        while ($row = $stmt->fetch()) {
            $books[] = $row;
        }
        return $books;
    }

    public function searchBook($name) {
        $sql = "select b.*, sum(quantity) as sale_quantity
                from book b
                left join order_detail o on b.book_id = o.book_id 
                left join book_order bo on bo.order_id = o.order_id
                where title like :name 
                group by b.book_id
                limit 10";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['name' => '%' . $name . '%']);
        $books = [];
        while ($row = $stmt->fetch()) {
            $books[] = $row;
        }
        return $books;
    }

    public function createFavouriteBook($data) {
        // check if book and customer already exists in db;
        $sql = "select * from favourite_book where customer_id = :customer_id and book_id = :book_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
        if ($stmt->rowCount() >= 1) return;
        $this->create(self::TABLE_FAVOURITE, $data);
    }

    public function getAllFavouriteBookByCustomerId($customerId) {
        $sql = "select b.*, count(review_id) as 'review_quantity' 
                from favourite_book f join book b on f.book_id = b.book_id left join review r on f.book_id = r.book_id
                where f.customer_id = :customer_id
                group by b.book_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['customer_id' => $customerId]);
        // get all bookid
        $books = [];
        while ($row = $stmt->fetch()) {
            $books[] = $row;
        }
        return $books;
    }

    public function deleteFavouriteBook($data) {
        $sql = "delete from favourite_book where book_id = :book_id and customer_id = :customer_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
    }

    public function getAllBookByCustomerId($customerId) {
        $sql = "select distinct b.* 
                from book_order bo join order_detail od on bo.order_id = od.order_id join 
                book b on od.book_id = b.book_id 
                where bo.customer_id = :customer_id and 
                bo.status = 'Giao hàng thành công'
                and
                b.book_id not in (select book_id from review r where r.customer_id = :customer_id)
                group by b.book_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['customer_id' => $customerId]);
        $books = [];
        while ($row = $stmt->fetch()) {
            $books[] = $row;
        }

        foreach ($books as &$book) {
            $sql = "select count(*) as 'quantity'
                    from review
                    where book_id = :book_id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['book_id' => $book['book_id']]);
            $book['review_quantity'] = $stmt->fetch()['quantity'];
        }
        return $books;
    }

    public function countBookSaled($bookId) {
        $sql = "select sum(quantity) as quantity from order_detail o join book b on o.book_id = b.book_id
                where b.book_id = :book_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['book_id' => $bookId]);
        return $stmt->fetch()['quantity'];
    }
}
