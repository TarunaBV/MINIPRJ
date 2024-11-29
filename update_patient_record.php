<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "healthcardDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$card_number = $_POST['card_number'];

$sql = "SELECT patient_name FROM patients WHERE card_number = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $card_number);
$stmt->execute();
$stmt->bind_result($patient_name);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Patient Record</title>
    <link rel="stylesheet" href="patient_update.css">
</head>
<body>
    <div class="container">
        <h1>Update Record for Patient: <?php echo htmlspecialchars($patient_name); ?></h1>
        <form action="process_update_patient.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="card_number" value="<?php echo htmlspecialchars($card_number); ?>">
            <div class="inputBox">
                <input type="date" name="date" required>
                <label for="date">Date</label>
            </div>
            <div class="inputBox">
                <textarea name="patient_details" required></textarea>
                <label for="patient_details">Patient Details</label>
            </div>
            <div class="inputBox">
                <input type="file" name="patient_image" accept="image/*">
                <label for="patient_image">Upload Patient Image</label>
            </div>
            <input type="submit" class="btn" value="Update">
        </form>
    </div>
</body>
</html>
