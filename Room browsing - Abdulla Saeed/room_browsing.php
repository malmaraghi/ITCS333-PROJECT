<?php
include('db.php');

// Fetch all rooms initially
$rooms = $pdo->query("SELECT * FROM rooms")->fetchAll(PDO::FETCH_ASSOC);

// Get the room type from the GET request
$roomType = isset($_GET['room_type']) ? $_GET['room_type'] : '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Browsing</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            display: flex;
            justify-content: space-between;
            font-family: Arial, sans-serif;
        }

        .filter-box {
            width: 250px;
            padding: 20px;
            background-color: #f4f4f4;
            border: 1px solid #ccc;
            position: fixed;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
        }

        .content {
            flex-grow: 1;
            margin-right: 270px; /* Adjust to ensure space for filter box */
            padding: 20px;
        }

        .header {
            margin-bottom: 20px;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .room-card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            cursor: pointer;
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

        .filter-box select {
            width: 100%;
            margin-bottom: 10px;
            padding: 5px;
        }

        .modal {
            display: none; 
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const rooms = <?php echo json_encode($rooms); ?>;
            const roomType = '<?php echo $roomType; ?>';
            const gridContainer = document.querySelector('.grid-container');
            const departmentFilter = document.getElementById('department');
            const floorFilter = document.getElementById('floor');
            const modal = document.getElementById('myModal');
            const modalContent = document.querySelector('.modal-content');
            const span = document.querySelector('.close');
            
            function filterRooms() {
                const selectedDepartment = departmentFilter.value;
                const selectedFloor = floorFilter.value;
                
                const filteredRooms = rooms.filter(room => 
                    (roomType === '' || room.room_type === roomType) &&
                    (selectedDepartment === '' || room.room_department === selectedDepartment) &&
                    (selectedFloor === '' || room.room_floor == selectedFloor)
                );
                
                displayRooms(filteredRooms);
            }
            
            function displayRooms(filteredRooms) {
                gridContainer.innerHTML = '';
                
                filteredRooms.forEach(room => {
                    const roomCard = document.createElement('div');
                    roomCard.className = `room-card status-${room.status.toLowerCase()}`;
                    roomCard.innerHTML = `
                        <h2>${room.room_name}</h2>
                        <p><strong>Department:</strong> ${room.room_department}</p>
                        <p class="room_type"><strong>Room type:</strong> ${room.room_type}</p>
                        <p><strong>Floor:</strong> ${room.room_floor}</p>
                        <p class="room-status"><strong>Status:</strong> ${room.status}</p>
                    `;
                    roomCard.addEventListener('click', () => showRoomDetails(room));
                    gridContainer.appendChild(roomCard);
                });
            }

            function showRoomDetails(room) {
                modalContent.innerHTML = `
                    <span class="close">&times;</span>
                    <h2>${room.room_name}</h2>
                    <p><strong>Department:</strong> ${room.room_department}</p>
                    <p><strong>Room Type:</strong> ${room.room_type}</p>
                    <p><strong>Floor:</strong> ${room.room_floor}</p>
                    <p><strong>Status:</strong> ${room.status}</p>
                    <button onclick="window.location.href='../room-booking-system - Mohamed Almaraghi/public/book.php?room_id=${room.room_id}'">Book Now</button>
                `;
                modal.style.display = "block";
            }

            span.onclick = function() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
            
            departmentFilter.addEventListener('change', filterRooms);
            floorFilter.addEventListener('change', filterRooms);

            // Set default filter values and display rooms
            departmentFilter.value = 'ITCS';
            floorFilter.value = '1';
            filterRooms();
        });
    </script>
</head>
<body>
    <div class="filter-box">
        <h3>Filter Rooms</h3>
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
            <option value="ITCS">ITCS</option>
            <option value="ITCE">ITCE</option>
            <option value="ITIS">ITIS</option>
        </select>
        <br><br>
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
