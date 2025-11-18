<?php include 'config.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Mark Attendance</title>
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
  <h2 class="mb-4">Mark Attendance</h2>

  <?php
  // default date = today
  $date = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d');

  // on submit, save attendance
  if (isset($_POST['save'])) {
      $date = $_POST['date'];
      // first remove any existing attendance entries for this date (simpler logic)
      mysqli_query($conn, "DELETE FROM attendance WHERE date = '$date'");

      // iterate posted statuses
      if (isset($_POST['status'])) {
          foreach ($_POST['status'] as $student_id => $status) {
              $sid = intval($student_id);
              $s = ($status === 'Present') ? 'Present' : 'Absent';
              $stmt = "INSERT INTO attendance (student_id, date, status) VALUES ($sid, '$date', '$s')";
              mysqli_query($conn, $stmt);
          }
      }
      echo "<div class='alert alert-success'>Attendance saved for $date</div>";
  }

  // fetch students
  $students = mysqli_query($conn, "SELECT * FROM students ORDER BY name");
  ?>

  <form method="POST">
    <div class="mb-3 col-md-3">
      <label class="form-label">Date</label>
      <input type="date" name="date" class="form-control" value="<?= htmlspecialchars($date) ?>">
    </div>

    <table class="table table-bordered">
      <thead class="table-dark">
        <tr><th>Student</th><th>Status</th></tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($students)): ?>
          <?php
            // check if attendance exists for this student/date
            $sid = $row['id'];
            $q = mysqli_query($conn, "SELECT status FROM attendance WHERE student_id=$sid AND date='$date'");
            $existing = mysqli_fetch_assoc($q);
            $st = $existing ? $existing['status'] : 'Present';
          ?>
          <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td>
              <select name="status[<?= $sid ?>]" class="form-select">
                <option value="Present" <?= $st === 'Present' ? 'selected' : '' ?>>Present</option>
                <option value="Absent" <?= $st === 'Absent' ? 'selected' : '' ?>>Absent</option>
              </select>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

    <button type="submit" name="save" class="btn btn-primary">Save Attendance</button>
    <a href="index.php" class="btn btn-secondary">Back</a>
  </form>
</div>

</body>
</html>
