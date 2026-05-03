<?php
/**
 * setup.php - Database Setup Script
 * 
 * Run this file ONCE to create the database and table.
 * URL: http://localhost/Webtech/student_management/setup.php
 * 
 * After running, you can delete this file.
 */

// Connect to MySQL without selecting a database
$conn = mysqli_connect("localhost", "root", "");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Step 1: Create the database
$sql = "CREATE DATABASE IF NOT EXISTS student_management";
if (mysqli_query($conn, $sql)) {
    echo "✅ Database 'student_management' created successfully.<br>";
} else {
    echo "❌ Error creating database: " . mysqli_error($conn) . "<br>";
}

// Step 2: Select the database
mysqli_select_db($conn, "student_management");

// Step 3: Create the students table
$sql = "CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    registration_no VARCHAR(20) NOT NULL,
    department VARCHAR(50) NOT NULL
)";

if (mysqli_query($conn, $sql)) {
    echo "✅ Table 'students' created successfully.<br>";
} else {
    echo "❌ Error creating table: " . mysqli_error($conn) . "<br>";
}

echo "<br>🎉 Setup complete! <a href='index.php'>Go to Student Management System</a>";

// Close connection
mysqli_close($conn);
?>
