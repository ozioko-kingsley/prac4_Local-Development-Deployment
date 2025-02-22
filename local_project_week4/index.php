<?php
// register.php - Handles user registration
require_once('register.php'); // Include database connection 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillLink - Career Pathway</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Welcome to SkillLink</h2>
        <p>Discover your ideal career path with AI-powered recommendations.</p>

        <div class="form-container">
            <h3>Register</h3>
            <form action="register.php" method="POST">
                <input type="text" name="username" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Register</button>
            </form>
            <a href="login.php">Already have an account? Login here</a>
        </div>

    </div>

    <footer> - AI prac4-developed by &copy; Kingsley Ozioko</footer>

    <script src="script.js"></script>
</body>
</html>
