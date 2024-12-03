<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting Application</title>
</head>
<body>
    <h1>Voting Application</h1>

    <!-- User Registration Form -->
    <h2>Register</h2>
    <form action="main.php" method="post">
        <input type="hidden" name="action" value="register">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Register</button>
    </form>

    <!-- User Login Form -->
    <h2>Login</h2>
    <form action="main.php" method="post">
        <input type="hidden" name="action" value="login">
        <label for="login_username">Username:</label>
        <input type="text" id="login_username" name="username" required>
        <label for="login_password">Password:</label>
        <input type="password" id="login_password" name="password" required>
        <button type="submit">Login</button>
    </form>

    <!-- Topic Creation Form -->
    <h2>Create Topic</h2>
    <form action="main.php" method="post">
        <input type="hidden" name="action" value="create_topic">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        <button type="submit">Create Topic</button>
    </form>

    <!-- Voting Form -->
    <h2>Vote</h2>
    <form action="main.php" method="post">
        <input type="hidden" name="action" value="vote">
        <label for="topic_id">Topic ID:</label>
        <input type="number" id="topic_id" name="topic_id" required>
        <label for="vote_type">Vote Type:</label>
        <select id="vote_type" name="vote_type" required>
            <option value="up">Up</option>
            <option value="down">Down</option>
        </select>
        <button type="submit">Vote</button>
    </form>

    <!-- Comment Form -->
    <h2>Comment</h2>
    <form action="main.php" method="post">
        <input type="hidden" name="action" value="comment">
        <label for="comment_topic_id">Topic ID:</label>
        <input type="number" id="comment_topic_id" name="topic_id" required>
        <label for="comment">Comment:</label>
        <textarea id="comment" name="comment" required></textarea>
        <button type="submit">Add Comment</button>
    </form>
</body>
</html>