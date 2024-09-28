<?php
// register.php
include 'db.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $email = trim($_POST['email']);
    $name = trim($_POST['name']);
    $role = trim($_POST['role']);
    $student_id = isset($_POST['student_id']) ? trim($_POST['student_id']) : null;
    $role_name = isset($_POST['role_name']) ? trim($_POST['role_name']) : null;

    // Basic validation
    if (empty($username) || empty($password) || empty($email) || empty($name) || empty($role)) {
        echo "Please fill in all required fields.";
        exit();
    }

    // Check if username or email already exists
    $check_stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    if ($check_stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $check_stmt->bind_param("ss", $username, $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        echo "Username or email already exists.";
        $check_stmt->close();
        $conn->close();
        exit();
    }
    $check_stmt->close();

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (username, password, email, name, role, student_id, role_name) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sssssss", $username, $password, $email, $name, $role, $student_id, $role_name);

    if ($stmt->execute()) {
        echo "Registration successful! Redirecting to login...";
        // Redirect to login page after successful registration
        header("refresh:2;url=login.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
