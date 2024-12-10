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

$email = $_POST['email'];

// Check if the email exists in the database
$sql = "SELECT * FROM doctors WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$doctor = $result->fetch_assoc();

if ($doctor) {
    // Generate a unique token
    $token = bin2hex(random_bytes(50));
    
    // Save token in session
    session_start();
    $_SESSION['token'] = $token;
    $_SESSION['email'] = $email;

    // Send reset email
    $reset_link = "http://yourdomain.com/reset_password.php?token=$token";
    $subject = "Password Reset Request";
    $message = "Hi, click on the following link to reset your password: $reset_link";
    $headers = "From: no-reply@yourdomain.com\r\n";

    if (mail($email, $subject, $message, $headers)) {
        echo "Password reset email sent successfully!";
    } else {
        echo "Failed to send password reset email.";
    }
} else {
    echo "Email address not found.";
}

$stmt->close();
$conn->close();
?>
