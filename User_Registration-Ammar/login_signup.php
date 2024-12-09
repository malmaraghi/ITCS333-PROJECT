<?php
session_start();
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle Login
    if (isset($_POST['login'])) {
        $email = htmlspecialchars(trim($_POST['email']));
        $password = htmlspecialchars(trim($_POST['password']));

        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'account_type' => $user['account_type']
            ];

            // Check if session data is set properly
            if (isset($_SESSION['user'])) {
                echo "Login successful. Welcome, " . $_SESSION['user']['username'];
                if ($user['account_type'] === 'Admin') {
                    header("Location: ../Admin-Panel-Fawaz/index.php");
                    exit();
                } else if ($user['account_type'] === 'User') {
                    header("Location: ../Room browsing - Abdulla Saeed/index.php");
                    exit();
                }
            } else {
                echo "Failed to set session.";
            }
        } else {
            echo "Invalid email or password.";
        }
    }

    // Handle Sign-Up
    if (isset($_POST['signup'])) {
        $username = htmlspecialchars(trim($_POST['username']));
        $email = htmlspecialchars(trim($_POST['email']));
        $password = htmlspecialchars(trim($_POST['password']));
        $accountType = htmlspecialchars(trim($_POST['account_type']));

        $userEmailPattern = '/^[0-9]{9}@stu\.uob\.edu\.bh$/';
        // $adminEmailPattern = '/^[0-9]{9}@uob\.edu\.bh$/';

        if ($accountType === 'user' && !preg_match($userEmailPattern, $email)) {
            echo "User email must follow the format: 202206169@stu.uob.edu.bh";
        } 
        // elseif ($accountType === 'admin' && !preg_match($adminEmailPattern, $email)) {
        //     echo "Admin email must follow the format: 202206169@uob.edu.bh";
        // } 
        else {
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':email' => $email]);

            if ($stmt->rowCount() > 0) {
                header("Location: ERROR.php");

            } else {
                $sql = "INSERT INTO users (username, email, password, account_type) VALUES (:username, :email, :password, :account_type)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':username' => $username,
                    ':email' => $email,
                    ':password' => password_hash($password, PASSWORD_DEFAULT),
                    ':account_type' => $accountType
                ]);

                $_SESSION['user'] = [
                    'id' => $pdo->lastInsertId(),
                    'username' => $username,
                    'email' => $email,
                    'account_type' => $accountType
                ];

                header("Location: ../Room browsing - Abdulla Saeed/index.php");
            }
        }
    }
}
?>
