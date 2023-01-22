<?php

namespace App\Models;

use App\Core\Model;

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
     * Number of tasks in the table.
     *
     * @return int
     */
    public function count(): int
    {
        $query = "SELECT COUNT(*) FROM tasks";
        $sth = $this->prepare($query);

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
     * @param string $user_id
     * @param string $description
     */
    public function update(int $id, string $user_id, string $description)
    {
        $query = "UPDATE tasks SET user_id = :user_id, description = :description WHERE id = :id";
        $sth = $this->prepare($query);

        $sth->bindParam(':user_id', $user_id);
        $sth->bindParam(':description', $description);
        $sth->bindParam(':id', $id);

        $sth->execute();
    }

    /**
     * Delete a task.
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $query = "DELETE FROM tasks WHERE id = :id";
        $sth = $this->prepare($query);

        $sth->bindParam(':id', $id);

        $sth->execute();
    }
}
