<?php
// settings.php

// Database connection settings
$host     = 'localhost';          // Usually 'localhost' on XAMPP
$username = 'root';               // Default XAMPP user
$password = '';                   // Default XAMPP password
$database = 'exhibition_db';      // Change to your own DB name

// Establish connection (suppress warnings, handle errors here)
$conn = @mysqli_connect($host, $username, $password, $database)
    or die('DB Error: ' . mysqli_connect_error());
?>
