<?php
include 'db_connect.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get student ID and grade from form
    $student_id = $_POST['student_id'];
    $grade = $_POST['grade'];

    // Input validation (simple example)
    if (!empty($student_id) && is_numeric($grade)) {
        // Insert grade into grades table
        $sql = "INSERT INTO grades (student_id, grade) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "id", $student_id, $grade);
            if (mysqli_stmt_execute($stmt)) {
                // Redirect back to main page after successful insert
                header("Location: index.php");
                exit();
            } else {
                echo "<p>Error: Could not add grade.</p>";
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "<p>Error: Could not prepare statement.</p>";
        }
    } else {
        echo "<p>Please provide a valid student and grade.</p>";
    }
} else {
    echo "<p>Invalid request method.</p>";
}