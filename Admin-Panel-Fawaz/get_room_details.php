<?php
// Get room details
if (isset($_GET['id'])) {
    $roomId = $_GET['id'];
    $conn = new mysqli('localhost', 'root', '', 'room_booking');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM rooms WHERE room_id = $roomId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $room = $result->fetch_assoc();
        echo json_encode($room);
    } else {
        echo json_encode(['error' => 'Room not found']);
    }

    $conn->close();
} else {
    echo json_encode(['error' => 'Room ID is missing']);
}
?>
