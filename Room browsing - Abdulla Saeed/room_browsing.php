<?php
include('db.php');
session_start();  // Start session to use session data

$rooms = $pdo->query("SELECT * FROM rooms")->fetchAll(PDO::FETCH_ASSOC);
$startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$endDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';

// Get the room type from the GET request
$roomType = isset($_GET['room_type']) ? $_GET['room_type'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Browsing</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="style1.css">
    <script>
 document.addEventListener('DOMContentLoaded', function () {
    const rooms = <?php echo json_encode($rooms); ?>; // Rooms data from PHP
    const gridContainer = document.querySelector('.grid-container');
    const modal = document.getElementById('myModal');
    const modalContent = document.querySelector('.modal-content');
    const span = document.querySelector('.close');
    const filterButtons = document.querySelectorAll('.filter-option');

    // Default filter selection (set as active when page loads)
    const defaultFloor = ''; // Default floor (can be modified as needed)
    const defaultDepartment = ''; // Default department (can be modified as needed)

    // Set default active filters
    const defaultFloorButton = document.querySelector(`.filter-option[data-type="floor"][data-value="${defaultFloor}"]`);
    const defaultDepartmentButton = document.querySelector(`.filter-option[data-type="department"][data-value="${defaultDepartment}"]`);

    if (defaultFloorButton) defaultFloorButton.classList.add('active');
    if (defaultDepartmentButton) defaultDepartmentButton.classList.add('active');

    // Function to display rooms in the grid
    function displayRooms(roomsToDisplay) {
        gridContainer.innerHTML = ''; // Clear existing content

        roomsToDisplay.forEach(room => {
            const roomCard = document.createElement('div');
            roomCard.className = `room-card status-${room.status.toLowerCase()}`;
            roomCard.innerHTML = `
                <h2>${room.room_name}</h2>
                <p><strong>Department:</strong> ${room.room_department}</p>
                <p><strong>Floor:</strong> ${room.room_floor}</p>
                <p class="room-status"><strong>Status:</strong> ${room.status}</p>
            `;
            roomCard.addEventListener('click', () => showRoomDetails(room)); // Attach click handler
            gridContainer.appendChild(roomCard);
        });
    }

    // Function to show room details in the modal
    function showRoomDetails(room) {
        modalContent.innerHTML = `
            <span class="close">&times;</span>
            <h2>${room.room_name}</h2>
            <p><strong>Department:</strong> ${room.room_department}</p>
            <p><strong>Room Type:</strong> ${room.room_type}</p>
            <p><strong>Floor:</strong> ${room.room_floor}</p>
            <p><strong>Status:</strong> ${room.status}</p>
            <form action="../room-booking-system - Mohamed Almaraghi/book.php" method="POST">
                <input type="hidden" name="room_id" value="${room.room_id}">
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id']; ?>">
                <input type="hidden" name="start_date" value="<?php echo $startDate; ?>">
                <input type="hidden" name="end_date" value="<?php echo $endDate; ?>">
                <button type="submit">Book Now</button>
            </form>
        `;
        modal.style.display = 'block'; // Show the modal
    }

    // Close modal when the close button is clicked
    span.onclick = function () {
        modal.style.display = 'none';
    };

    // Close modal when clicking outside the modal content
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    };

    // Filter logic
    function filterRooms() {
        const selectedDepartment = document.querySelector('.filter-option[data-type="department"].active')?.dataset.value || '';
        const selectedFloor = document.querySelector('.filter-option[data-type="floor"].active')?.dataset.value || '';

        const filteredRooms = rooms.filter(room => 
            (selectedDepartment === '' || room.room_department === selectedDepartment) &&
            (selectedFloor === '' || room.room_floor == selectedFloor)
        );

        displayRooms(filteredRooms);
    }

    // Add click event listeners to filter buttons
    filterButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Toggle active class for the current button
            const type = this.dataset.type;
            const buttonsOfSameType = document.querySelectorAll(`.filter-option[data-type="${type}"]`);
            buttonsOfSameType.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            filterRooms();
        });
    });

    // Initial display of rooms
    displayRooms(rooms); // Display all rooms by default
});


    </script>
</head>
<body>
<div class="filter-box">
    <h3>Filter Rooms</h3>
    
    <label>Floor:</label>
    <div class="filter-group">
        <button class="filter-option" data-type="floor" data-value="">All Floors</button>
        <button class="filter-option" data-type="floor" data-value="1">1st Floor</button>
        <button class="filter-option" data-type="floor" data-value="2">2nd Floor</button>
        <button class="filter-option" data-type="floor" data-value="3">3rd Floor</button>
    </div>
    <br><br>
    
    <label>Department:</label>
    <div class="filter-group">
        <button class="filter-option" data-type="department" data-value="">All Departments</button>
        <button class="filter-option" data-type="department" data-value="ITCS">ITCS</button>
        <button class="filter-option" data-type="department" data-value="ITCE">ITCE</button>
        <button class="filter-option" data-type="department" data-value="ITIS">ITIS</button>
    </div>
</div>


    
    <div class="content">
        <h1 class="header">Room Browsing</h1>
        <div class="grid-container">
            <!-- Room cards will be dynamically inserted here -->
        </div>
    </div>

    <!-- Modal Structure -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <!-- Room details will be dynamically inserted here -->
        </div>
    </div>
</body>
</html>
