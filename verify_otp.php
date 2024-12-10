<?php
session_start();

$entered_otp = $_POST['otp'];

if ($entered_otp == $_SESSION['otp']) {
    // OTP is correct, redirect to reset password page
    header("Location: reset_password.html");
    exit();
} else {
    // OTP is incorrect, redirect back to verify OTP page with an error
    header("Location: verify_otp.html?error=invalid_otp");
    exit();
}
?>
