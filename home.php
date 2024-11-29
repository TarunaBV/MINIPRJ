<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: connect.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "healthcardDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_SESSION['username'];
$stmt = $conn->prepare("SELECT * FROM doctors WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$doctor = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Profile</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <header class="header" onclick="toggleDetails()">
        <div class="header-content">
            <img src="path/to/profile-pic.jpg" alt="Profile Picture" class="profile-pic">
            <h1>Welcome, Dr. <?php echo htmlspecialchars($doctor['name']); ?>!</h1>
        </div>
    </header>
    <div class="main-content">
        <div class="sidebar" id="sidebar">
            <div class="profile-details" id="profile-details">
                <p><strong>Full Name:</strong> <?php echo htmlspecialchars($doctor['name']); ?></p>
                <p><strong>Username:</strong> <?php echo htmlspecialchars($doctor['username']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($doctor['email']); ?></p>
                <p><strong>Specialization:</strong> <?php echo htmlspecialchars($doctor['specialization']); ?></p>
                <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($doctor['phone_number']); ?></p>
                <p><strong>Qualification:</strong> <?php echo htmlspecialchars($doctor['qualification']); ?></p>
                <a href="update_profile.php" class="btn">Update Profile</a>
            </div>
        </div>
        <div class="action-buttons">
    <a href="register_patient.php" class="btn">Register a Patient</a>
    <a href="update_patient.php" class="btn">Update Patient's Record</a>
    <a href="view_patient_records.php" class="btn">View Patient's Records</a>
</div>

    </div>
    <script src="profile.js"></script>
</body>
</html>
