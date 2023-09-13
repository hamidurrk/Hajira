<!-- ALTER TABLE vendors
ADD COLUMN vendor_group INT NOT NULL; -->

<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }
    require 'dbcon.php';
    // $current_date_time = date('dmY_Hi');
    if(isset($_GET['id']))
    {
        $id = mysqli_real_escape_string($con, $_GET['id']);
        $query1 = "SELECT * FROM sheets WHERE sheet_id='$id' ";
        $result1 = mysqli_query($con, $query1);
        $row = $result1->fetch_assoc();
    }
    $selected_sheet = $row['sheet_name']; 
    // try {
    //     $query_for_add = "ALTER TABLE `$selected_sheet` ADD COLUMN `$current_date_time` TINYINT(1) DEFAULT 0;";
    //     $result_for_add = mysqli_query($con, $query_for_add);

    // } catch(Exception $e) {}
    
    $query2 = "SELECT * FROM `$selected_sheet`";
    $result2 = mysqli_query($con, $query2);

    $columns = array();
    $columns = array_keys($result2->fetch_assoc());
    $lastcol = end($columns);
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
                    <form action="code.php" method="POST">
                    <div class="card-header">
                        <h4>Attendance Sheet Name: <?= $row["sheet_name"]; ?>
                            <button type="submit" name="save_attendance" value="<?= $row["sheet_name"]; ?>" class="btn btn-warning float-end">Submit</button>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <?php
                                    for ($i = 0; $i <= 2; $i ++) {
                                        ?> <th><?= $columns[$i] ?> </th>
                                    <?php
                                    }
                                    ?>
                                    <th>Attendance Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $query3 = "SELECT id FROM `$selected_sheet` ORDER BY id DESC LIMIT 1;";
                                    $result3 = $con->query($query3);
                                    $id_limit = $result3->fetch_assoc();
                                    // echo $id_limit['id'];
                                    // $row = $result2->fetch_assoc();
                                    // echo $row["name"];
                                    for ($i = 1; $i <= $id_limit['id']; $i ++) {
                                        $attendance[$i] = 0;
                                        $query2 = "SELECT * FROM `$selected_sheet` WHERE id = $i";
                                        $result2 = mysqli_query($con, $query2);
                                        $row = $result2->fetch_assoc();
                                        ?>
                                            <tr>
                                        <?php
                                        $column_list = ['id', 'st_id', 'name'];
                                        foreach($column_list as $column) {
                                            ?>
                                                <td><?= $row[$column]; ?></td>
                                            <?php
                                            }
                                        ?> 
                                        <td><div class="form-check form-check-inline">
                                                <input class="form-check-input" name="attendance[<?= $i ?>]" type="radio" name="inlineRadioOptions" id="inlineRadio1" value=1>
                                                <label class="form-check-label" for="inlineRadio1">Present</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="attendance[<?= $i ?>]" type="radio" name="inlineRadioOptions" id="inlineRadio2" value=0>
                                                <label class="form-check-label" for="inlineRadio2">Absent</label>
                                            </div> 
                                            <!-- <input class="form-check-input active" name="attendance[<?= $i ?>]" type="checkbox" value=1> Present</td> -->
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>