<?php
include('db.php'); 

if (isset($_GET['status'])) {
    $messages = [
        'success' => "Booking confirmed successfully!",
        'cancel_success' => "Booking canceled successfully!",
        'conflict' => "Sorry! This room is already booked for the selected time.",
        'invalid_time' => "Bookings must be between 8:00 AM and 10:00 PM.",
        'duration_exceeded' => "Bookings cannot exceed 2 hours.",
        'invalid_time_order' => "End time must be later than start time.",
        'error' => "An error occurred. Please try again.",
        'invalid' => "Invalid request method."
    ];

    if (isset($messages[$_GET['status']])) {
        echo "<div class='feedback-message'>" . $messages[$_GET['status']] . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Booking System</title>
    <link rel="stylesheet" href="style.css">
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var startTimeInput = document.getElementById('start_time');
            var endTimeInput = document.getElementById('end_time');

            startTimeInput.addEventListener('change', function () {
                var startTime = new Date(startTimeInput.value);
                var endTime = new Date(startTime.getTime() + 60 * 60 * 1000); // Add 1 hour
                endTimeInput.value = endTime.toISOString().slice(0, 16);
            });
        });
    </script>
</head>
<body>
    <h1>Book a Room</h1>
    
    <!-- Change the form action to link to room_browsing.php -->
    <form action="room_browsing.php" method="GET">
        <label for="room_type">Room Type:</label>
        <select name="room_type" id="room_type" required>
            <option value="Meeting Room">Meeting Room</option>
            <option value="Lecture Room">Lecture Room</option>
            <option value="Computer Lab">Computer Lab</option>
        </select>
        <br><br>

        <label for="start_time">Start Time:</label>
        <input type="datetime-local" name="start_time" id="start_time" required>
        <br><br>

        <label for="end_time">End Time:</label>
        <input type="datetime-local" name="end_time" id="end_time" required>
        <br><br>

        <button type="submit">Browse Rooms</button>
    </form>

    <h2>Your Bookings</h2>
    <div class="bookings-container">
        <table class="bookings-table">
            <thead>
                <tr>
                    <th>Room</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $user_id = 3; // temporary user ID
                $stmt = $pdo->prepare("
                    SELECT bookings.booking_id, rooms.room_name, bookings.start_time, bookings.end_time 
                    FROM bookings
                    JOIN rooms ON bookings.room_id = rooms.room_id
                    WHERE bookings.user_id = ?
                ");
                $stmt->execute([$user_id]);
                while ($booking = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "
                    <tr>
                        <td>{$booking['room_name']}</td>
                        <td>{$booking['start_time']}</td>
                        <td>{$booking['end_time']}</td>
                        <td>
                            <form action='cancel.php' method='POST'>
                                <input type='hidden' name='booking_id' value='{$booking['booking_id']}'>
                                <button type='submit' class='cancel-button'>Cancel</button>
                            </form>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
