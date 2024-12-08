<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .table-section, .chart-section {
            margin: 20px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table-section {
            background: linear-gradient(135deg, #f9f9f9, #e6e6e6);
        }

        .chart-section {
            background: linear-gradient(135deg, #f0f9ff, #cce7ff);
        }

        .content-header h1 {
            color: #007bff;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        table th {
            background-color: #007bff;
            color: white;
        }

        table td {
            text-align: center;
        }

        .bg-gradient-info {
            background: linear-gradient(135deg, #17a2b8, #138496);
        }

        .small-box {
            text-align: center;
            padding: 15px;
            border-radius: 10px;
        }

        .small-box h3 {
            font-size: 2.2em;
        }

        .small-box i {
            font-size: 4em;
        }
    </style>
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
