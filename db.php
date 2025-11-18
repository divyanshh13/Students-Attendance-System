<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "attendance_system";  // <-- This is your REAL database name

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
