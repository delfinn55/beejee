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
     * @param array $conditions
     * @param int|null $limit
     * @param int $offset
     * @return array
     */
    public function getFiltered(int $limit = 0, int $offset = 0, array $conditions = []): array
    {
        $query = "SELECT * FROM tasks";

        $where = "";
        $params = [];
        foreach($conditions as $field => $value) {
            $where .= " $field = :$field AND";
            $params[":$field"] = $value;
        }
        if (!empty($where)) {
            $where = " WHERE" . substr($where, 0, -4);
            $query .= $where;
        }

        if (
            $limit &&
            is_numeric($limit) &&
            is_numeric($offset)
        ) {
            $query .= " LIMIT $limit OFFSET $offset";
        }

        $stmt = $this->dbh->prepare($query);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

        $where = "";
        $params = [];
        foreach($conditions as $key => $value) {
            $where .= " $key = :$key AND";
            $params[":$key"] = $value;
        }
        if (!empty($where)) {
            $where = " WHERE" . substr($where, 0, -4);
            $query .= $where;
        }

        $stmt = $this->dbh->prepare($query);
        $stmt->execute($params);

        return $stmt->fetchColumn();
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
