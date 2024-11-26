<?php

class Comment {
    private $pdo;
    private $table = 'Comments';

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($userId, $topicId, $comment) {
        $sql = "INSERT INTO {$this->table} (user_id, topic_id, comment, commented_at) VALUES (:user_id, :topic_id, :comment, NOW())";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':user_id' => $userId,
            ':topic_id' => $topicId,
            ':comment' => $comment
        ]);
    }

    public function getCommentsByTopic($topicId) {
        $sql = "SELECT * FROM {$this->table} WHERE topic_id = :topic_id ORDER BY commented_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':topic_id' => $topicId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($commentId) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $commentId]);
    }
}