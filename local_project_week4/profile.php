<?php
session_start();
require_once('config.php'); // Include database connection

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_username = $_POST['username'];
    $new_email = $_POST['email'];
    $new_password = $_POST['password'];
    $profile_image = $_FILES['profile_image'];

    if (!empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
        $stmt->bind_param("sssi", $new_username, $new_email, $hashed_password, $user_id);
    } else {
        $stmt = $conn->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssi", $new_username, $new_email, $user_id);
    }

    if ($stmt->execute()) {
        $_SESSION['username'] = $new_username;
        echo "Profile updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Profile Image Upload
    if (!empty($profile_image['name'])) {
        $target_dir = "uploads/";
        $image_name = basename($profile_image["name"]);
        $target_file = $target_dir . time() . "_" . $image_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $valid_extensions = ["jpg", "jpeg", "png", "gif"];
        if (in_array($imageFileType, $valid_extensions)) {
            if (move_uploaded_file($profile_image["tmp_name"], $target_file)) {
                $stmt = $conn->prepare("UPDATE users SET profile_image = ? WHERE id = ?");
                $stmt->bind_param("si", $target_file, $user_id);
                $stmt->execute();
                echo "Profile image updated successfully!";
            } else {
                echo "Error uploading image.";
            }
        } else {
            echo "Invalid file format. Only JPG, JPEG, PNG, and GIF are allowed.";
        }
    }

    $stmt->close();
}

// Fetch user details including profile image
$stmt = $conn->prepare("SELECT username, email, profile_image FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email, $profile_image);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<h2>Update Profile</h2>
<form method="post" enctype="multipart/form-data">
    <input type="text" name="username" value="<?= htmlspecialchars($username) ?>" required>
    <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
    <input type="password" name="password" placeholder="New Password (leave blank to keep current)">
    <input type="file" name="profile_image">
    <button type="submit">Update</button>
</form>

<?php if (!empty($profile_image)): ?>
    <h3>Current Profile Image</h3>
    <img src="<?= htmlspecialchars($profile_image) ?>" alt="Profile Image" width="150">
<?php endif; ?>

<a href="dashboard.php">Back to Dashboard</a>
