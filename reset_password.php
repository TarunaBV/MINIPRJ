<?php
session_start();
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

$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];

if ($new_password == $confirm_password) {
    $phone_number = $_SESSION['phone_number'];
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    $sql = "UPDATE doctors SET password = ? WHERE phone_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $hashed_password, $phone_number);
    if ($stmt->execute()) {
        echo "Password reset successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();

    // Clear session data
    session_unset();
    session_destroy();

    // Redirect to login page
    header("Location: login.html");
    exit();
} else {
    // Passwords do not match, redirect back to reset password page with an error
    header("Location: reset_password.html?error=password_mismatch");
    exit();
}
?>
