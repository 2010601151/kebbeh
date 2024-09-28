<?php
// student-dashboard.php

include 'db.php'; // Database connection
include 'header.php'; // Header include

session_start();

// Check if the user is logged in and is a student
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'student') {
    // Redirect to login page if not authorized
    header("Location: login_form.php"); // Adjust the path as necessary
    exit();
}

// Fetch student information from the database
$username = $_SESSION['username'];

// Prepare and execute the query
$stmt = $conn->prepare("SELECT name, email, created_at FROM users WHERE username = ? AND role = ?");
$stmt->bind_param("ss", $username, $role);
$role = 'student';
$stmt->execute();
$stmt->bind_result($name, $email, $created_at);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Header is already included via header.php -->

    <main>
        <section>
            <h2>Welcome, <?php echo htmlspecialchars($name); ?>!</h2>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
            <p><strong>Member Since:</strong> <?php echo htmlspecialchars(date("F j, Y", strtotime($created_at))); ?></p>
        </section>

        <section>
            <h3>Your Courses</h3>
            <ul>
                <li>Mathematics</li>
                <li>English Literature</li>
                <li>Physics</li>
                <li>History</li>
                <!-- Replace with dynamic data as needed -->
            </ul>
        </section>

        <section>
            <h3>Upcoming Assignments</h3>
            <ul>
                <li>Calculus Homework - Due: 2024-10-15</li>
                <li>Essay on Shakespeare - Due: 2024-10-20</li>
                <!-- Replace with dynamic data as needed -->
            </ul>
        </section>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
