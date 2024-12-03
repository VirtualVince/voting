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

// Register a new user
if ($user->registerUser('testuser', 'testuser@example.com', 'password123')) {
    echo "User registered successfully.\n";
} else {
    echo "User registration failed.\n";
}

// Authenticate user
if ($user->authenticateUser('testuser', 'password123')) {
    echo "User authenticated successfully.\n";
} else {
    echo "User authentication failed.\n";
}

// Create a new topic
if ($topic->createTopic(1, 'Sample Topic', 'This is a sample topic description.')) {
    echo "Topic created successfully.\n";
} else {
    echo "Topic creation failed.\n";
}

// Retrieve all topics
$topics = $topic->getTopics();
echo "Topics:\n";
print_r($topics);

// Vote on a topic
if ($vote->vote(1, 1, 'up')) {
    echo "Vote recorded successfully.\n";
} else {
    echo "Vote recording failed.\n";
}

// Add a comment to a topic
if ($comment->addComment(1, 1, 'This is a sample comment.')) {
    echo "Comment added successfully.\n";
} else {
    echo "Comment addition failed.\n";
}

// Retrieve comments for a topic
$comments = $comment->getComments(1);
echo "Comments:\n";
print_r($comments);
?>