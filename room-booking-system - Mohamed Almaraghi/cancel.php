<?php
session_start();
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = $_POST['booking_id'];

    try {
        // Delete the booking from the database
        $stmt = $pdo->prepare("DELETE FROM bookings WHERE booking_id = ?");
        $stmt->execute([$booking_id]);

        // Redirect back with success message
        header("Location: ../Room browsing - Abdulla Saeed/index.php?status=success");
        exit;

    } catch (PDOException $e) {
        // Handle database errors
        header("Location: ../Room browsing - Abdulla Saeed/index.php?status=error");
        exit();
    }
} else {
    // Invalid request
    header("Location: ../Room browsing - Abdulla Saeed/index.php?status=invalid");
    exit();
}
?>
