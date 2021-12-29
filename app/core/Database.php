<?php

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db_name = DB_NAME;

    private $dbh; // data base handler
    private $stmt; // statement

    public function __construct() {
        // data source name
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;

        // option biasanya untuk optimisasi koneksi ke database
        $option = [
            PDO::ATTR_PERSISTENT => true, // supaya koneksi ke db nya terjaga terus
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // nampilin exception
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $option);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // method query generic, bisa buat query apa aja
    public function query($query) {
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($type):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute() {
        $this->stmt->execute();
    }

    // buat return data yg banyak (TIDAK SATU)
    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // buat return data yg cuma SATU
    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount() {
        $count = $this->stmt->rowCount();
        // print('Rows affected: ' . $count . 'rows.\n');
        return $count;
    }
}