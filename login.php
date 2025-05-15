<?php
// login.php

session_start();                          // Start or resume the session
require_once 'settings.php';              // Bring in DB connection details

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize user input to prevent SQL injection
    $u = mysqli_real_escape_string($conn, $_POST['username']);
    $p = mysqli_real_escape_string($conn, $_POST['password']);

    // Look up the user with matching credentials
    $sql = "SELECT * FROM `USER` WHERE username='$u' AND password='$p'";
    $res = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) === 1) {
        // Credentials are valid: store username in session and send them to their profile
        $_SESSION['username'] = $u;
        header('Location: profile.php');
        exit;
    } else {
        // Invalid login attempt
        $error = 'Invalid credentials, try again.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <?php if (!empty($error)): ?>
        <!-- Show error if login failed -->
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <!-- Login form -->
    <form method="post" action="login.php">
        <label>Username:</label>
        <input type="text" name="username" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Log me in</button>
    </form>
</body>
</html>
