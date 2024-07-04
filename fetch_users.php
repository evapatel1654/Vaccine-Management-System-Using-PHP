<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// function sanitize($conn, $input) {
//     return mysqli_real_escape_string($conn, $input);
// }

// Fetch updated user list
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $sql_select = "SELECT user_id, firstname, lastname, phnumber, email FROM vaccinations WHERE user_id = '$user_id'";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        echo "<table id='userTable'>
                <tr>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            $name = $row["firstname"];
            if (!empty($row["lastname"])) {
                $name .= " " . $row["lastname"];
            }
            echo "<tr>
                    <td>".$name."</td>
                    <td>".$row["phnumber"]."</td>
                    <td>".$row["email"]."</td>
                    <td>
                        <a href='edit_user.php?id=".$row["user_id"]."'>Edit</a> |
                        <a href='list_users.php?action=delete&user_id=".$row["user_id"]."' onclick='return confirmDelete();'>Delete</a>
                    </td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "<p>0 results</p>";
    }
} else {
    echo "<p>User not logged in.</p>";
}

$conn->close();
?>
