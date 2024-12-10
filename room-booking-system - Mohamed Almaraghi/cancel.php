<?php
session_start();
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the booking_id and room_id from the POST request
    $booking_id = $_POST['booking_id'];
    $room_id = $_POST['room_id'];

    try {
        // Begin a transaction to ensure both operations are done atomically
        $pdo->beginTransaction();

        // Step 1: Remove the booking from the 'bookings' table (delete the booking)
        $stmt = $pdo->prepare("DELETE FROM bookings WHERE booking_id = ?");
        $stmt->execute([$booking_id]);

        // Step 2: Update the room status to 'available' in the 'rooms' table
        $updateRoomStatus = $pdo->prepare("UPDATE rooms SET status = 'available' WHERE room_id = ?");
        $updateRoomStatus->execute([$room_id]);

        // Commit the transaction
        $pdo->commit();

        // Redirect to the room browsing page with a success message
        header("Location: ../Room browsing - Abdulla Saeed/index.php?status=cancel_success");
        exit();
    } catch (PDOException $e) {
        // Log the error for debugging purposes
        error_log("Error: " . $e->getMessage());

        // Rollback the transaction if something goes wrong
        $pdo->rollBack();

        // Redirect to the room browsing page with an error message
        header("Location: ../Room browsing - Abdulla Saeed/index.php?status=error");
        exit();
    }
}
?>
