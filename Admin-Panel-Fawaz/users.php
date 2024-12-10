<?php
 // Current page
 $currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Users Page</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="wrapper">
        <!-- Navigation Bar -->
        <nav>
            <a href="index.php" class="<?= $currentPage == 'index.php' ? 'active' : ''; ?>">Dashboard</a>
            <a href="room_management.php" class="<?= $currentPage == 'room_management.php' ? 'active' : ''; ?>">Room Management</a>
            <a href="users.php" class="<?= $currentPage == 'users.php' ? 'active' : ''; ?>">Users</a>
        </nav>
        <br>
        <div class="content-wrapper">
            <!-- Content Header -->
            <section class="content-header">
                <div class="container-fluid">
                    <h1>Users Page</h1>
                </div>
            </section>

            <!-- Users Page Unavailable Message -->
             <!-- Room List Table -->
             <section class="content table-section">
                <div class="container-fluid">
                    <table class="room-list">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Account Type</th>
                                <th>Account Type</th>
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
                            $sql = "SELECT * FROM users";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['username'] . "</td>";
                                    echo "<td>" . $row['email'] . "</td>";
                                    echo "<td>" . $row['phone_number'] . "</td>";
                                    echo "<td>" . $row['account_type'] . "</td>";
                                    echo "<td>
                                    </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='9'>No Users Available</td></tr>";
                            }
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

    <script>

    </script>
</body>

</html>
