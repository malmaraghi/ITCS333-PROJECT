<?php
if (isset($_GET['id'])) {
    $room_id = $_GET['id'];

    // Connection to the database
    $conn = new mysqli('localhost', 'root', '', 'room_booking');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM rooms WHERE room_id=$room_id";

    if ($conn->query($sql) === TRUE) {
        echo "Room deleted successfully";
        header("Location: room_management.php");
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
}
?>
