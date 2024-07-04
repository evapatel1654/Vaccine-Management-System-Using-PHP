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

function sanitize($conn, $input) {
    return mysqli_real_escape_string($conn, $input);
}

// Delete User
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['user_id'])) {
    $user_id = sanitize($conn, $_GET['user_id']);

    $sql_delete = "DELETE FROM vaccinations WHERE user_id = '$user_id'";
    if ($conn->query($sql_delete) === TRUE) {
        echo "<script>alert('Record deleted successfully');</script>";
    } else {
        echo "<script>alert('Error deleting record: " . $conn->error . "');</script>";
    }
}

// Add New User
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = sanitize($conn, $_POST['firstname']);
    $lastname = sanitize($conn, $_POST['lastname']);
    $phnumber = sanitize($conn, $_POST['phnumber']);
    $email = sanitize($conn, $_POST['email']);

    $sql_insert = "INSERT INTO vaccinations (firstname, lastname, phnumber, email) 
                   VALUES ('$firstname', '$lastname', '$phnumber', '$email')";

    if ($conn->query($sql_insert) === TRUE) {
        echo "<script>alert('New user added successfully');</script>";
    } else {
        echo "<script>alert('Error adding new user: " . $conn->error . "');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<h1>User Management</h1>

<?php
if (isset($_SESSION['user_id'])) {
    // List Users
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
                        <a href='?action=delete&user_id=".$row["user_id"]."' onclick='return confirmDelete();'>Delete</a>
                    </td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "0 results";
    }

    // Add New User Form with AJAX
    echo "<h2>Add New User</h2>";    
    echo "<a href=\"add_user.html\"><button type='submit'>Click here</button></a>";
    echo "</form>";
} else {
    echo "User not logged in.";
}
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('addUserForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form submission

        var form = this;
        var formData = new FormData(form);

        fetch('add_user.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            form.reset(); 
            updateUserList(); 
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error adding user. Please try again.');
        });
    });

    function updateUserList() {
        fetch('fetch_users.php') 
        .then(response => response.text())
        .then(data => {
            document.getElementById('userTable').innerHTML = data; // Update user table
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error updating user list.');
        });
    }

    function confirmDelete() {
        return confirm("Are you sure you want to delete this user?");
    }
});
</script>

</body>
</html>

<?php
$conn->close();
?>
