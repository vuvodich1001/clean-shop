<?php

class Database {
    const HOST = 'localhost';
    const USERNAME = 'root';
    const PASSWORD = '';
    const DB_NAME = 'bookstore';

    public function connect() {
        $connect = mysqli_connect(self::HOST, self::USERNAME, self::PASSWORD, self::DB_NAME);
        return mysqli_connect_errno() === 0 ? $connect : false;
    }
}