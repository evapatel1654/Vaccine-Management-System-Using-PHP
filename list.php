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

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = sanitize($conn, $_GET['id']);

    $sql_delete = "DELETE FROM vaccinations WHERE id = $id";
    if ($conn->query($sql_delete) === TRUE) {
        echo "<script>alert('Record deleted successfully');</script>";
    } else {
        echo "<script>alert('Error deleting record: " . $conn->error . "');</script>";
    }
}

if (isset($_POST['delete_multiple'])) {
    if (!empty($_POST['checkbox'])) {
        $checkbox = $_POST['checkbox'];
        $ids = implode(",", array_map('intval', $checkbox));

        $sql_delete_multiple = "DELETE FROM vaccinations WHERE id IN ($ids)";
        if ($conn->query($sql_delete_multiple) === TRUE) {
            echo "<script>alert('Selected records deleted successfully');</script>";
        } else {
            echo "<script>alert('Error deleting selected records: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Please select at least one record to delete');</script>";
    }
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    // echo "<p>Debug: User ID is $user_id</p>"; // Debugging line

    $sql_select = "SELECT * FROM vaccinations WHERE user_id = $user_id";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        echo "<h1>Your Registration List: </h1>";
        echo "<form method='post' action=''>";
        echo "<table border='1'>
                <tr>
                    <th>Select</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>National Security Number</th>
                    <th>Date of Birth</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Gender</th>
                    <th>Address 1</th>
                    <th>Address 2</th>
                    <th>City</th>
                    <th>State/Province</th>
                    <th>Country</th>
                    <th>Insurance Company</th>
                    <th>Insurance ID</th>
                    <th>Diseases Diagnosed</th>
                    <th>Action</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td><input type='checkbox' name='checkbox[]' value='".$row["id"]."'></td>
                    <td>".$row["firstname"]."</td>
                    <td>".$row["lastname"]."</td>
                    <td>".$row["securityno"]."</td>
                    <td>".$row["dob"]."</td>
                    <td>".$row["email"]."</td>
                    <td>".$row["phnumber"]."</td>
                    <td>".$row["gender"]."</td>
                    <td>".$row["address1"]."</td>
                    <td>".$row["address2"]."</td>
                    <td>".$row["city"]."</td>
                    <td>".$row["state"]."</td>
                    <td>".$row["country"]."</td>
                    <td>".$row["insuranceco"]."</td>
                    <td>".$row["insuranceid"]."</td>
                    <td>".$row["diseases"]."</td>
                    <td>
                        <a href='edit.php?id=".$row["id"]."'>Edit</a>
                    </td>
                </tr>";
        }

        echo "<tr><td colspan='17'><input type='submit' name='delete_multiple' value='Delete Selected' onclick='return confirmDelete();'></td></tr>";
        echo "</table>";
        echo "</form>";
    } else {
        echo "0 results";
    }
} else {
    echo "User not logged in.";
}

$conn->close();
?>

<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this record?");
}
</script>
