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

$patient_name = $_POST['patient_name'];
$card_number = $_POST['card_number'];
$date_of_birth = $_POST['date_of_birth'];
$gender = $_POST['gender'];
$blood_group = $_POST['blood_group'];

$sql = "INSERT INTO patients (patient_name, card_number, date_of_birth, gender, blood_group) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $patient_name, $card_number, $date_of_birth, $gender, $blood_group);

if ($stmt->execute()) {
    echo "New patient registered successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
