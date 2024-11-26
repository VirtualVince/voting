<?php

class Vote {
    private $pdo;
    private $table = 'Votes';

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($userId, $topicId, $voteType) {
        $sql = "INSERT INTO {$this->table} (user_id, topic_id, vote_type, voted_at) VALUES (:user_id, :topic_id, :vote_type, NOW())";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':user_id' => $userId,
            ':topic_id' => $topicId,
            ':vote_type' => $voteType
        ]);
    }

    public function getVotesByTopic($topicId) {
        $sql = "SELECT * FROM {$this->table} WHERE topic_id = :topic_id ORDER BY voted_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':topic_id' => $topicId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($voteId) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $voteId]);
    }
}