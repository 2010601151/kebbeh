<!-- register_form.php -->
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
    <script src="scripts.js" defer></script>
</head>
<body>
    <!-- Header Included Above -->

    <!-- Registration Form -->
    <section id="registration">
        <h2>Register</h2>
        <form id="registrationForm" action="register.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required autofocus>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select id="role" name="role" required>
                    <option value="">Select Role</option>
                    <option value="student">Student</option>
                    <option value="parent">Parent</option>
                    <option value="staff">Staff</option>
                </select>
            </div>
            <div id="additional-fields"></div>
            <button type="submit">Register</button>
        </form>
        <div id="registrationFeedback"></div>
    </section>

    <?php include 'footer.php'; ?>
</body>
</html>
