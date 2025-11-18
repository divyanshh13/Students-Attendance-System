<?php include 'config.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Add Student</title>
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
  <h2 class="mb-4">Add New Student</h2>

  <form method="POST" class="card p-4 shadow-sm col-md-6">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control mb-3" required>

    <label class="form-label">Course</label>
    <input type="text" name="course" class="form-control mb-3">

    <label class="form-label">Year</label>
    <input type="number" name="year" class="form-control mb-3">

    <button type="submit" name="submit" class="btn btn-success">Add Student</button>
    <a href="view_students.php" class="btn btn-secondary">Back</a>
  </form>
</div>

</body>
</html>

<?php
if (isset($_POST['submit'])) {
    // Basic escaping to reduce risk of SQL injection for beginner usage
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $year = intval($_POST['year']);

    $sql = "INSERT INTO students (name, course, year) VALUES ('$name', '$course', $year)";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Student Added Successfully!'); window.location='view_students.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
