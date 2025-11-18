<?php
include 'config.php';

if (!isset($_GET['id'])) {
    die("Invalid request");
}
$id = intval($_GET['id']);
mysqli_query($conn, "DELETE FROM students WHERE id = $id");
header("Location: view_students.php");
exit;
?>
