<?php
session_start();
echo "Session Data: ";
print_r($_SESSION);

// Redirect to login if user is not logged in
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

// Show user dashboard content
echo "Welcome to the user dashboard, " . htmlspecialchars($_SESSION['user']['username']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- Logout Button -->
<form action="logout.php" method="POST">
 <button type="submit">Logout</button>
</form>

</body>
</html>