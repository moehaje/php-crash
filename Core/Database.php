<?php

namespace Core;

use PDO;

// connect to MySQL database, and execute a query
class Database {
    public $connection;
    public $statement;
    public function __construct($config, $username = 'root', $password = '') {

        // $dsn = 'mysql:host=' . $config['host'] . ';port=' . $config['port'] . ';dbname=' . $config['database'] . ';charset=' . $config['charset'];


        $dsn = 'mysql:' . http_build_query($config, '', ';');  // host=localhost;port=3306;dbname=myapp
        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);


    }
    public function query($query, $params = []) {

        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);

        return $this;
    }

    public function get() {
        return $this->statement->fetchAll();
    }

    public function find(){
        return $this->statement->fetch();
    }

    public function findOrFail(){
        $result = $this->find();
        if (!$result) {
            abort();
        }

        return $result;
    }
}


