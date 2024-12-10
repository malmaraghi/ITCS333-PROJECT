<?php
session_start();
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = $_POST['booking_id'];
    $room_id = $_POST['room_id'];

    try {
        $pdo->beginTransaction();

        // Step 1: remove the booking from the 'bookings' table (delete the booking)
        $stmt = $pdo->prepare("DELETE FROM bookings WHERE booking_id = ?");
        $stmt->execute([$booking_id]);

        // Step 2: update the room status to 'available' in the 'rooms' table
        $updateRoomStatus = $pdo->prepare("UPDATE rooms SET status = 'available' WHERE room_id = ?");
        $updateRoomStatus->execute([$room_id]);

        $pdo->commit();

        header("Location: ../Room browsing - Abdulla Saeed/index.php?status=cancel_success");
        exit();
    } catch (PDOException $e) {
        error_log("Error: " . $e->getMessage());

        $pdo->rollBack();

        header("Location: ../Room browsing - Abdulla Saeed/index.php?status=error");
        exit();
    }
}
?>
