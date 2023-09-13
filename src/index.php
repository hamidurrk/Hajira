<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }
    require 'dbcon.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>AMS</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">AMS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
                <a href="logout.php" class="btn btn-danger float-end">Logout</a>
        </div>
    </nav>
  
    <div class="container mt-5">
        <div class="jumbotron">
            <h1 class="display-4"><b>AMS</b></h1>
            <p class="lead">A student attendance management system for Bangladesh Agricultural University.</p>
        </div>
        <div class="row mt-5">
            <div class="col-md-6">
                <a href="class.php" class="btn btn-secondary btn-block btn-lg mb-3">View All Students</a>
            </div>
            <div class="col-md-6">
                <a href="view_attendance.php" class="btn btn-secondary btn-block btn-lg mb-3">View Attendance Records</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <a href="student-create.php" class="btn btn-secondary btn-block btn-lg mb-3">Add New Student</a>
            </div>
            <div class="col-md-6">
                <a href="attendance_sheet.php" class="btn btn-secondary btn-block btn-lg mb-3">Attendance Sheet</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>