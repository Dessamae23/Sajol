<?php
include 'db_connect.php';

$id = $_GET['id'];

// First, delete all grades for the student
$delete_grades = "DELETE FROM grades WHERE student_id=$id";
mysqli_query($conn, $delete_grades);

// Now, delete the student record
$delete_student = "DELETE FROM students WHERE student_id=$id";

if (mysqli_query($conn, $delete_student)) {
    echo "<script>alert('🗑️ Student deleted successfully!'); window.location='index.php';</script>";
} else {
    echo "Error deleting student: " . mysqli_error($conn);
}
?>