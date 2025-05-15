<?php
// update_profile.php

session_start();                          // Resume session

// If not logged in, send them back to login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

require_once 'settings.php';              // DB connection

$user     = $_SESSION['username'];        // Who’s editing?
$newEmail = mysqli_real_escape_string($conn, $_POST['email']);  // Sanitize new email

// Update the email for this user
$sql = "UPDATE `USER`
        SET email='$newEmail'
        WHERE username='$user'";

if (mysqli_query($conn, $sql)) {
    // Success: redirect back to profile with a flag
    header('Location: profile.php?success=1');
    exit;
} else {
    // Something went wrong
    die('Update failed: ' . mysqli_error($conn));
}
?>
