<?php
session_start();
require_once 'connection.php'; // Database connection

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
    exit();
}

$user_id = $_SESSION['user']['id']; // Current logged-in user's ID

// Handle image upload request
if (isset($_GET['action']) && $_GET['action'] === 'uploadImage') {
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $imageName = $_FILES['photo']['name'];
        $imageSize = $_FILES['photo']['size'];
        $tempName = $_FILES['photo']['tmp_name'];
        $uploadDir = __DIR__ . '/uploads/';

        $validExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $extension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        if (!in_array($extension, $validExtensions)) {
            echo json_encode(['success' => false, 'message' => 'Invalid file type.']);
            exit;
        }

        if ($imageSize > 5242880) { // 5MB
            echo json_encode(['success' => false, 'message' => 'File size exceeds 5MB.']);
            exit;
        }

        $newFileName = uniqid('IMG-', true) . '.' . $extension;

        // Ensure directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if (move_uploaded_file($tempName, $uploadDir . $newFileName)) {
            $filePath = 'uploads/' . $newFileName;
            echo json_encode(['success' => true, 'filePath' => $filePath]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to upload file.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No file uploaded.']);
    }
    exit;
}

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $Contact = trim($_POST['Contact']);
    $phone = trim($_POST['phone']);
    $comments = trim($_POST['comments']);
    $photo = trim($_POST['photo']);

    // Validate inputs
    $errors = [];
    if (empty($username)) $errors[] = "Username is required.";
    if (!filter_var($Contact, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email.";
    if (!preg_match('/^\d{8,10}$/', $phone)) $errors[] = "Phone must be 8-10 digits.";

    if (empty($errors)) {
        try {
            // Prepare the SQL query for updating the profile
            $stmt = $pdo->prepare("
                UPDATE users 
                SET username = :username, 
                    Contact = :Contact, 
                    phone_number = :phone, 
                    comments = :comments, 
                    picture = :photo 
                WHERE id = :id
            ");
            $stmt->execute([
                ':username' => $username,
                ':Contact' => $Contact,
                ':phone' => $phone,
                ':comments' => $comments,
                ':photo' => $photo,  // Save the image path
                ':id' => $user_id,
            ]);

            // Check if the update was successful
            if ($stmt->rowCount() > 0) {
                echo "Updated successfully";
                header("Location: ../user_dashboard.php");

            } else {
                echo "Something went wrong";
                header("Location: ../user_dashboard.php");
            }
            
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    } else {
        echo "Errors:<br>" . implode("<br>", $errors);
    }
}
