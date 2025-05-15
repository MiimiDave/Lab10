<?php
// settings.php
$host     = 'localhost';              // XAMPP default
$username = 'root';                   // XAMPP default
$password = '';                       // XAMPP default
$database = 'exhibition_db';          // your DB name

// connect (suppress warnings)
$conn = @mysqli_connect($host, $username, $password, $database)
    or die('DB Error: ' . mysqli_connect_error());
?>
