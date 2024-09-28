<!-- header.php -->
<header>
    <div class="container">
        <div class="logo">
            <img src="logo.png" alt="JLM Logo">
            <h1>Len Millar Junior And Senior High School</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <?php if (isset($_SESSION['username'])): ?>
                    <?php if ($_SESSION['role'] === 'student'): ?>
                        <li><a href="student-dashboard.php">Dashboard</a></li>
                    <?php elseif ($_SESSION['role'] === 'parent'): ?>
                        <li><a href="parent-dashboard.php">Dashboard</a></li>
                    <?php elseif ($_SESSION['role'] === 'staff'): ?>
                        <li><a href="staff-dashboard.php">Dashboard</a></li>
                    <?php endif; ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="student-login.php">Student Login</a></li>
                    <li><a href="staff-login.php">Staff Login</a></li>
                    <li><a href="parent-login.php">Parent Login</a></li>
                    <li><a href="register_form.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
