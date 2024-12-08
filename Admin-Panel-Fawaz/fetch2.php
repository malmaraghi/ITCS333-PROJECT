<?php
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
?>
