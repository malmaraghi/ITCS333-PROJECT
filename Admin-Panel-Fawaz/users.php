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
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                            <div class="alert alert-warning" role="alert">
                                <h4 class="alert-heading">Page Currently Unavailable</h4>
                                <p>We're sorry, but the Users page is currently unavailable. Please check back later.</p>
                                <hr>
                            </div>
                    </div>
                </div>
            </section>

        </div>
    </div>

    <script>

    </script>
</body>

</html>
