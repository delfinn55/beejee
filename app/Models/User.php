<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class User extends Model {

    /**
     * Get user by email.
     *
     * @param string $email
     * @return mixed
     */
    public function getByEmail(string $email): mixed
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->dbh->prepare($query);

        $stmt->bindParam(':email', $email);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    /**
     * Insert a new user.
     *
     * @param string $name
     * @param string $email
     * @return string
     */
    public function upsert(string $name, string $email): string
    {
        if ($user = $this->getByEmail($email)) {
            return $user['id'];
        }

        $query = "INSERT INTO users (name, email, password, is_admin) VALUES (:name, :email, '', 0)";
        $stmt = $this->prepare($query);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);

        $stmt->execute();

        return (int) $this->dbh->lastInsertId();
    }
}

