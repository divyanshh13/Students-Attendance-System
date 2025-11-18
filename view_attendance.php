<?php include 'config.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>View Attendance</title>
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
  <h2 class="mb-4">View Attendance</h2>

  <form method="GET" class="row g-3 mb-4">
    <div class="col-md-3">
      <label class="form-label">Date</label>
      <input type="date" name="date" class="form-control" value="<?= isset($_GET['date']) ? htmlspecialchars($_GET['date']) : date('Y-m-d') ?>">
    </div>
    <div class="col-md-3 align-self-end">
      <button class="btn btn-primary">Filter</button>
      <a href="view_attendance.php" class="btn btn-secondary">Reset</a>
    </div>
  </form>

  <?php
    $date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

    // get list with left join to show students even if attendance missing
    $sql = "SELECT s.id, s.name, a.status
            FROM students s
            LEFT JOIN attendance a ON s.id = a.student_id AND a.date = '$date'
            ORDER BY s.name";
    $res = mysqli_query($conn, $sql);
  ?>

  <h5>Attendance for <?= htmlspecialchars($date) ?></h5>
  <table class="table table-bordered">
    <thead class="table-dark">
      <tr><th>Student</th><th>Status</th></tr>
    </thead>
    <tbody>
      <?php while ($r = mysqli_fetch_assoc($res)): ?>
        <tr>
          <td><?= htmlspecialchars($r['name']) ?></td>
          <td><?= $r['status'] ? htmlspecialchars($r['status']) : '<em>Not marked</em>' ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

</div>

</body>
</html>
