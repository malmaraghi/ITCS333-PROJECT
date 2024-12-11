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

    if ($end_timestamp < $start_timestamp) {
        header("Location: ../Room browsing - Abdulla Saeed/index.php?status=invalid_time_order");
        exit();
    }

    $start_hour = date('H:i', $start_timestamp);
    $end_hour = date('H:i', $end_timestamp);

    if ($start_hour < '08:00' || $end_hour > '22:00') {
        header("Location: ../Room browsing - Abdulla Saeed/index.php?status=invalid_time");
        exit();
    }

    $duration = ($end_timestamp - $start_timestamp) / 3600; 
    if ($duration > 2) {
        header("Location: ../Room browsing - Abdulla Saeed/index.php?status=duration_exceeded");
        exit();
    }

    try {
        $stmt = $pdo->prepare("SELECT status FROM rooms WHERE room_id = ?");
        $stmt->execute([$room_id]);
        $room = $stmt->fetch();

        if ($room['status'] !== 'Available') {
            header("Location: ../Room browsing - Abdulla Saeed/index.php?status=unavailable_room");
            exit();
        }

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
            $stmt = $pdo->prepare("UPDATE rooms SET status = 'Occupied' WHERE room_id = ?");
            $stmt->execute([$room_id]);

            $stmt = $pdo->prepare("
                INSERT INTO bookings (user_id, room_id, start_time, end_time, status) 
                VALUES (?, ?, ?, ?, ?)
            ");
            $stmt->execute([$user_id, $room_id, $start_date, $end_date, 'confirmed']);


            header("Location: ../Room browsing - Abdulla Saeed/index.php?status=success");
            exit();
        }
    } catch (PDOException $e) {
        header("Location: ../Room browsing - Abdulla Saeed/index.php?status=error");
        exit();
    }
} else {
    header("Location: ../Room browsing - Abdulla Saeed/index.php?status=invalid");
    exit();
}
?>
