<?php
session_start();

$inactive = 900;

if (isset($_SESSION['timeout'])) {
    $session_life = time() - $_SESSION['timeout'];
    if ($session_life > $inactive) {
        session_unset();
        session_destroy();
        echo json_encode(['status' => 'logout']);
        exit();
    }
}
$_SESSION['timeout'] = time();

$dsn = 'mysql:host=localhost;dbname=userdb';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email'], $_POST['password'])) {
        $email = $_POST['email'];
        $pwd = $_POST['password'];
        $rememberMe = isset($_POST['remember']) ? true : false;

        $sql = "SELECT id, username, email, password, failed_attempts, last_failed_attempt, remember_me_token FROM user WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $current_time = new DateTime();

            if ($row['last_failed_attempt']) {
                $last_failed_time = new DateTime($row['last_failed_attempt']);
                $time_diff = $current_time->getTimestamp() - $last_failed_time->getTimestamp();
            } else {
                $time_diff = 600; 
            }

            if ($time_diff > 600) {
                $row['failed_attempts'] = 0;
            }

            if ($row['failed_attempts'] >= 3) {
                echo json_encode(['status' => 'error', 'message' => 'Account locked due to too many failed login attempts. Please try again later.']);
            } else {
                if (password_verify($pwd, $row['password'])) {
                    $_SESSION['user_id'] = $row['id']; // Set user ID in session
                    $_SESSION['username'] = $row['username'];

                    $reset_sql = "UPDATE user SET failed_attempts = 0, last_failed_attempt = NULL WHERE id = :id";
                    $reset_stmt = $pdo->prepare($reset_sql);
                    $reset_stmt->bindParam(':id', $row['id']);
                    $reset_stmt->execute();

                    if ($rememberMe) {
                        $token = bin2hex(random_bytes(32)); 
                        $expiry = time() + (30 * 24 * 60 * 60); 
                        setcookie('remember_me', $row['email'] . ':' . $token, $expiry, '/');
                        $update_token_sql = "UPDATE user SET remember_me_token = :token WHERE id = :id";
                        $update_token_stmt = $pdo->prepare($update_token_sql);
                        $update_token_stmt->bindParam(':token', $token);
                        $update_token_stmt->bindParam(':id', $row['id']);
                        $update_token_stmt->execute();
                    }

                    echo json_encode(['status' => 'success', 'message' => 'Login successful!', 'username' => $row['username']]);
                } else {
                    $failed_attempts = $row['failed_attempts'] + 1;
                    $update_sql = "UPDATE user SET failed_attempts = :failed_attempts, last_failed_attempt = NOW() WHERE id = :id";
                    $update_stmt = $pdo->prepare($update_sql);
                    $update_stmt->bindParam(':failed_attempts', $failed_attempts);
                    $update_stmt->bindParam(':id', $row['id']);
                    $update_stmt->execute();

                    echo json_encode(['status' => 'error', 'message' => 'Invalid password.']);
                }
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No user found with that email.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Email and Password are required.']);
    }
}
