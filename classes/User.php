<?php

class User {
    private $pdo;
    private $table = 'Users';

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO {$this->table} (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $hashedPassword
        ]);
    }

    public function getUserById($userId) {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByUsername($username) {
        $sql = "SELECT * FROM {$this->table} WHERE username = :username";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($userId) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $userId]);
    }
}