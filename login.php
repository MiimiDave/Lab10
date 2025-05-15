<?php
session_start();
require_once 'settings.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = mysqli_real_escape_string($conn, $_POST['username']);
    $p = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM `USER` WHERE username='$u' AND password='$p'";
    $res = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) === 1) {
        $_SESSION['username'] = $u;
        header('Location: profile.php');
        exit;
    } else {
        $error = 'Invalid credentials, try again 💥';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Login</title></head>
<body>
  <h2>Login</h2>
  <?php if (!empty($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>

  <form method="post" action="login.php">
    <label>Username:</label>
    <input type="text" name="username" required><br>
    <label>Password:</label>
    <input type="password" name="password" required><br>
    <button type="submit">Log me in</button>
  </form>
</body>
</html>
