<?php
session_start();
session_destroy();
header("Location: welcomepage.php"); // Redirect to the main page
exit();
?>