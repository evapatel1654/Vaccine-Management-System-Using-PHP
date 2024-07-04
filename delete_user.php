
<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$user_id = $_GET['id'];

$sql = "DELETE FROM user WHERE id='$user_id'";
if (mysqli_query($conn, $sql)) {
    echo "User deleted successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>
