<?php
// profile.php

session_start();                          // Resume session to check login status

// If there's no username in session, kick them back to login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

require_once 'settings.php';              // DB connection

$user = $_SESSION['username'];            // Who’s logged in?

// Fetch the user's current details
$sql = "SELECT username, email FROM `USER` WHERE username='$user'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
</head>
<body>
    <h2>Welcome, <?= htmlspecialchars($row['username']) ?>!</h2>
    <p><strong>Email:</strong> <?= htmlspecialchars($row['email']) ?></p>

    <hr>

    <h3>Edit Profile</h3>
    <!-- Form to submit a new email address -->
    <form method="post" action="update_profile.php">
        <!-- Hidden field so update script knows which user to update -->
        <input type="hidden" name="username" value="<?= htmlspecialchars($user) ?>">

        <label for="email">New email:</label>
        <input
            type="email"
            name="email"
            id="email"
            value="<?= htmlspecialchars($row['email']) ?>"
            required
        >

        <button type="submit">Save changes</button>
    </form>

    <?php if (isset($_GET['success'])): ?>
        <!-- Let them know their email was updated -->
        <p style="color:green;">Email updated successfully!</p>
    <?php endif; ?>
</body>
</html>
