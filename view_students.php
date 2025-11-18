<?php include 'config.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>View Students</title>
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
  <h2 class="mb-4">All Students</h2>

  <a href="add_student.php" class="btn btn-success mb-3">Add Student</a>

  <table class="table table-striped table-bordered">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Course</th>
        <th>Year</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $result = mysqli_query($conn, "SELECT * FROM students ORDER BY id ASC");
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>".$row['id']."</td>
                <td>".htmlspecialchars($row['name'])."</td>
                <td>".htmlspecialchars($row['course'])."</td>
                <td>".($row['year'] ?? '')."</td>
                <td>
                  <a href='edit_student.php?id=".$row['id']."' class='btn btn-sm btn-primary me-1'>Edit</a>
                  <a href='delete_student.php?id=".$row['id']."' class='btn btn-sm btn-danger' onclick=\"return confirm('Delete this student?');\">Delete</a>
                </td>
              </tr>";
    }
    ?>
    </tbody>
  </table>
</div>

</body>
</html>
