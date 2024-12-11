<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $room_id = isset($_POST['room_id']) ? $_POST['room_id'] : null; // Check if it's an update
    $room_name = $_POST['room_name'];
    $capacity = $_POST['capacity'];
    $equipment = $_POST['equipment'];
    $room_department = $_POST['room_department'];
    $room_floor = $_POST['room_floor'];
    $status = $_POST['status'];
    $room_type = $_POST['room_type'];

    // Connection to the database
    $conn = new mysqli('localhost', 'root', '', 'room_booking');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the room name already exists
    if ($room_id) {
        // For updates, exclude the current room ID from the duplicate check
        $checkSql = "SELECT * FROM rooms WHERE room_name='$room_name' AND room_id != $room_id";
    } else {
        $checkSql = "SELECT * FROM rooms WHERE room_name='$room_name'";
    }
    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows > 0) {
        // Room with the same name exists
        echo "<script>alert('Room with the same name already exists. Please choose a different name.'); window.location.href='room_management.php';</script>";
    } else {
        // If room_id is provided, it's an update, otherwise it's an insert
        if ($room_id) {
            $sql = "UPDATE rooms SET 
                    room_name='$room_name', 
                    capacity='$capacity', 
                    equipment='$equipment', 
                    room_department='$room_department', 
                    room_floor='$room_floor', 
                    status='$status', 
                    room_type='$room_type' 
                    WHERE room_id=$room_id";
        } else {
            $sql = "INSERT INTO rooms (room_name, capacity, equipment, room_department, room_floor, status, room_type) 
                    VALUES ('$room_name', '$capacity', '$equipment', '$room_department', '$room_floor', '$status', '$room_type')";
        }

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Room saved successfully.'); window.location.href='room_management.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>
