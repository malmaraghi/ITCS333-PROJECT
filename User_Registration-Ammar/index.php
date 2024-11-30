<?php
if (isset($_SESSION['user'])) {
    echo "Session Data: " . print_r($_SESSION['user'], true);
} else {
    echo "No session data set.<br>";
}

// Redirect based on session
// if (isset($_SESSION['user'])) {
//     $redirectPage = $_SESSION['user']['account_type'] === 'admin' ? 'admin_dashboard.php' : 'user_dashboard.php';
//     header("Location: $redirectPage");
//     exit();
// }

// Determine the selected form (login or signup)
$formSelection = $_POST['form_selection'] ?? 'login'; // Default to 'login' if not set
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Sign-Up</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Form Selection Buttons -->
    <div class="button-container">
        <form method="POST">
            <input type="hidden" name="form_selection" value="login">
            <button type="submit">Login</button>
        </form>
        <form method="POST">
            <input type="hidden" name="form_selection" value="signup">
            <button type="submit">Sign Up</button>
        </form>
    </div>

    <!-- Login Form -->
    <?php if ($formSelection === 'login'): ?>
        <div class="form-container">
            <h2>Login</h2>
            <form method="POST" action="login_signup.php">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login">Login</button>
            </form>
        </div>
    <?php endif; ?>

    <!-- Sign-Up Form -->
    <?php if ($formSelection === 'signup'): ?>
        <div class="form-container">
            <h2>Sign Up</h2>
            <form method="POST" action="login_signup.php">
                <input type="text" name="username" placeholder="User Name" required>
                <input type="email" name="email" placeholder="e.g., 202206169@stu.uob.edu.bh" required>
                <input type="password" name="password" placeholder="Password" required>
                <select name="account_type" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <button type="submit" name="signup">Sign Up</button>
            </form>
        </div>
    <?php endif; ?>
</body>
</html>
