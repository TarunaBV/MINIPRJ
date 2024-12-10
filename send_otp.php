<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "healthcardDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$phone_number = $_POST['phone_number'];
$otp = rand(100000, 999999); // Generate a random 6-digit OTP

// Save OTP in session
session_start();
$_SESSION['otp'] = $otp;
$_SESSION['phone_number'] = $phone_number;

// Here you should integrate with an SMS API to send the OTP to the user's phone number
// For demonstration purposes, we'll assume the OTP is sent successfully

// Redirect to OTP verification page
header("Location: verify_otp.html");
exit();
?>
