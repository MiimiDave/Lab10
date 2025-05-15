<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
require_once 'settings.php';

$user = $_SESSION['username'];
$sql  = "SELECT username, email FROM `USER` WHERE username='$user'";
$res  = mysqli_query($conn, $sql);
$row  = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Profile</title></head>
<body>
  <h2>Welcome, <?= htmlspecialchars($row['username']) ?>!</h2>
  <p><strong>Email:</strong> <?= htmlspecialchars($row['email']) ?></p>

  <hr>
  <h3>Edit Profile</h3>
  <form method="post" action="update_profile.php">
    <!-- hidden so we know who’s editing -->
    <input type="hidden" name="username" value="<?= htmlspecialchars($user) ?>">
    <label for="email">New email:</label>
    <input type="email" name="email" id="email"
           value="<?= htmlspecialchars($row['email']) ?>" required>
    <button type="submit">Save changes ✏️</button>
  </form>

  <?php if (isset($_GET['success'])): ?>
    <p style="color:green;">Email updated successfully! 🎉</p>
  <?php endif; ?>
</body>
</html>
