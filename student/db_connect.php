<?php
$host = "localhost";
$user = "root";     // default username in XAMPP
$pass = "";         // leave empty unless you set a password
$db   = "student_performance_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
