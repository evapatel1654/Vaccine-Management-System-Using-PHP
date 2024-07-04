<?php
session_start();


$host = 'localhost';
$dbname = 'userdb';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$userID = $_SESSION['UserID']; 
$stmt = $pdo->prepare("SELECT * FROM user WHERE id = :userID");
$stmt->bindParam(':userID', $userID);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <style>

    </style>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($user['username']); ?></h1>
    <p>Username: <?php echo htmlspecialchars($user['username']); ?></p>
    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
    <a href="logout.php">Logout</a>
</body>
</html>
