<?php

class Comment {
    private $pdo;
    private $table = 'Comments';

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function addComment($userId, $topicId, $comment) {
        $sql = "INSERT INTO {$this->table} (user_id, topic_id, comment, commented_at) VALUES (:user_id, :topic_id, :comment, NOW())";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':user_id' => $userId,
            ':topic_id' => $topicId,
            ':comment' => $comment
        ]);
    }

    public function getComments($topicId) {
        $sql = "SELECT * FROM {$this->table} WHERE topic_id = :topic_id ORDER BY commented_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':topic_id' => $topicId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}