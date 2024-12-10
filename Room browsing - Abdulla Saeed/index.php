<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Room Booking System</title>
  <link rel="stylesheet" href="style.css">
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const hamburger = document.querySelector('.hamburger');
      const menu = document.getElementById('menu');

      hamburger.addEventListener('click', function () {
        menu.classList.toggle('show');
      });

      // Update End Time Automatically
      const startTimeInput = document.getElementById('start_date');
      const endTimeInput = document.getElementById('end_date');

      startTimeInput.addEventListener('input', function () {
        const startTime = new Date(startTimeInput.value);
        if (!isNaN(startTime.getTime())) {
          const endTime = new Date(startTime.getTime() + 60 * 60 * 1000);
          const formattedEndTime = endTime.toISOString().slice(0, 16);
          endTimeInput.value = formattedEndTime;
        }
      });
    });
  </script>
</head>
<body>
  <div class="navbar">
    <h1>University of Bahrain</h1>
    <div class="hamburger">
      <div></div>
      <div></div>
      <div></div>
    </div>
    <div class="menu" id="menu">
      <a href="../mahmood-user-profile-editing/user_profile_editing.php">User Profile Editing</a>
      <a href="../User_Registration-Ammar/welcomepage.php">Log-out</a>
    </div>
  </div>

  <h1>Room booking system</h1>
  <form action="room_browsing.php" class="mainform" method="GET">
    <label for="room_type">Room Type:</label>
    <select name="room_type" id="room_type" required>
      <option value="Meeting Room">Meeting Room</option>
      <option value="Lecture Room">Lecture Room</option>
      <option value="Computer Lab">Computer Lab</option>
    </select>
    <label for="start_date">Start Date:</label>
    <input type="datetime-local" id="start_date" name="start_date" required>
    <label for="end_date">End Date:</label>
    <input type="datetime-local" id="end_date" name="end_date" required>
    <button type="submit">Browse Rooms</button>
  </form>

  <h2>Your Bookings</h2>
  <div class="bookings-container">
    <table class="bookings-table">
      <thead>
        <tr>
          <th>Booking Id</th>
          <th>Room</th>
          <th>Start Time</th>
          <th>End Time</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php
                    session_start();
                    require_once 'db.php';

                    if (!isset($_SESSION['user'])) {
                        header("Location: ../User_Registration-Ammar/login.php"); 
                        exit();
                    }
                    $user_id = $_SESSION['user']['id'];
                    $stmt = $pdo->prepare("
                        SELECT bookings.booking_id, bookings.room_id, rooms.room_name, bookings.start_time, bookings.end_time 
                        FROM bookings
                        JOIN rooms ON bookings.room_id = rooms.room_id
                        WHERE bookings.user_id = ?
                    ");
                    $stmt->execute([$user_id]);

                    while ($booking = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "
                        <tr>
                            <td>{$booking['booking_id']}</td>
                            <td>{$booking['room_name']}</td>
                            <td>{$booking['start_time']}</td>
                            <td>{$booking['end_time']}</td>
                            <td>
                                <form action='../room-booking-system - Mohamed Almaraghi/cancel.php' method='POST'>
                                    <input type='hidden' name='booking_id' value='{$booking['booking_id']}'>
<<<<<<< HEAD
                                     <input type='hidden' name='room_id' value='{$booking['room_id']}'>
=======
                                    <input type='hidden' name='room_id' value='{$booking['room_id']}'>
>>>>>>> 36b8c7f6116c8d422d0f8026cdfdadbb3b1b33ea
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
