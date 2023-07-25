<?php
session_start();
require 'dbcon.php';

if(isset($_POST['delete_student']))
{
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

if(isset($_POST['update_student']))
{   
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $dept = mysqli_real_escape_string($con, $_POST['dept']);
    $roll = mysqli_real_escape_string($con, $_POST['roll']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $reg = mysqli_real_escape_string($con, $_POST['reg']);

    $query = "UPDATE students SET dept='$dept', roll='$roll', name='$name', email='$email', phone='$phone' WHERE id='$id' ";
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
    $roll = mysqli_real_escape_string($con, $_POST['roll']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $reg = mysqli_real_escape_string($con, $_POST['reg']);

    $query = "INSERT INTO students (dept,roll,name,email,phone,reg) VALUES ('$dept','$roll','$name','$email','$phone','$reg')";

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
    $query1 = "ALTER TABLE students DROP reg;";
    $query2 = "ALTER TABLE students AUTO_INCREMENT = 1;";
    $query3 = "ALTER TABLE students ADD id int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;";

    mysqli_query($con, $query1);
    mysqli_query($con, $query2);
    mysqli_query($con, $query3);

}

?>