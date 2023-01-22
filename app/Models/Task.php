<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class Task extends Model {
    /**
     * Gets all tasks.
     *
     * @return array
     */
    public function getAll(): array
    {
        $query = "SELECT * FROM tasks";
        $sth = $this->prepare($query);

        $sth->execute();

        return $sth->fetchAll();
    }

    /**
     * Gets filtered tasks.
     *
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getFiltered(int $limit = 0, int $offset = 0): array
    {
        $query = "SELECT t.id,"
            . " u.name AS user_name,"
            . " u.email AS user_email,"
            . " t.description,"
            . " t.is_done"
            . " FROM tasks as t"
            . " JOIN users AS u ON t.user_id = u.id";

        // LIMIT block
        if (
            $limit &&
            is_numeric($limit) &&
            is_numeric($offset)
        ) {
            $query .= " LIMIT $limit OFFSET $offset";
        }

        $sth = $this->dbh->prepare($query);
        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Number of tasks in the table.
     *
     * @param array $conditions
     * @return int
     */
    public function count(array $conditions = []): int
    {
        $query = "SELECT COUNT(*) FROM tasks";

        $sth = $this->dbh->prepare($query);
        $sth->execute();

        return $sth->fetchColumn();
    }

    /**
     * Insert a new task.
     *
     * @param int $user_id
     * @param string $description
     * @return string
     */
    public function insert(int $user_id, string $description): string
    {
        $query = "INSERT INTO tasks (user_id, description) VALUES (:user_id, :description)";
        $sth = $this->prepare($query);

        $sth->bindParam(':user_id', $user_id);
        $sth->bindParam(':description', $description);

        $sth->execute();

        return $this->dbh->lastInsertId();
    }

    /**
     * Update a task.
     *
     * @param int $id
     * @param string $description
     * @param bool $isDone
     */
    public function update(int $id, string $description, bool $isDone)
    {
        $query = "UPDATE tasks SET description = :description, is_done = :is_done WHERE id = :id";
        $sth = $this->prepare($query);

        $sth->bindParam(':description', $description);
        $sth->bindParam(':is_done', $isDone);
        $sth->bindParam(':id', $id);

        $sth->execute();
    }
}
