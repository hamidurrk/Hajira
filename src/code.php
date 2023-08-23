<?php
session_start();
require 'dbcon.php';

if(isset($_POST['delete_student'])) {
    $id = mysqli_real_escape_string($con, $_POST['delete_student']);

    $query = "DELETE FROM students WHERE id='$id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Student Deleted Successfully";
        header("Location: class.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Deleted";
        header("Location: class.php");
        exit(0);
    }
}

if(isset($_POST['delete_sheet'])) {
    $id = mysqli_real_escape_string($con, $_POST['delete_sheet']);
    
    $query1 = "SELECT * FROM sheets WHERE sheet_id='$id' ";
    $result1 = mysqli_query($con, $query1);
    $row = $result1->fetch_assoc();
    $table = $row["sheet_name"]; 

    $query2 = "DROP TABLE `$table`;";
    $query_run2 = mysqli_query($con, $query2);

    if($query_run2) {   
        $query3 = "DELETE FROM sheets WHERE sheet_id='$id' ";
        $query_run3 = mysqli_query($con, $query3);

        $_SESSION['message'] = $table . "Sheet Deleted Successfully";
        header("Location: attendance_sheet_list.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Sheet Not Deleted";
        header("Location: attendance_sheet_list.php");
        exit(0);
    }
}

if(isset($_POST['update_student']))
{   
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $dept = mysqli_real_escape_string($con, $_POST['dept']);
    $batch = mysqli_real_escape_string($con, $_POST['batch']);
    $roll = mysqli_real_escape_string($con, $_POST['roll']);
    $st_id = mysqli_real_escape_string($con, $_POST['st_id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);

    $query = "UPDATE students SET dept='$dept', batch='$batch', roll='$roll', name='$name', email='$email', phone='$phone' WHERE id='$id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Student Updated Successfully";
        header("Location: class.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Updated";
        header("Location: class.php");
        exit(0);
    }

}


if(isset($_POST['save_student']))
{
    $dept = mysqli_real_escape_string($con, $_POST['dept']);
    $batch = mysqli_real_escape_string($con, $_POST['batch']);
    $roll = mysqli_real_escape_string($con, $_POST['roll']);
    $st_id = mysqli_real_escape_string($con, $_POST['st_id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);

    $query = "INSERT INTO students (dept,batch,roll,st_id,name,email,phone) VALUES ('$dept','$batch','$roll','$st_id','$name','$email','$phone')";

    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "Student Created Successfully";
        header("Location: student-create.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Created";
        header("Location: student-create.php");
        exit(0);
    }
}

if(isset($_POST['reset_id']))
{
    $query1 = "ALTER TABLE students DROP st_id;";
    $query2 = "ALTER TABLE students AUTO_INCREMENT = 1;";
    $query3 = "ALTER TABLE students ADD id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;";

    mysqli_query($con, $query1);
    mysqli_query($con, $query2);
    mysqli_query($con, $query3);
}

if(isset($_POST['generate_sheet']))
{   
    $dept = mysqli_real_escape_string($con, $_POST['dept']);
    $batch = mysqli_real_escape_string($con, $_POST['batch']);
    $course = mysqli_real_escape_string($con, $_POST['course']);

    $table_name = $course . "_" . $dept . "_" . strval($batch);
    echo $table_name;

    $result = $con->query("SHOW TABLES LIKE '$table_name';");

    if ($result->num_rows > 0) {
        echo "Table already exists.";
    } else {
        $query = "CREATE TABLE `$table_name` (
            id INT NOT NULL AUTO_INCREMENT,
            st_id INT NULL,
            name VARCHAR(255) NULL,
            PRIMARY KEY (`id`)
        );";
        echo $query;
        $query_run = mysqli_query($con, $query);
    }

    if($query_run)
    {
        $query = "INSERT INTO `$table_name` (st_id, name)
        SELECT st_id, name
        FROM students
        WHERE dept = '$dept' AND batch = $batch
        ORDER BY st_id ASC;";
        echo $query;

        $query_run = mysqli_query($con, $query);

        $query = "INSERT INTO sheets (sheet_name, course, dept, batch) VALUES ('$table_name','$course','$dept', $batch)";
        $query_run = mysqli_query($con, $query);

        $_SESSION['message'] = $table_name . " Attendance Sheet has been generated";
        header("Location: show_generated_attendance_sheet.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Attendance Sheet generation failed!";
        header("Location: generate_attendance_sheet.php");
        exit(0);
    }

}

?>