<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }
    require 'dbcon.php';

    // Fetch data from the database table
    $query1 = "SELECT * FROM sheets ORDER BY sheet_id DESC LIMIT 1;";
    $result1 = $con->query($query1);

    $row = $result1->fetch_assoc();

    $last_table = $row["sheet_name"]; 
    $query2 = "SELECT * FROM `$last_table`";
    $result2 = mysqli_query($con, $query2);

    $columns = array();
    $columns = array_keys($result2->fetch_assoc());
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title><?= $row["sheet_name"]; ?> - AMS</title>
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
        </div>
    </nav>
    <div class="container mt-4">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Attendance Sheet Name: <?= $row["sheet_name"]; ?>
                            <a href="attendance_sheet.php" class="btn btn-outline-primary float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <?php
                                foreach ($columns as $column) {
                                    ?> <th><?= $column ?> </th>
                                <?php
                                }
                                ?>
                            </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $query3 = "SELECT id FROM `$last_table` ORDER BY id DESC LIMIT 1;";
                                $result3 = $con->query($query3);
                                $id_limit = $result3->fetch_assoc();
                                // echo $id_limit['id'];
                                // $row = $result2->fetch_assoc();
                                // echo $row["name"];
                                for ($i = 1; $i <= $id_limit['id']; $i ++) {
                                    $query2 = "SELECT * FROM `$last_table` WHERE id = $i";
                                    $result2 = mysqli_query($con, $query2);
                                    $row = $result2->fetch_assoc();
                                    ?>
                                        <tr>
                                    <?php
                                    foreach($columns as $column)
                                    {      
                                    ?>
                                        <td><?= $row[$column]; ?></td>
                                    <?php
                                    }?> 
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>