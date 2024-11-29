<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "healthcardDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];
    $email = $_POST['email'];
    $specialization = $_POST['specialization'];

    if ($pass !== $confirm_pass) {
        echo "Passwords do not match!";
        exit();
    }

    $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO doctors (name, username, password, email, specialization) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $username, $hashedPassword, $email, $specialization);

    if ($stmt->execute()) {
        header("Location: index.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
