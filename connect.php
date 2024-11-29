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
    session_start();
    $username = $_POST['username'];
    $pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM doctors WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($pass, $hashedPassword)) {
        $_SESSION['username'] = $username;
        header("Location: home.php");
        exit();
    } else {
        echo $stmt->num_rows > 0 ? "Incorrect password!" : "Username does not exist!";
    }

    $stmt->close();
}

$conn->close();
?>
