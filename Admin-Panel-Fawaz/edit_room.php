<?php
if (isset($_GET['id'])) {
    $room_id = $_GET['id'];

    // Connection to the database
    $conn = new mysqli('localhost', 'root', '', 'room_booking');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get POST data
        $room_name = $_POST['room_name'];
        $capacity = $_POST['capacity'];
        $equipment = $_POST['equipment'];
        $room_department = $_POST['room_department'];
        $room_floor = $_POST['room_floor'];
        $status = $_POST['status'];
        $room_type = $_POST['room_type'];

        // Prepared statement to update room details
        $stmt = $conn->prepare("UPDATE rooms SET 
                                room_name=?, 
                                capacity=?, 
                                equipment=?, 
                                room_department=?, 
                                room_floor=?, 
                                status=?, 
                                room_type=? 
                                WHERE room_id=?");

        if ($stmt) {
            $stmt->bind_param("sisssssi", $room_name, $capacity, $equipment, $room_department, $room_floor, $status, $room_type, $room_id);
            if ($stmt->execute()) {
                // Redirect back to room management page after successful update
                header("Location: room_management.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    }

    // Fetch current room details
    $sql = "SELECT * FROM rooms WHERE room_id=$room_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $room = $result->fetch_assoc();
    } else {
        echo "Room not found!";
        exit();
    }
    $conn->close();
} else {
    echo "Room ID is missing!";
    exit;
}
?>

<form method="POST">
    Room Name: <input type="text" name="room_name" value="<?php echo htmlspecialchars($room['room_name']); ?>" required><br>
    Capacity: <input type="number" name="capacity" value="<?php echo htmlspecialchars($room['capacity']); ?>" required><br>
    Equipment: <input type="text" name="equipment" value="<?php echo htmlspecialchars($room['equipment']); ?>" required><br>
    Department: <input type="text" name="room_department" value="<?php echo htmlspecialchars($room['room_department']); ?>" required><br>
    Floor: <input type="number" name="room_floor" value="<?php echo htmlspecialchars($room['room_floor']); ?>" required><br>
    Status: <input type="text" name="status" value="<?php echo htmlspecialchars($room['status']); ?>" required><br>
    Room Type: <input type="text" name="room_type" value="<?php echo htmlspecialchars($room['room_type']); ?>" required><br>
    <input type="submit" value="Update Room">
</form>
