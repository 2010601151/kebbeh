<?php
// parent-dashboard.php

include 'db.php'; // Database connection
include 'header.php'; // Header include

session_start();

// Check if the user is logged in and is a parent
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'parent') {
    // Redirect to login page if not authorized
    header("Location: login_form.php"); // Adjust the path as necessary
    exit();
}

// Fetch parent and associated student information from the database
$username = $_SESSION['username'];

// Prepare and execute the query
$stmt = $conn->prepare("SELECT name, email, student_id, created_at FROM users WHERE username = ? AND role = ?");
$stmt->bind_param("ss", $username, $role);
$role = 'parent';
$stmt->execute();
$stmt->bind_result($name, $email, $student_id, $created_at);
$stmt->fetch();
$stmt->close();

// Fetch associated student information
if ($student_id) {
    $stmt = $conn->prepare("SELECT name, email, created_at FROM users WHERE id = ? AND role = 'student'");
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $stmt->bind_result($student_name, $student_email, $student_created_at);
    $stmt->fetch();
    $stmt->close();
} else {
    $student_name = "N/A";
    $student_email = "N/A";
    $student_created_at = "N/A";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Dashboard</title>
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
            <h3>Your Child's Information</h3>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($student_name); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($student_email); ?></p>
            <p><strong>Enrollment Date:</strong> <?php echo htmlspecialchars(date("F j, Y", strtotime($student_created_at))); ?></p>
        </section>

        <section>
            <h3>Notifications</h3>
            <ul>
                <li>Parent-Teacher Meeting on 2024-11-10</li>
                <li>School Picnic Scheduled for 2024-12-05</li>
                <!-- Replace with dynamic data as needed -->
            </ul>
        </section>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
