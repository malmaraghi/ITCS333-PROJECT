<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

    $sql = "INSERT INTO rooms (room_name, capacity, equipment, room_department, room_floor, status, room_type) 
            VALUES ('$room_name', '$capacity', '$equipment', '$room_department', '$room_floor', '$status', '$room_type')";

    if ($conn->query($sql) === TRUE) {
        echo "New room added successfully";
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

<form method="POST">
    Room Name: <input type="text" name="room_name"><br>
    Capacity: <input type="number" name="capacity"><br>
    Equipment: <input type="text" name="equipment"><br>
    Department: <input type="text" name="room_department"><br>
    Floor: <input type="number" name="room_floor"><br>
    Status: <input type="text" name="status"><br>
    Room Type: <input type="text" name="room_type"><br>
    <input type="submit" value="Add Room">
</form>
