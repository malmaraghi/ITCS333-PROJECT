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
    $fieldsToUpdate = [];
    $params = [':id' => $user_id]; // Prepare params with user id

    // Add fields conditionally
    if (isset($_POST['username']) && $_POST['username'] !== '') {
        $fieldsToUpdate[] = "username = :username";
        $params[':username'] = $_POST['username'];
    }

    if (isset($_POST['Major']) && $_POST['Major'] !== '') {
        $fieldsToUpdate[] = "Major = :Major";
        $params[':Major'] = $_POST['Major'];
    }

    // Validate phone number (only digits)
    if (isset($_POST['phone']) && $_POST['phone'] !== '') {
        $phone = $_POST['phone'];
        
        // Check if phone contains only digits
        if (ctype_digit($phone)) {
            $fieldsToUpdate[] = "phone_number = :phone_number";
            $params[':phone_number'] = $phone;
        } else {
            echo "Error: Phone number must contain only digits.";
            exit;
        }
    }

    if (isset($_POST['comments']) && $_POST['comments'] !== '') {
        $fieldsToUpdate[] = "comments = :comments";
        $params[':comments'] = $_POST['comments'];
    }

    if (isset($_POST['photo']) && $_POST['photo'] !== '') {
        $fieldsToUpdate[] = "photo = :photo";
        $params[':photo'] = $_POST['photo'];
    }

    if (!empty($fieldsToUpdate)) {
        $sql = "UPDATE users SET " . implode(", ", $fieldsToUpdate) . " WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        
        try {
            $stmt->execute($params);
            echo "Profile updated successfully.";
        } catch (PDOException $e) {
            echo "Error updating profile: " . $e->getMessage();
        }
    }
}
?>
