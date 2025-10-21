<?php
include 'db_connect.php';

$id = $_GET['id'];
$sql = "SELECT * FROM students WHERE student_id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $first = $_POST['first_name'];
    $last = $_POST['last_name'];
    $gender = $_POST['gender'];
    $birth = $_POST['birthdate'];

    $update = "UPDATE students SET first_name='$first', last_name='$last', gender='$gender', birthdate='$birth' WHERE student_id=$id";
    if (mysqli_query($conn, $update)) {
        echo "<script>alert('✅ Student updated successfully!'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Student</title>
    <link rel="stylesheet" href="us.css">
</head>
<body>
    <h2>Update Student Information</h2>

    <form method="POST">
        <label>First Name:</label><br>
        <input type="text" name="first_name" value="<?php echo $row['first_name']; ?>" required><br><br>

        <label>Last Name:</label><br>
        <input type="text" name="last_name" value="<?php echo $row['last_name']; ?>" required><br><br>

        <label>Gender:</label><br>
        <select name="gender">
            <option <?php if($row['gender']=='Male') echo 'selected'; ?>>Male</option>
            <option <?php if($row['gender']=='Female') echo 'selected'; ?>>Female</option>
        </select><br><br>

        <label>Birthdate:</label><br>
        <input type="date" name="birthdate" value="<?php echo $row['birthdate']; ?>"><br><br>

        <input type="submit" name="update" value="Update" class="btn">
    </form>
    <br>
    <a href="index.php" class="btn">Back to Home</a>
</body>
</html>
