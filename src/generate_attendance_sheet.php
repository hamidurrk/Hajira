<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Student Create - AMS</title>
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
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create A New Sheet 
                        <a href="attendance_sheet.php" class="btn btn-outline-primary float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST">
                            <div class="mb-3">
                            <label>Department</label>
                                <div class="input-group">
                                <select class="form-control" name="dept" id="departmentSelect">
                                    <option value="">Select Department</option>
                                    <optgroup label="Faculty of Agriculture">
                                        <option value="Agriculture">Department of Agriculture</option>
                                    </optgroup>
                                    <optgroup label="Faculty of Veterinary Science">
                                        <option value="VeterinaryMedicine">Department of Veterinary Medicine</option>
                                    </optgroup>
                                    <optgroup label="Faculty of Animal Husbandry">
                                        <option value="AnimalHusbandry">Department of Animal Husbandry</option>
                                    </optgroup>
                                    <optgroup label="Faculty of Agricultural Economics & Rural Sociology">
                                        <option value="AgriculturalEconomics">Department of Agricultural Economics</option>
                                    </optgroup>
                                    <optgroup label="Faculty of Agricultural Engineering & Technology">
                                        <option value="AgriculturalEngineering">Department of Agricultural Engineering</option>
                                        <option value="FoodEngineering">Department of Food Engineering</option>
                                        <option value="BioinformaticsEngineering">Department of Bioinformatics Engineering</option>
                                    </optgroup>
                                    <optgroup label="Faculty of Fisheries">
                                        <option value="Fisheries">Department of Fisheries</option>
                                    </optgroup>
                                    <optgroup label="Faculty of Interdisciplinary Institute for Food Safety">
                                        <option value="FoodSafetyManagement">Department of Food Safety Management</option>
                                    </optgroup>
                                </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label>Batch Number</label>
                                <input type="text" name="batch" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Course Code</label>
                                <input type="text" name="course" class="form-control">
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="generate_sheet" class="btn btn-primary">Filter & Generate</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
