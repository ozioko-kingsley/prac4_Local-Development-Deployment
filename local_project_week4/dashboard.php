<?php
session_start();
require_once('config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT username, email, profile_image FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email, $profile_image);
$stmt->fetch();
$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillLink Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    
    <nav class="navbar">
        <div class="logo">SkillLink</div>
        <ul class="nav-links">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>



    <h2>Welcome, <?= htmlspecialchars($username) ?></h2>
    <?php if (!empty($profile_image)): ?>
        <img src="<?= htmlspecialchars($profile_image) ?>" alt="Profile Image" width="150">
    <?php endif; ?>


    <div class="dashboard-container user-info">
        <h2>Welcome to Your Dashboard</h2>
        <p>Manage your profile and career recommendations.</p>
    </div>

    <div class="user-info">
            <h3>User Details</h3>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($username); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
            <p><strong>Career Recommendation:</strong> <?php // echo htmlspecialchars($career_recommendation); ?></p>
        </div>

        

        <!-- <div class="dashboard-container  form-container career">
            <h3>Find Your Career Path</h3>
            <form action="process.php" method="POST">
                <input type="text" name="skills" placeholder="Enter your skills" required>
                <input type="text" name="interests" placeholder="Enter your interests" required>
                <button type="submit">Get Career Recommendation</button>
            </form>
        </div> -->

       

    <footer> - AI prac4-developed by &copy; Kingsley Ozioko</footer>

<script src="/script.js"></script>
</body>
</html>