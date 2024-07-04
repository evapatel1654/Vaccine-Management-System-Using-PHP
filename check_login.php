<?php
// Start session or include session start script
session_start();

// Assuming you have a session variable to check login status
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
    // User is logged in
    echo json_encode(['loggedIn' => true]);
} else {
    // User is not logged in
    echo json_encode(['loggedIn' => false]);
}
