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
        $sth = $this->dbh->prepare($query);

        $sth->bindParam(':email', $email);

        $sth->execute();

        return $sth->fetch(PDO::FETCH_ASSOC);
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
        $sth = $this->prepare($query);

        $sth->bindParam(':name', $name);
        $sth->bindParam(':email', $email);

        $sth->execute();

        return (int) $this->dbh->lastInsertId();
    }

    public function checkCredentials(string $name, string $password): bool
    {
        $query = "SELECT * FROM users WHERE name = :name AND password = :password";
        $sth = $this->dbh->prepare($query);

        $sth->bindParam(':name', $name);
        $sth->bindParam(':password', $password);

        $sth->execute();

        return $sth->rowCount() > 0;
    }
}

