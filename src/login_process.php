<?php
session_start();
require('dbcon.php'); 

$username = $_POST['username'];
$password = hash('sha256', $_POST['password']); 
$sql = "SELECT * FROM users WHERE user = '$username' AND password = '$password'";
$result = $con->query($sql);

if ($result->num_rows == 1) {
    $_SESSION['username'] = $username; 
    header('Location: index.php'); 
} else {
    header('Location: login.php?error=1'); 
}
exit(0);
?>
