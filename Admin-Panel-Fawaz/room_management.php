<?php
 // Current page
 $currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Room Management</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        // Function to open the modal
        function openModal(type, roomId = '') {
            document.getElementById('roomModal').style.display = 'block';
            document.getElementById('formType').value = type;
            document.getElementById('roomId').value = roomId;

            // If editing, populate the fields with the current room data
            if (type === 'edit' && roomId) {
                fetch(`get_room_details.php?id=${roomId}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);  // Log to check the response data
                        if (data.error) {
                            alert(data.error);  // Show error if no data is returned
                        } else {
                            document.getElementById('room_name').value = data.room_name;
                            document.getElementById('capacity').value = data.capacity;
                            document.getElementById('equipment').value = data.equipment;
                            document.getElementById('room_department').value = data.room_department;
                            document.getElementById('room_floor').value = data.room_floor;
                            document.getElementById('status').value = data.status;
                            document.getElementById('room_type').value = data.room_type;
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching room details:', error);
                        alert('Error fetching room details.');
                    });
            } else {
                // Clear the fields if it's for adding a new room
                document.getElementById('room_name').value = '';
                document.getElementById('capacity').value = '';
                document.getElementById('equipment').value = '';
                document.getElementById('room_department').value = '';
                document.getElementById('room_floor').value = '';
                document.getElementById('status').value = '';
                document.getElementById('room_type').value = '';
            }
        }

        // Function to close the modal
        function closeModal() {
            document.getElementById('roomModal').style.display = 'none';
        }

        // Form validation before submit
        function validateForm() {
            const capacity = document.getElementById('capacity').value;
            const department = document.getElementById('room_department').value;
            const floor = document.getElementById('room_floor').value;
            const status = document.getElementById('status').value;

            // Validate Capacity (must be non-negative)
            if (capacity < 0) {
                alert('Capacity cannot be negative.');
                return false;
            }

            // Validate department (ITIS, ITCS, ITCE are valid)
            const validDepartments = ['ITIS', 'ITCS', 'ITCE'];
            if (!validDepartments.includes(department)) {
                alert('Please select a valid department (ITIS, ITCS, or ITCE).');
                return false;
            }

            // Validate floor (1, 2, or 3 are valid)
            const validFloors = ['1', '2', '3'];
            if (!validFloors.includes(floor)) {
                alert('Please select a valid floor (1, 2, or 3).');
                return false;
            }

            // Validate status (Available, Occupied, Unavailable, or Other are valid)
            const validStatuses = ['Available', 'Occupied', 'Unavailable', 'Other'];
            if (!validStatuses.includes(status)) {
                alert('Please select a valid status (Available, Occupied, Unavailable, or Other).');
                return false;
            }

            // If all validation passes, submit the form
            return true;
        }
    </script>
    
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
        <br>
        <div class="content-wrapper">
            <!-- Content Header -->
            <section class="content-header">
                <div class="container-fluid">
                    <h1>Room Management</h1>
                </div>
            </section>

            <!-- Buttons to Add, Edit Rooms -->
            <section class="content2">
                <div class="container-fluid2">
                    <button class="btn btn-add" onclick="openModal('add')">Add Room</button>
                    <button class="btn btn-edit" onclick="openModal('edit')">Edit Room</button>
                </div>
            </section>

            <!-- Room List Table -->
            <section class="content table-section">
                <div class="container-fluid">
                    <table class="room-list">
                        <thead>
                            <tr>
                                <th>Room ID</th>
                                <th>Room Name</th>
                                <th>Capacity</th>
                                <th>Equipment</th>
                                <th>Department</th>
                                <th>Floor</th>
                                <th>Status</th>
                                <th>Room Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Connection to the database
                            $conn = new mysqli('localhost', 'root', '', 'room_booking');
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Fetch rooms data
                            $sql = "SELECT * FROM rooms";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['room_id'] . "</td>";
                                    echo "<td>" . $row['room_name'] . "</td>";
                                    echo "<td>" . $row['capacity'] . "</td>";
                                    echo "<td>" . $row['equipment'] . "</td>";
                                    echo "<td>" . $row['room_department'] . "</td>";
                                    echo "<td>" . $row['room_floor'] . "</td>";
                                    echo "<td>" . $row['status'] . "</td>";
                                    echo "<td>" . $row['room_type'] . "</td>";
                                    echo "<td>
                                    <button class='btn btn-edit' onclick=\"openModal('edit', " . $row['room_id'] . ")\">Edit</button>
                                    <button class='btn btn-delete' onclick=\"window.location.href='delete_room.php?id=" . $row['room_id'] . "'\">Delete</button>
                                    </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='9'>No rooms available</td></tr>";
                            }
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

    <!-- Modal for Add/Edit Room -->
    <div id="roomModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modalTitle">Add/Edit Room</h2>
            <form id="roomForm" method="POST" action="save_room.php" onsubmit="return validateForm()">
                <input type="hidden" id="formType" name="formType">
                <input type="hidden" id="roomId" name="room_id">
                Room Name: <input type="text" name="room_name" id="room_name" required><br>
                Capacity: <input type="number" name="capacity" id="capacity" min="0" required><br>
                Equipment: <input type="text" name="equipment" id="equipment" required><br>
                Department: 
                <select name="room_department" id="room_department" required>
                    <option value="ITIS">ITIS</option>
                    <option value="ITCS">ITCS</option>
                    <option value="ITCE">ITCE</option>
                </select><br>
                Floor: 
                <select name="room_floor" id="room_floor" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select><br>
                Status: 
                <select name="status" id="status" required>
                    <option value="Available">Available</option>
                    <option value="Occupied">Occupied</option>
                    <option value="Unavailable">Unavailable</option>
                </select><br>
                Room Type: <input type="text" name="room_type" id="room_type" required><br>
                <input type="submit" value="Submit">
            </form>
        </div>
    </div>
</body>

</html>
