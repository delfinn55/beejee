<?php

namespace App\Models;

use App\Core\Model;

class User extends Model {
    /**
     * Insert a new user.
     *
     * @param string $name
     * @param string $email
     * @return string
     */
    public function insert(string $name, string $email): string
    {
        $query = "INSERT INTO users (name, email, password, is_admin) VALUES (:name, :email, '', 0)";
        $stmt = $this->prepare($query);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);

        $stmt->execute();

        return $this->dbh->lastInsertId();
    }

}

