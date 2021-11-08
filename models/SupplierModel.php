<?php

class SupplierModel extends BaseModel {
    const TABLE = 'supplier';
    public function getAll($select = ['*'], $orderBy = [], $limit = 15) {
        return $this->all(self::TABLE, $select, $orderBy, $limit);
    }
}
