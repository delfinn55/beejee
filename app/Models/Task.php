<?php

namespace App\Models;

use App\Core\Model;

class Task extends Model {
    /**
     * Gets all tasks.
     *
     * @return array
     */
    public function getAll() {
        $query = "SELECT * FROM tasks";
        $sth = $this->prepare($query);

        $sth->execute();

        return $sth->fetchAll();
    }

    /**
     * Counts the number of tasks in the table
     *
     * @return int The number of tasks
     */
    public function count() {
        $query = "SELECT COUNT(*) FROM tasks";
        $stmt = $this->prepare($query);

        $stmt->execute();

        return $stmt->fetchColumn();
    }

    /**
     * Inserts a new task
     *
     * @param int $user_id
     * @param string $description
     * @return string
     */
    public function insert($user_id, $description) {
        $query = "INSERT INTO tasks (user_id, description, due_date) VALUES (:user_id, :description)";
        $sth = $this->prepare($query);

        $sth->bindParam(':name', $user_id);
        $sth->bindParam(':description', $description);

        $sth->execute();

        return $this->dbh->lastInsertId();
    }

    /**
     * Updates a task.
     *
     * @param int $id
     * @param string $user_id
     * @param string $description
     */
    public function update($id, $user_id, $description) {
        $query = "UPDATE tasks SET user_id = :user_id, description = :description, due_date = :due_date WHERE id = :id";
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
    public function delete($id) {
        $query = "DELETE FROM tasks WHERE id = :id";
        $sth = $this->prepare($query);

        $sth->bindParam(':id', $id);

        $sth->execute();
    }
}
