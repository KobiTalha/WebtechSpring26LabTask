<?php
// index.php - View All Students and Delete

// Include database connection
include 'db.php';

// Delete student if delete button is clicked
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM students WHERE id = $id";
    mysqli_query($conn, $query);
    $msg = "Student deleted successfully!";
}

// Fetch all students from database
$query = "SELECT * FROM students";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Management System</title>
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

        <!-- Show success message after delete -->
        <?php if (isset($msg)) { ?>
            <div class="success"><?php echo $msg; ?></div>
        <?php } ?>

        <h2>All Students</h2>

        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Registration No</th>
                <th>Department</th>
                <th>Actions</th>
            </tr>

            <?php
            // Loop through each student and display in table row
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['registration_no']; ?></td>
                    <td><?php echo $row['department']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="edit-link">Edit</a> |
                        <a href="index.php?delete=<?php echo $row['id']; ?>" class="delete-link"
                           onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
            <?php
                }
            } else {
            ?>
                <tr>
                    <td colspan="5">No students found. <a href="add.php">Add one</a></td>
                </tr>
            <?php } ?>

        </table>
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
