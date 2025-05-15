<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
require_once 'settings.php';

$user      = $_SESSION['username'];
$newEmail  = mysqli_real_escape_string($conn, $_POST['email']);

$sql = "UPDATE `USER`
        SET email='$newEmail'
        WHERE username='$user'";

if (mysqli_query($conn, $sql)) {
    header('Location: profile.php?success=1');
    exit;
} else {
    die('Update failed: ' . mysqli_error($conn));
}
?>
