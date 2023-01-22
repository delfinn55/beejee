<?php

namespace App\Core;

use PDO;
use PDOException;
use PDOStatement;

class Model {

    /**
     * The database handle.
     *
     * @var PDO|null
     */
    protected PDO|null $dbh;

    /**
     * Connect to the database.
     */
    public function __construct()
    {
        // Connect to the database
        $dsn = 'mysql:dbname=bee;host=127.0.0.1';
        $user = 'root';
        $password = 'root';

        try {
            $this->dbh = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            exit;
        }
    }

    /**
     * Prepare a query for execution.
     *
     * @param string $query
     * @return PDOStatement
     */
    protected function prepare(string $query): PDOStatement
    {
        return $this->dbh->prepare($query);
    }

    /**
     * Close the database connection.
     */
    public function __destruct()
    {
        // Close the connection
        $this->dbh = null;
    }
}
