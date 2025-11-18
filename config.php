<?php
// config.php - DB connection
$servername = "localhost";
$username = "root";
$password = ""; // default XAMPP root user has no password
$dbname = "attendance_system";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

