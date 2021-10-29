<?php

class Database {
    const HOST = 'localhost';
    const USERNAME = 'root';
    const PASSWORD = '';
    const DB_NAME = 'store_dev';

    public function connect() {
        $connect = mysqli_connect(self::HOST, self::USERNAME, self::PASSWORD, self::DB_NAME);
        return mysqli_connect_errno() === 0 ? $connect : false;
    }
}
