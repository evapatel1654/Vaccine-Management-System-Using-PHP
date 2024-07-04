<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "userdb";

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username']; 
    $email = $_POST['email'];
    $pwd = $_POST['password'];
    $confirmPwd = $_POST['confirmPassword'];

    if ($pwd !== $confirmPwd) {
        echo json_encode(['status' => 'error', 'message' => 'Passwords do not match!']);
        exit;
    }

    $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (email, username, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $email, $username, $hashed_password);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Registration successful!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

$conn->close();
