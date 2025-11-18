<?php
include 'config.php';

if (!isset($_GET['id'])) {
    die("Invalid request");
}
$id = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $year = intval($_POST['year']);

    $sql = "UPDATE students SET name='$name', course='$course', year=$year WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Updated successfully'); window.location='view_students.php';</script>";
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

$res = mysqli_query($conn, "SELECT * FROM students WHERE id = $id");
$student = mysqli_fetch_assoc($res);
if (!$student) die("Student not found");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Student</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-primary mb-4">
  <div class="container">
    <a class="navbar-brand" href="index.php">Attendance System</a>
  </div>
</nav>

<div class="container">
  <h2 class="mb-4">Edit Student</h2>
  <form method="POST" class="card p-4 shadow-sm col-md-6">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control mb-3" value="<?= htmlspecialchars($student['name']) ?>" required>

    <label class="form-label">Course</label>
    <input type="text" name="course" class="form-control mb-3" value="<?= htmlspecialchars($student['course']) ?>">

    <label class="form-label">Year</label>
    <input type="number" name="year" class="form-control mb-3" value="<?= htmlspecialchars($student['year']) ?>">

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="view_students.php" class="btn btn-secondary">Back</a>
  </form>
</div>

</body>
</html>
