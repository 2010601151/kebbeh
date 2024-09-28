<?php
// login.php
include 'db.php'; // Include the database connection
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user inputs
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ? AND role = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ss", $username, $role);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            // Password is correct
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            echo "Login successful! Redirecting...";
            // Redirect based on role
            if ($role == 'student') {
                header("refresh:2;url=student-dashboard.php");
            } elseif ($role == 'parent') {
                header("refresh:2;url=parent-dashboard.php");
            } elseif ($role == 'staff') {
                header("refresh:2;url=staff-dashboard.php");
            }
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that username and role.";
    }

    $stmt->close();
}

$conn->close();
?>
