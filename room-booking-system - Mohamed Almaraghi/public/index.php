<?php
include('../config.php'); 

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
    <link rel="stylesheet" href="../assets/styles.css">
</head>

<body>
    <h1>Book a Room</h1>
    <form action="book.php" method="POST">
        <label for="room_id">Select Room:</label>
        <select name="room_id" id="room_id" required>
            <?php
            $stmt = $pdo->query("SELECT * FROM rooms");
            while ($room = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='{$room['room_id']}'>{$room['room_name']} (Capacity: {$room['capacity']})</option>";
            }
            ?>
        </select>
        <br><br>

        <label for="start_time">Start Time:</label>
        <input type="datetime-local" name="start_time" id="start_time" required>
        <br><br>

        <label for="end_time">End Time:</label>
        <input type="datetime-local" name="end_time" id="end_time" required>
        <br><br>

        <button type="submit">Book Room</button>
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
                $user_id = 1; // temporary user ID
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
