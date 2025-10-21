<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Student</title>
    <link rel="stylesheet" href="ad.css">
</head>
<body>
    <h2>Add New Student</h2>
    <form method="POST">
        <label>First Name:</label><br>
        <input type="text" name="first_name" required><br><br>

        <label>Last Name:</label><br>
        <input type="text" name="last_name" required><br><br>

        <label>Gender:</label><br>
        <select name="gender">
            <option>Male</option>
            <option>Female</option>
        </select><br><br>

        <label>Birthdate:</label><br>
        <input type="date" name="birthdate"><br><br>

        <input type="submit" name="submit" value="Save" class="btn">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $first = $_POST['first_name'];
        $last = $_POST['last_name'];
        $gender = $_POST['gender'];
        $birth = $_POST['birthdate'];

        $insert = "INSERT INTO students (first_name, last_name, gender, birthdate)
                   VALUES ('$first', '$last', '$gender', '$birth')";
        if (mysqli_query($conn, $insert)) {
            echo "<p>✅ Student added successfully!</p>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
    ?>
    <br><a href="index.php">Back to List</a>
</body>
</html>
