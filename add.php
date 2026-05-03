<?php
// add.php - Add New Student

// Include database connection
include 'db.php';

// Handle form submission
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $registration_no = $_POST['registration_no'];
    $department = $_POST['department'];

    // Insert student into database
    $query = "INSERT INTO students (name, email, registration_no, department) 
              VALUES ('$name', '$email', '$registration_no', '$department')";

    if (mysqli_query($conn, $query)) {
        $msg = "Student added successfully!";
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
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

        <!-- Add Student Form -->
        <div class="form-box">
            <h2>Add New Student</h2>

            <form action="add.php" method="POST">

                <label>Name:</label>
                <input type="text" name="name" required>

                <label>Email:</label>
                <input type="email" name="email" required>

                <label>Registration Number:</label>
                <input type="text" name="registration_no" required>

                <label>Department:</label>
                <input type="text" name="department" required>

                <button type="submit" name="submit">Add Student</button>

            </form>
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
