<?php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $firstname = sanitize($conn, $_POST['firstname']);
    $lastname = sanitize($conn, $_POST['lastname']);
    $securityno = sanitize($conn, $_POST['securityno']);
    $dob = sanitize($conn, $_POST['dob']);
    $email = sanitize($conn, $_POST['email']);
    $phnumber = sanitize($conn, $_POST['phnumber']);
    $gender = sanitize($conn, $_POST['gender']);
    $address1 = sanitize($conn, $_POST['address1']);
    $address2 = sanitize($conn, $_POST['address2']);
    $city = sanitize($conn, $_POST['city']);
    $state = sanitize($conn, $_POST['state']);
    $country = sanitize($conn, $_POST['country']);
    $insuranceco = sanitize($conn, $_POST['insuranceco']);
    $insuranceid = sanitize($conn, $_POST['insuranceid']);
    $diseases = sanitize($conn, $_POST['diseases']);
    $declaration = sanitize($conn, $_POST['declaration']);


    // Update query
    $sql_update = "UPDATE vaccinations SET 
                    firstname = '$firstname',
                    lastname = '$lastname',
                    securityno = '$securityno',
                    dob = '$dob',
                    email = '$email',
                    phnumber = '$phnumber',
                    gender = '$gender',
                    address1 = '$address1',
                    address2 = '$address2',
                    city = '$city',
                    state = '$state',
                    country = '$country',
                    insuranceco = '$insuranceco',
                    insuranceid = '$insuranceid',
                    diseases = '$diseases',
                    declaration = '$declaration'
                    WHERE id = $id";

    if ($conn->query($sql_update) === TRUE) {
        echo "<script>alert('Record updated successfully');</script>";
        // Redirect to the list page or wherever appropriate
        header("Location: list.php");
        exit();
    } else {
        echo "<script>alert('Error updating record: " . $conn->error . "');</script>";
    }
}

$conn->close();
?>
