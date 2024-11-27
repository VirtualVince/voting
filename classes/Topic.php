<?php

class Topic {
    private $pdo;
    private $table = 'Topics';

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($userId, $title, $description) {
        $sql = "INSERT INTO {$this->table} (user_id, title, description, created_at) VALUES (:user_id, :title, :description, NOW())";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':user_id' => $userId,
            ':title' => $title,
            ':description' => $description
        ]);
    }

    public function getTopicById($topicId) {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $topicId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllTopics() {
        $sql = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($topicId) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $topicId]);
    }
}