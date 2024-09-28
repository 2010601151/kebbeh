<?php 
// db.php
$servername = "localhost"; // Typically 'localhost' when using XAMPP
$username = "your_db_username"; // Replace with your MySQL username
$password = "your_db_password"; // Replace with your MySQL password
$dbname = "school_portal"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
