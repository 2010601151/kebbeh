<?php
// staff-dashboard.php

include 'db.php'; // Database connection
include 'header.php'; // Header include

session_start();

// Check if the user is logged in and is staff
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'staff') {
    // Redirect to login page if not authorized
    header("Location: login_form.php"); // Adjust the path as necessary
    exit();
}

// Fetch staff information from the database
$username = $_SESSION['username'];

// Prepare and execute the query
$stmt = $conn->prepare("SELECT name, email, role_name, created_at FROM users WHERE username = ? AND role = ?");
$stmt->bind_param("ss", $username, $role);
$role = 'staff';
$stmt->execute();
$stmt->bind_result($name, $email, $role_name, $created_at);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Header is already included via header.php -->

    <main>
        <section>
            <h2>Welcome, <?php echo htmlspecialchars($name); ?>!</h2>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
            <p><strong>Role:</strong> <?php echo htmlspecialchars(ucfirst($role_name)); ?></p>
            <p><strong>Member Since:</strong> <?php echo htmlspecialchars(date("F j, Y", strtotime($created_at))); ?></p>
        </section>

        <section>
            <h3>Your Classes</h3>
            <ul>
                <li>Mathematics - Grade 10</li>
                <li>Physics - Grade 11</li>
                <!-- Replace with dynamic data as needed -->
            </ul>
        </section>

        <section>
            <h3>Upcoming Meetings</h3>
            <ul>
                <li>Department Meeting on 2024-10-25</li>
                <li>Curriculum Planning on 2024-11-15</li>
                <!-- Replace with dynamic data as needed -->
            </ul>
        </section>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
