<?php
header('Content-Type: application/json');
include 'db.php';

$sql = "SELECT * FROM Rooms";
$result = $conn->query($sql);

$rooms = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $rooms[] = $row;
    }
}
echo json_encode($rooms);
$conn->close();
?>
