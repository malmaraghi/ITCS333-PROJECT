<?php
session_start();
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = $_POST['booking_id'];

    try {
        // delete the booking from the database
        $stmt = $pdo->prepare("DELETE FROM bookings WHERE booking_id = ?");
        $stmt->execute([$booking_id]);

        // redirect back with success message
        header("Location: ../Room browsing - Abdulla Saeed/index.php?status=success");
        exit;

    } catch (PDOException $e) {
        // handle database errors
        header("Location: ../Room browsing - Abdulla Saeed/index.php?status=error");
        exit();
    }
} else {
    header("Location: ../Room browsing - Abdulla Saeed/index.php?status=invalid");
    exit();
}
?>
