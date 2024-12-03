<?php

// Load database configuration
$config = require 'classes/db.config.php';

// Create PDO object
$pdo = new PDO("mysql:host={$config['host']};dbname={$config['database']}", $config['username'], $config['password']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Instantiate classes
$user = new User($pdo);
$topic = new Topic($pdo);
$vote = new Vote($pdo);
$comment = new Comment($pdo);

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    switch ($action) {
        case 'register':
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            if ($user->registerUser($username, $email, $password)) {
                echo "User registered successfully.\n";
            } else {
                echo "User registration failed.\n";
            }
            break;

        case 'login':
            $username = $_POST['username'];
            $password = $_POST['password'];
            if ($user->authenticateUser($username, $password)) {
                echo "User authenticated successfully.\n";
            } else {
                echo "User authentication failed.\n";
            }
            break;

        case 'create_topic':
            $userId = 1; // Replace with actual user ID after login implementation
            $title = $_POST['title'];
            $description = $_POST['description'];
            if ($topic->createTopic($userId, $title, $description)) {
                echo "Topic created successfully.\n";
            } else {
                echo "Topic creation failed.\n";
            }
            break;

        case 'vote':
            $userId = 1; // Replace with actual user ID after login implementation
            $topicId = $_POST['topic_id'];
            $voteType = $_POST['vote_type'];
            if ($vote->vote($userId, $topicId, $voteType)) {
                echo "Vote recorded successfully.\n";
            } else {
                echo "Vote recording failed.\n";
            }
            break;

        case 'comment':
            $userId = 1; // Replace with actual user ID after login implementation
            $topicId = $_POST['topic_id'];
            $commentText = $_POST['comment'];
            if ($comment->addComment($userId, $topicId, $commentText)) {
                echo "Comment added successfully.\n";
            } else {
                echo "Comment addition failed.\n";
            }
            break;
    }
}

// Retrieve all topics
$topics = $topic->getTopics();
echo "Topics:\n";
print_r($topics);

// Retrieve comments for a topic
$comments = $comment->getComments(1);
echo "Comments:\n";
print_r($comments);
?>