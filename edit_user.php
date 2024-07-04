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

if (isset($_GET['user_id'])) {
    $user_id = sanitize($conn, $_GET['user_id']);

    $sql_select = "SELECT * FROM vaccinations WHERE user_id = $user_id";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Display edit form
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Edit User Registration</title>
            <style>
                label {
                    display: block;
                    margin-bottom: 10px;
                }
                input[type=text], input[type=email], input[type=tel] {
                    width: 100%;
                    padding: 8px;
                    margin-top: 4px;
                    margin-bottom: 10px;
                    box-sizing: border-box;
                }
                input[type=submit] {
                    background-color: #4CAF50;
                    color: white;
                    padding: 10px 15px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                }
            </style>
        </head>
        <body>
            <h2>Edit User Registration</h2>
            <form method="post" action="update.php">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <label for="firstname">First Name:</label>
                <input type="text" id="firstname" name="firstname" value="<?php echo $row['firstname']; ?>" required>

                <label for="lastname">Last Name:</label>
                <input type="text" id="lastname" name="lastname" value="<?php echo $row['lastname']; ?>">

                <label for="securityno">National Security Number:</label>
                <input type="text" id="securityno" name="securityno" value="<?php echo $row['securityno']; ?>" required>

                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" value="<?php echo $row['dob']; ?>" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>

                <label for="phnumber">Phone Number:</label>
                <input type="tel" id="phnumber" name="phnumber" value="<?php echo $row['phnumber']; ?>" required>

                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="Male" <?php if ($row['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if ($row['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                    <option value="Other" <?php if ($row['gender'] == 'Other') echo 'selected'; ?>>Other</option>
                </select>

                <label for="address1">Address 1:</label>
                <input type="text" id="address1" name="address1" value="<?php echo $row['address1']; ?>" required>

                <label for="address2">Address 2:</label>
                <input type="text" id="address2" name="address2" value="<?php echo $row['address2']; ?>">

                <label for="city">City:</label>
                <input type="text" id="city" name="city" value="<?php echo $row['city']; ?>" required>

                <label for="state">State/Province:</label>
                <input type="text" id="state" name="state" value="<?php echo $row['state']; ?>" required>

                <label for="country">Country:</label>
                <input type="text" id="country" name="country" value="<?php echo $row['country']; ?>" required>

                <label for="insuranceco">Insurance Company:</label>
                <input type="text" id="insuranceco" name="insuranceco" value="<?php echo $row['insuranceco']; ?>" required>

                <label for="insuranceid">Insurance ID:</label>
                <input type="text" id="insuranceid" name="insuranceid" value="<?php echo $row['insuranceid']; ?>" required>

                <label for="diseases">Diseases Diagnosed:</label>
                <textarea id="diseases" name="diseases" rows="4" required><?php echo $row['diseases']; ?></textarea>

                <input type="submit" value="Update Registration">
            </form>
        </body>
        </html>
        <?php
    } else {
        echo "User not found.";
    }
} else {
    echo "ID parameter missing.";
}

$conn->close();
?>
