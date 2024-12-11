<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "room_booking";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch total bookings count
$totalBookingsSql = "SELECT COUNT(*) AS total FROM bookings";
$totalBookingsResult = $conn->query($totalBookingsSql);
$totalBookings = $totalBookingsResult->fetch_assoc()['total'] ?? 0;

// Fetch available rooms count
$availableRoomsSql = "SELECT COUNT(*) AS total FROM rooms WHERE status = 'available'";
$availableRoomsResult = $conn->query($availableRoomsSql);
$availableRooms = $availableRoomsResult->fetch_assoc()['total'] ?? 0;

// Fetch occupied rooms count
$occupiedRoomsSql = "SELECT COUNT(*) AS total FROM rooms WHERE status = 'occupied'";
$occupiedRoomsResult = $conn->query($occupiedRoomsSql);
$occupiedRooms = $occupiedRoomsResult->fetch_assoc()['total'] ?? 0;

// Fetch unavailable rooms count
$unavailableRoomsSql = "SELECT COUNT(*) AS total FROM rooms WHERE status = 'unavailable'";
$unavailableRoomsResult = $conn->query($unavailableRoomsSql);
$unavailableRooms = $unavailableRoomsResult->fetch_assoc()['total'] ?? 0;

// Fetch bookings with user and room details
$sql = "SELECT b.booking_id, b.status AS booking_status, b.start_time, b.end_time,
               u.username, u.email, r.room_name, r.room_department, r.room_type
        FROM bookings b
        INNER JOIN users u ON b.user_id = u.id
        INNER JOIN rooms r ON b.room_id = r.room_id";
$result = $conn->query($sql);

// Fetch department-wise data
$departments = ['ITIS', 'ITCS', 'ITCE'];
$departmentRooms = [];

foreach ($departments as $department) {
    $totalRoomsSql = "SELECT COUNT(*) AS total_rooms 
                      FROM rooms 
                      WHERE room_department = '$department'";
    $totalRoomsResult = $conn->query($totalRoomsSql);
    $totalRooms = $totalRoomsResult->fetch_assoc()['total_rooms'] ?? 0;

    $bookedRoomsSql = "SELECT COUNT(*) AS booked_rooms 
                       FROM bookings b
                       INNER JOIN rooms r ON b.room_id = r.room_id
                       WHERE r.room_department = '$department'";
    $bookedRoomsResult = $conn->query($bookedRoomsSql);
    $bookedRooms = $bookedRoomsResult->fetch_assoc()['booked_rooms'] ?? 0;

    $departmentRooms[$department] = [
        'total_rooms' => $totalRooms,
        'booked_rooms' => $bookedRooms
    ];
}

$conn->close();

// Current page
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="adminstyle.css">
</head>

<body>
    <div class="wrapper">
        <!-- Navigation Bar -->
        <nav>
            <a href="index.php" class="<?= $currentPage == 'index.php' ? 'active' : ''; ?>">Dashboard</a>
            <a href="room_management.php" class="<?= $currentPage == 'room_management.php' ? 'active' : ''; ?>">Room
                Management</a>
            <a href="users.php" class="<?= $currentPage == 'users.php' ? 'active' : ''; ?>">Users</a>
        </nav>

        <!-- Content Header -->
        <section class="content-header">
            <div class="container-fluid">
                <h1>Admin Dashboard</h1>
            </div>
        </section>

        <!-- Dashboard Stats -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="small-box bg-gradient-info">
                        <!-- <div class="small-box bg-gradient-info" style="min-height: 180px;"> -->
                            <div class="inner">
                                <h3><?= $totalBookings ?></h3>
                                <p>Total Bookings</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?= $availableRooms ?></h3>
                                <p>Available Rooms</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-door-open"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?= $occupiedRooms ?></h3>
                                <p>Occupied Rooms</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-door-closed"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3><?= $unavailableRooms ?></h3>
                                <p>Unavailable Rooms</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-ban"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Room Booking Table -->
        <section class="content">
            <div class="container-fluid table-section">
                <h2>Room Bookings</h2>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Room Name</th>
                            <th>Booked By</th>
                            <th>Department</th>
                            <th>Type</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result && $result->num_rows > 0):
                            while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['booking_id']) ?></td>
                                    <td><?= htmlspecialchars($row['room_name']) ?></td>
                                    <td><?= htmlspecialchars($row['username']) ?> (<?= htmlspecialchars($row['email']) ?>)</td>
                                    <td><?= htmlspecialchars($row['room_department']) ?></td>
                                    <td><?= htmlspecialchars($row['room_type']) ?></td>
                                    <td><?= htmlspecialchars($row['start_time']) ?></td>
                                    <td><?= htmlspecialchars($row['end_time']) ?></td>
                                    <td><?= htmlspecialchars($row['booking_status']) ?></td>
                                </tr>
                            <?php endwhile;
                        else: ?>
                            <tr>
                                <td colspan="8">No bookings available</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <br>
        </section>

        <!-- Rooms by Department -->
        <section class="content">
            <div class="container-fluid">
                <h2>Rooms by Department</h2>
                <div class="row">
                    <?php foreach ($departments as $department): ?>
                        <div class="col-lg-4 col-md-6 col-12" >
                            <div
                                class="small-box <?= $department == 'ITIS' ? 'bg-info' : ($department == 'ITCS' ? 'bg-success' : 'bg-warning') ?>">
                                <div class="inner">
                                    <h3>Total: <?= $departmentRooms[$department]['total_rooms'] ?></h3>
                                    <p>Booked: <?= $departmentRooms[$department]['booked_rooms'] ?></p>
                                    <p>Department: <?= htmlspecialchars($department) ?></p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-building"></i>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </div>
</body>

</html>
