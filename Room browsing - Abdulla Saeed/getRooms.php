<?php
include('db.php');

// Fetch filter values
$room_type = $_GET['room_type'] ?? '';
$start_time = $_GET['start_time'] ?? '';
$end_time = $_GET['end_time'] ?? '';
$floor = $_GET['floor'] ?? '';
$department = $_GET['department'] ?? '';

// Build the query with filters
$query = "SELECT * FROM rooms WHERE 1=1";
$params = [];

if ($room_type) {
    $query .= " AND room_type = ?";
    $params[] = $room_type;
}
if ($start_time && $end_time) {
    // Add your time range logic here
    // For example: Check if the room is available within the specified time range
}
if ($floor) {
    $query .= " AND room_floor = ?";
    $params[] = $floor;
}
if ($department) {
    $query .= " AND room_department = ?";
    $params[] = $department;
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Browsing</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .grid-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding: 20px;
        }

        .room-card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
        }

        .status-available {
            background-color: #d4edda;
        }

        .status-occupied {
            background-color: #fff3cd;
        }

        .status-unavailable {
            background-color: #f8d7da;
        }

        .room-status {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Room Browsing</h1>

    <!-- Filter Form -->
    <form method="GET" action="room_browsing.php">
        <label for="floor">Floor:</label>
        <select name="floor" id="floor">
            <option value="">All Floors</option>
            <option value="1">1st Floor</option>
            <option value="2">2nd Floor</option>
            <option value="3">3rd Floor</option>
        </select>
        <br><br>

        <label for="department">Department:</label>
        <select name="department" id="department">
            <option value="">All Departments</option>
            <option value="IT">IT</option>
            <option value="HR">HR</option>
            <option value="Finance">Finance</option>
        </select>
        <br><br>

        <button type="submit">Filter</button>
    </form>
    
    <div class="grid-container">
        <?php foreach ($rooms as $room): ?>
            <div class="room-card status-<?php echo strtolower($room['status']); ?>">
                <h2><?php echo htmlspecialchars($room['room_name']); ?></h2>
                <p><strong>Department:</strong> <?php echo htmlspecialchars($room['room_department']); ?></p>
                <p><strong>Floor:</strong> <?php echo htmlspecialchars($room['room_floor']); ?></p>
                <p><strong>Capacity:</strong> <?php echo htmlspecialchars($room['capacity']); ?></p>
                <p><strong>Equipment:</strong> <?php echo htmlspecialchars($room['equipment']); ?></p>
                <p class="room-status"><strong>Status:</strong> <?php echo htmlspecialchars($room['status']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
