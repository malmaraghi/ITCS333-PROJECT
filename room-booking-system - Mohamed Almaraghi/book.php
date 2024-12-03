<?php
session_start();
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room_id = $_POST['room_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $user_id = $_POST['user_id'];

    if (empty($start_date) || empty($end_date)) {
        header("Location: ../Room browsing - Abdulla Saeed/index.php?status=error");
        exit();
    }

    

    $start_timestamp = strtotime($start_date);
    $end_timestamp = strtotime($end_date);

    // validate end time is later than the start time
    if ($end_timestamp < $start_timestamp) {
        header("Location: ../Room browsing - Abdulla Saeed/index.php?status=invalid_time_order");
        exit();
    }

    // validate the booking time is within valid hours (8:00 AM to 10:00 PM in UOB)
    $start_hour = date('H:i', $start_timestamp);
    $end_hour = date('H:i', $end_timestamp);

    if ($start_hour < '08:00' || $end_hour > '22:00') {
        header("Location: ../Room browsing - Abdulla Saeed/index.php?status=invalid_time");
        exit();
    }

    // validate the booking duration does not exceed 2 hours
    $duration = ($end_timestamp - $start_timestamp) / 3600; // Duration in hours
    if ($duration > 2) {
        header("Location: ../Room browsing - Abdulla Saeed/index.php?status=duration_exceeded");
        exit();
    }

    // check for booking conflicts
    try {
        $stmt = $pdo->prepare("
            SELECT * FROM bookings 
            WHERE room_id = ? 
            AND (
                (start_time < ? AND end_time > ?) OR 
                (start_time < ? AND end_time > ?)
            )
        ");
        $stmt->execute([$room_id, $end_date, $start_date, $end_date, $start_date]);
        $conflict = $stmt->fetch();

        if ($conflict) {
            header("Location: ../Room browsing - Abdulla Saeed/index.php?status=conflict");
            exit();
        } else {
            $stmt = $pdo->prepare("
                INSERT INTO bookings (user_id, room_id, start_time, end_time) 
                VALUES (?, ?, ?, ?)
            ");
            $stmt->execute([$user_id, $room_id, $start_date, $end_date]);

            // success message
            header("Location: ../Room browsing - Abdulla Saeed/index.php?status=success");
            exit();
        }
    } catch (PDOException $e) {
        header("Location: ../Room browsing - Abdulla Saeed/index.php?status=error");
        exit();
    }
} else {
    // invalid message
    header("Location: ../Room browsing - Abdulla Saeed/index.php?status=invalid");
    exit();
}
?>
