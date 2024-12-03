<?php

class Vote {
    private $pdo;
    private $table = 'Votes';

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function vote($userId, $topicId, $voteType) {
        if ($this->hasVoted($topicId, $userId)) {
            return false;
        }

        $sql = "INSERT INTO {$this->table} (user_id, topic_id, vote_type, voted_at) VALUES (:user_id, :topic_id, :vote_type, NOW())";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':user_id' => $userId,
            ':topic_id' => $topicId,
            ':vote_type' => $voteType
        ]);
    }

    public function hasVoted($topicId, $userId) {
        $sql = "SELECT COUNT(*) FROM {$this->table} WHERE topic_id = :topic_id AND user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':topic_id' => $topicId, ':user_id' => $userId]);
        return $stmt->fetchColumn() > 0;
    }

    public function getUserVoteHistory($userId) {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = :user_id ORDER BY voted_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}