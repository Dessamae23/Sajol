<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Performance Tracker</title>
    <link rel="stylesheet" href="sp.css">
</head>
<body>

    <header>
        <h1>Student Performance Tracker</h1>
    </header>

    <section>
        <h2>Student List</h2>
        <a href="add_student.php" class="btn">Add Student</a>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Birthdate</th>
                <th>Actions</th>
            </tr>

            <?php
            $sql = "SELECT * FROM students";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>{$row['student_id']}</td>
                    <td>{$row['first_name']} {$row['last_name']}</td>
                    <td>{$row['gender']}</td>
                    <td>{$row['birthdate']}</td>
                    <td>
                        <a href='update_student.php?id={$row['student_id']}' class='edit-btn'>Edit</a>
                        <a href='delete_student.php?id={$row['student_id']}' class='delete-btn'>Delete</a>
                    </td>
                </tr>";
            }
            ?>
        </table>
    </section>

    <section>
        <h2>Grades Table</h2>
        <!-- Add Grade Input Form -->
        <form action="add_grade.php" method="post" class="grade-form">
            <label for="student_id">Student:</label>
            <select name="student_id" id="student_id" required>
                <option value="">Select Student</option>
                <?php
                $students = mysqli_query($conn, "SELECT student_id, first_name, last_name FROM students");
                while ($stu = mysqli_fetch_assoc($students)) {
                    echo "<option value=\"{$stu['student_id']}\">{$stu['first_name']} {$stu['last_name']}</option>";
                }
                ?>
            </select>

            <label for="grade">Grade:</label>
            <input type="number" step="0.01" name="grade" id="grade" required>

            <button type="submit" class="btn">Add Grade</button>
        </form>
        <!-- Show Grades Table -->
        <table>
            <tr>
                <th>Name</th>
                <th>Grade</th>
            </tr>
            <?php
            $sql = "SELECT s.first_name, s.last_name, g.grade
                    FROM students s
                    JOIN grades g ON s.student_id = g.student_id";
            $result = mysqli_query($conn, $sql);

            while ($r = mysqli_fetch_assoc($result)) {
                echo "<tr><td>{$r['first_name']} {$r['last_name']}</td><td>{$r['grade']}</td></tr>";
            }
            ?>
        </table>
    </section>

    <section>
        <h2>Students Above Average</h2>

        <?php
        $sql = "SELECT s.first_name, s.last_name, g.grade
                FROM students s
                JOIN grades g ON s.student_id = g.student_id
                WHERE g.grade > (SELECT AVG(grade) FROM grades)";
        $result = mysqli_query($conn, $sql);

        echo "<table>
        <tr><th>Name</th><th>Grade</th></tr>";
        while ($r = mysqli_fetch_assoc($result)) {
            echo "<tr><td>{$r['first_name']} {$r['last_name']}</td><td>{$r['grade']}</td></tr>";
        }
        echo "</table>";
        ?>
    </section>

</body>
</html>