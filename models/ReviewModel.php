<?php

class ReviewModel extends BaseModel {
    const TABLE = 'review';
    public function createReview($data) {
        $this->create(self::TABLE, $data);
    }

    public function getAll($select = ['*'], $orderBy = [], $limit = 15) {
        return $this->all(self::TABLE, $select, $orderBy, $limit);
    }

    public function getAllReviewByBookId($bookId) {
        $sql = "select * from review r join customer c on r.customer_id = c.customer_id where book_id = :book_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['book_id' => $bookId]);
        $reviews = [];
        while ($row = $stmt->fetch()) {
            $reviews[] = $row;
        }
        return $reviews;
    }

    public function statisticReview($bookId) {
        $sql = "select rating , count(*) as 'quantity' 
                from book b join review r on b.book_id = r.book_id 
                where b.book_id = :book_id
                group by rating";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['book_id' => $bookId]);
        $statistics = [];
        while ($row = $stmt->fetch()) {
            $statistics[] = $row;
        }
        return $statistics;
    }

    public function totalReview($bookId) {
        $sql = "select * from review where book_id = :book_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['book_id' => $bookId]);
        return $stmt->rowCount();
    }
}
