<?php
// edit.php - Edit Student

// Include database connection
include 'db.php';

// Get student ID from URL
$id = $_GET['id'];

// Handle form submission (update)
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $department = $_POST['department'];

    // Update student in database
    $query = "UPDATE students SET name='$name', email='$email', department='$department' WHERE id=$id";

    if (mysqli_query($conn, $query)) {
        $msg = "Student updated successfully!";
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}

// Fetch student data to pre-fill the form
$query = "SELECT * FROM students WHERE id = $id";
$result = mysqli_query($conn, $query);
$student = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Header -->
    <div class="header">
        <h1>Student Management System</h1>
    </div>

    <!-- Navigation -->
    <div class="nav">
        <a href="index.php">View Students</a>
        <a href="add.php">Add Student</a>
    </div>

    <!-- Main Content -->
    <div class="container">

        <!-- Show success or error message -->
        <?php if (isset($msg)) { ?>
            <div class="success"><?php echo $msg; ?></div>
        <?php } ?>
        <?php if (isset($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>

        <!-- Edit Student Form -->
        <div class="form-box">
            <h2>Edit Student</h2>

            <form action="edit.php?id=<?php echo $id; ?>" method="POST">

                <label>Name:</label>
                <input type="text" name="name" value="<?php echo $student['name']; ?>" required>

                <label>Email:</label>
                <input type="email" name="email" value="<?php echo $student['email']; ?>" required>

                <label>Registration Number:</label>
                <input type="text" value="<?php echo $student['registration_no']; ?>" disabled>

                <label>Department:</label>
                <input type="text" name="department" value="<?php echo $student['department']; ?>" required>

                <button type="submit" name="update">Update Student</button>

            </form>

            <br>
            <a href="index.php">Back to Student List</a>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        Student Management System &copy; <?php echo date('Y'); ?>
    </div>

</body>
</html>

<?php
// Close connection
mysqli_close($conn);
?>
