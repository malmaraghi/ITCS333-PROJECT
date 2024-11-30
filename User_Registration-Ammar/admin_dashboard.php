<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['account_type'] !== 'admin') {
    header("Location: index.php");
    exit();
}
echo "Welcome, " . $_SESSION['user']['username'] . "! This is the Admin Dashboard.";
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
