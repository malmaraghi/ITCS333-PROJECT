<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "room_booking"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch bookings with user and room details
$sql = "SELECT b.booking_id, b.status AS booking_status, b.start_time, b.end_time,
               u.username, u.email, r.room_name, r.room_department, r.room_type
        FROM bookings b
        INNER JOIN users u ON b.user_id = u.id
        INNER JOIN rooms r ON b.room_id = r.room_id";
$result = $conn->query($sql);

// Fetch data for pie chart
$pieChartSql = "SELECT room_department, COUNT(*) AS count
                FROM rooms
                GROUP BY room_department";
$pieChartResult = $conn->query($pieChartSql);
$chartData = [];
while ($row = $pieChartResult->fetch_assoc()) {
    $chartData[] = ['department' => $row['room_department'], 'count' => $row['count']];
}

$conn->close();
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
    <link rel="stylesheet" href="style.css">
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <!-- Content Header -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Admin Dashboard</h1>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Dashboard Stats -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-4 col-6">
                            <div class="small-box bg-gradient-info">
                                <div class="inner">
                                    <h3><?= $totalBookings ?></h3>
                                    <p>Total Bookings</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-6">
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

                        <div class="col-lg-4 col-6">
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
                                <th>Status</th>
                                <th>Start Time</th>
                                <th>End Time</th>
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
                                        <td><?= htmlspecialchars($row['booking_status']) ?></td>
                                        <td><?= htmlspecialchars($row['start_time']) ?></td>
                                        <td><?= htmlspecialchars($row['end_time']) ?></td>
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
            </section>

            <!-- Pie Chart -->
            <section class="content">
                <div class="container-fluid chart-section">
                    <h2>Room Usage by Department</h2>
                    <canvas id="pieChart"></canvas>
                </div>
            </section>
        </div>
    </div>

    <!-- Chart.js Integration -->
    <script>
        const chartData = <?= json_encode($chartData) ?>;
        const labels = chartData.map(data => data.department);
        const values = chartData.map(data => data.count);

        const ctx = document.getElementById('pieChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Room Usage',
                    data: values,
                    backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#17a2b8']
                }]
            }
        });
    </script>
</body>
</html>
