<?php
class DiscountModel extends BaseModel {
    const TABLE = 'discount';

    public function getAll($select = ['*'], $orderBy = [], $limit = 15) {
        return $this->all(self::TABLE, $select, $orderBy, $limit);
    }

    public function addVoucher($data) {
        $this->create(self::TABLE, $data);
    }

    public function checkVoucher($code) {
        $sql = "select * from discount where code=:code limit 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['code' => $code]);
        return $stmt->fetch();
    }

    public function deleteVoucher($id) {
        $this->destroy(self::TABLE, $id);
    }
}
