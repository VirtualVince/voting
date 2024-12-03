<?php

class Topic {
    private $pdo;
    private $table = 'Topics';

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createTopic($userId, $title, $description) {
        $sql = "INSERT INTO {$this->table} (user_id, title, description, created_at) VALUES (:user_id, :title, :description, NOW())";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':user_id' => $userId,
            ':title' => $title,
            ':description' => $description
        ]);
    }

    public function getTopics() {
        $sql = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCreatedTopics($userId) {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
