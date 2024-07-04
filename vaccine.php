<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userdb";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function sanitize_input($input) {

    $input = trim($input);

    $input = strip_tags($input);

    $input = mysqli_real_escape_string($GLOBALS['conn'], $input);
    return $input;
}


$firstname = sanitize_input($_POST['firstname']);
$lastname = sanitize_input($_POST['lastname']);
$securityno = sanitize_input($_POST['securityno']);
$dob = sanitize_input($_POST['dob']);
$email = sanitize_input($_POST['email']);
$phnumber = sanitize_input($_POST['phnumber']);
$gender = sanitize_input($_POST['gender']);
$address1 = sanitize_input($_POST['address1']);
$address2 = sanitize_input($_POST['address2']);
$city = sanitize_input($_POST['city']);
$state = sanitize_input($_POST['state']);
$country = sanitize_input($_POST['country']);
$insuranceco = sanitize_input($_POST['insuranceco']);
$insuranceid = sanitize_input($_POST['insuranceid']);
$diseases = sanitize_input($_POST['diseases']);
$declaration = isset($_POST['declaration']) ? 1 : 0;


$sql = "INSERT INTO vaccinations (firstname, lastname, securityno, dob, email, phnumber, gender, address1, address2, city, state, country, insuranceco, insuranceid, diseases, declaration)
        VALUES ('$firstname', '$lastname', '$securityno', '$dob', '$email', '$phnumber', '$gender', '$address1', '$address2', '$city', '$state', '$country', '$insuranceco', '$insuranceid', '$diseases', $declaration)";

if ($conn->query($sql) === TRUE) {
    $response = array('status' => 'success', 'message' => 'Registration successful.');
    echo json_encode($response);
    header('Location: index.html'); 
    exit;
} else {
    $response = array('status' => 'error', 'message' => 'Error: ' . $sql . "<br>" . $conn->error);
    echo json_encode($response);
    header('Location: vaccine.html'); 
    exit;
}

$conn->close();
?>
