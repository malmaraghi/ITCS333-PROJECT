<?php
// if (isset($_SESSION['user'])) {
//     echo "Session Data: " . print_r($_SESSION['user'], true);
// } else {
//     echo "No session data set.<br>";
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
    <link rel="stylesheet" href="styleindex.css">
</head>
<body>

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
            <h6>Account Type</h6>
            <select name="account_type" placeholder="User Name" required>
                    <option value="user">User</option>
                    <!-- <option value="admin">Admin</option> -->
                </select>
                <input type="text" name="username" placeholder="User Name" required>
                <input type="email" name="email" placeholder="e.g., 202206169@stu.uob.edu.bh" required>
                <input type="password" name="password" placeholder="Password" required>
               
                <button type="submit" name="signup">Sign Up</button>
            </form>
        </div>
    <?php endif; ?>

     <!-- Form Selection Buttons -->
     <div class="button-container2">
        <form method="POST">
            <input type="hidden" name="form_selection" value="login">
            <button type="submit" class="form-button">Login</button>
        </form>
        <form method="POST">
            <input type="hidden" name="form_selection" value="signup">
            <button type="submit" class="form-button">Sign Up</button>
        </form>
    </div>


   
</body>
</html>
